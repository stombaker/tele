<?php
namespace Model\Dao;


use Model\Dto\ProgrammationDTO;

class ProgrammationDAO {
    /** @var callable */
    private $factoryProgrammationDTO;

    public function __construct(){
        $this->factoryProgrammationDTO = function() {
            return new ProgrammationDTO();
        };
    }

    public function findAll($withJoins=false) {
        $result = Database::getInstance()
                          ->read('SELECT * FROM programmation ORDER BY date_diffusion', array(), $this->factoryProgrammationDTO);
        if ($withJoins) {
            foreach ($result as $line) {
                $this->doJoin($result);
            }
        }
        return $result ;
    }

    public function findByChaine($id, $withProgramme=false) {
        $result = Database::getInstance()->read(
            'SELECT * FROM programmation WHERE chaine_id = :chaineId ORDER BY date_diffusion',
            ['chaineId' => $id],
            $this->factoryProgrammationDTO
        );
        if ($withProgramme) {
            $programmeDAO = new ProgrammeDAO();
            foreach($result as $line) {
                /** @var ProgrammationDTO $line */
                if ($line->getProgrammeId() !== null) {
                    $line->setProgrammeDTO($programmeDAO->find($line->getProgrammeId()));
                }
            }
        }
        return $result;
    }

    public function findByProgramme($id, $withChaine=false) {
        $result = Database::getInstance()->read(
            'SELECT * FROM programmation WHERE programme_id = :programmeId ORDER BY date_diffusion',
            ['programmeId' => $id],
            $this->factoryProgrammationDTO
        );
        if ($withChaine) {
            $chaineDAO = new ChaineDAO();
            foreach($result as $line) {
                /** @var ProgrammationDTO $line */
                if ($line->getChaineId() !== null) {
                    $line->setChaineDTO($chaineDAO->find($line->getChaineId()));
                }
            }
        }
        return $result;
    }

    /**
     * @param ProgrammationDTO $programmationDTO
     * @return ProgrammationDTO
     */
    public function insert($programmationDTO) {
        Database::getInstance()->update(
            'INSERT INTO programmation(chaine_id, programme_id, date_diffusion) ' .
            'VALUES (:chaine_id, :programme_id, :date_diffusion)',
            array(
                'chaine_id' => $programmationDTO->getChaineId(),
                'programme_id' => $programmationDTO->getProgrammeId(),
                'date_diffusion' => $programmationDTO->getDateDiffusion()->format('Y-m-d H:i'),
            )
        );
        return $programmationDTO;
    }

    /**
     * @param ProgrammationDTO $programmationDTO
     */
    public function delete($programmationDTO) {
        Database::getInstance()->update(
            'DELETE FROM programmation WHERE chaine_id = :chaine_id AND programme_id = :programme_id AND date_diffusion = :date_diffusion',
            [
                'chaine_id' => $programmationDTO->getChaineId(),
                'programme_id' => $programmationDTO->getProgrammeId(),
                'date_diffusion' => $programmationDTO->getDateDiffusion()->format('Y-m-d H:i')
            ]
        );
    }

    /**
     * @param ProgrammationDTO $programmation
     */
    private function doJoin($programmation) {
        $chaineDAO = new ChaineDAO();
        $programmation->setChaineDTO($chaineDAO->find($programmation->getChaineId()));

        $programmeDAO = new ProgrammeDAO();
        $programmation->setProgrammeDTO($programmeDAO->find($programmation->getProgrammeId()));
    }
}