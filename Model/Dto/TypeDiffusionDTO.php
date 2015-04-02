<?php
namespace Model\Dto;


class TypeDiffusionDTO {
    use Hydrator;

    /** @var int */
    private $typeId;
    /** @var string */
    private $libelle;

    /**
     * @return int
     */
    public function getTypeId() {
        return $this->typeId;
    }

    /**
     * @param int $typeId
     */
    public function setTypeId($typeId) {
        $this->typeId = $typeId;
    }

    /**
     * @return string
     */
    public function getLibelle() {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }


}