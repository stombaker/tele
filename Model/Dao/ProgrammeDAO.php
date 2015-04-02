<?php
namespace Model\Dao;


use Model\Dto\ProgrammeDTO;

class ProgrammeDAO {
    /** @var callable */
    private $factoryProgrammeDTO;

    public function __construct(){
        $this->factoryProgrammeDTO = function() {
            return new ProgrammeDTO();
        };
    }

    /**
     * @param bool $withJoin
     * @return ProgrammeDTO[]
     */
    public function findAll($withJoin=false) {
        $result = Database::getInstance()->read('SELECT * FROM programmes ORDER BY nom_programme', array(), $this->factoryProgrammeDTO);
        if ($withJoin) {
            foreach ($result as $programmeDTO) {
                $this->doJoin($programmeDTO);
            }
        }
        return $result;
    }

    /**
     * @param int $id
     * @param bool $withJoin
     * @return ProgrammeDTO
     */
    public function find($id, $withJoin=false) {
        $result = Database::getInstance()->read('SELECT * FROM programmes WHERE programme_id = :id', array('id' => $id), $this->factoryProgrammeDTO);
        if (!empty($result)) {
            $result = $result[0];
            if ($withJoin) {
                $this->doJoin($result);
            }
            return $result;
        } else {
            return null;
        }
    }

    /**
     * @param ProgrammeDTO $programme
     */
    private function doJoin($programme) {
        $realisateurDAO = new RealisateurDAO();
        $programme->setRealisateurDTO($realisateurDAO->find($programme->getRealisateurId()));

        $typeDiffusionDAO = new TypeDiffusionDAO();
        $programme->setTypeDiffusionDTO($typeDiffusionDAO->find($programme->getTypeId()));
    }

    /**
     * @param ProgrammeDTO $programmeDTO
     * @return ProgrammeDTO
     */
    public function insert($programmeDTO) {
        $lastId = Database::getInstance()->update(
            'INSERT INTO programmes(realisateur_id, type_id, duree, nom_programme) VALUES (:realisateur_id, :type_id, :duree, :nom_programme)',
            [
                'realisateur_id' => $programmeDTO->getRealisateurId(),
                'type_id' => $programmeDTO->getTypeId(),
                'duree' => $programmeDTO->getDuree(),
                'nom_programme' => $programmeDTO->getNomProgramme()
            ],
            true
        );
        $programmeDTO->setProgrammeId($lastId);
        return $programmeDTO;
    }

    /**
     * @param ProgrammeDTO $programmeDTO
     * @return ProgrammeDTO
     */
    public function update($programmeDTO) {
        Database::getInstance()->update(
            'UPDATE programmes SET realisateur_id = :realisateur_id, type_id = :type_id, duree = :duree, nom_programme = :nom_programme
             WHERE programme_id = :programme_id',
            [
                'realisateur_id' => $programmeDTO->getRealisateurId(),
                'type_id' => $programmeDTO->getTypeId(),
                'duree' => $programmeDTO->getDuree(),
                'nom_programme' => $programmeDTO->getNomProgramme(),
                'programme_id' => $programmeDTO->getProgrammeId()
            ]
        );
        return $programmeDTO;
    }

    /**
     * @param ProgrammeDTO $programmeDTO
     */
    public function delete($programmeDTO) {
        Database::getInstance()->update(
            'DELETE FROM programmes WHERE programme_id = :programme_id',
            array('programme_id' => $programmeDTO->getProgrammeId())
        );
    }
}