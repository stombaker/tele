<?php
namespace Model\Dao;


use Model\Dto\RealisateurDTO;

class RealisateurDAO {
    /** @var callable */
    private $factoryRealisateurDTO;

    public function __construct(){
        $this->factoryRealisateurDTO = function() {
            return new RealisateurDTO();
        };
    }

    public function findAll() {
        return Database::getInstance()->read('SELECT * FROM realisateur ORDER BY nom_realisateur', array(), $this->factoryRealisateurDTO);
    }

    /**
     * @param int $id
     * @return RealisateurDTO
     */
    public function find($id) {
        $result = Database::getInstance()->read('SELECT * FROM realisateur WHERE realisateur_id = :id', array('id' => $id), $this->factoryRealisateurDTO);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    /**
     * @param RealisateurDTO $realisateurDTO
     * @return RealisateurDTO
     */
    public function insert($realisateurDTO) {
        $lastId = Database::getInstance()->update(
            'INSERT INTO realisateur(nom_realisateur) VALUES (:nom_realisateur)',
            ['nom_realisateur' => $realisateurDTO->getNomRealisateur()],
            true
        );
        $realisateurDTO->setRealisateurId($lastId);
        return $realisateurDTO;
    }
}