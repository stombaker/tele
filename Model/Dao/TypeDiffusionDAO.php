<?php
namespace Model\Dao;


use Model\Dto\TypeDiffusionDTO;

class TypeDiffusionDAO {
    /** @var callable */
    private $factoryTypeDiffusionDTO;

    public function __construct(){
        $this->factoryTypeDiffusionDTO = function() {
            return new TypeDiffusionDTO();
        };
    }

    public function findAll() {
        return Database::getInstance()->read('SELECT * FROM type_diffusion ORDER BY libelle', array(), $this->factoryTypeDiffusionDTO);
    }

    /**
     * @param int $id
     * @return TypeDiffusionDTO
     */
    public function find($id) {
        $result = Database::getInstance()->read('SELECT * FROM type_diffusion WHERE type_id = :id', array('id' => $id), $this->factoryTypeDiffusionDTO);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
}