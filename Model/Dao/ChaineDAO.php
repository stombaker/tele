<?php
namespace Model\Dao;

use Model\Dto\ChaineDTO;

class ChaineDAO {
    /** @var callable */
    private $factoryChaineDTO;

    public function __construct(){
        $this->factoryChaineDTO = function() {
            return new ChaineDTO();
        };
    }

    /** @return ChaineDTO[] */
    public function findAll() {
        return Database::getInstance()->read('SELECT * FROM chaine ORDER BY nom_chaine', array(), $this->factoryChaineDTO);
    }

    /**
     * @param int $id
     * @return ChaineDTO
     */
    public function find($id) {
        $result = Database::getInstance()->read('SELECT * FROM chaine WHERE chaine_id = :id', array('id' => $id), $this->factoryChaineDTO);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }

    /**
     * @param ChaineDTO $chaineDTO
     * @return ChaineDTO
     */
    public function insert($chaineDTO) {
        $lastId = Database::getInstance()->update(
            'INSERT INTO chaine(nom_chaine, adresse, code_postal, ville, telephone, chaine_cablee, fax) ' .
            'VALUES (:nom_chaine, :adresse, :code_postal, :ville, :telephone, :chaine_cablee, :fax)',
            array(
                'nom_chaine' => $chaineDTO->getNomChaine(),
                'adresse' => $chaineDTO->getAdresse(),
                'code_postal' => $chaineDTO->getCodePostal(),
                'ville' => $chaineDTO->getVille(),
                'telephone' => $chaineDTO->getTelephone(),
                'chaine_cablee' => $chaineDTO->getChaineCablee(),
                'fax' => $chaineDTO->getFax()
            ),
            true
        );
        $chaineDTO->setChaineId($lastId);
        return $chaineDTO;
    }

    /**
     * @param ChaineDTO $chaineDTO
     * @return ChaineDTO
     */
    public function update($chaineDTO) {
        Database::getInstance()->update(
            'UPDATE chaine SET nom_chaine = :nom_chaine, adresse = :adresse, code_postal = :code_postal,
             ville = :ville, telephone = :telephone, chaine_cablee = :chaine_cablee, fax = :fax
             WHERE chaine_id = :chaine_id',
            array(
                'chaine_id' => $chaineDTO->getChaineId(),
                'nom_chaine' => $chaineDTO->getNomChaine(),
                'adresse' => $chaineDTO->getAdresse(),
                'code_postal' => $chaineDTO->getCodePostal(),
                'ville' => $chaineDTO->getVille(),
                'telephone' => $chaineDTO->getTelephone(),
                'chaine_cablee' => $chaineDTO->getChaineCablee(),
                'fax' => $chaineDTO->getFax()
            )
        );
        return $chaineDTO;
    }

    /**
     * @param ChaineDTO $chaineDTO
     */
    public function delete($chaineDTO) {
        Database::getInstance()->update(
            'DELETE FROM chaine WHERE chaine_id = :chaine_id',
            array('chaine_id' => $chaineDTO->getChaineId())
        );
    }
}