<?php
namespace Model\Dto;


class ProgrammeDTO {
    use Hydrator;

    /** @var int */
    private $programmeId;
    /** @var int */
    private $realisateurId;
    /** @var int */
    private $typeId;
    /** @var int */
    private $duree;
    /** @var string */
    private $nomProgramme;

    /** @var RealisateurDTO */
    private $realisateurDTO;
    /** @var TypeDiffusionDTO */
    private $typeDiffusionDTO;

    /**
     * @return mixed
     */
    public function getProgrammeId() {
        return $this->programmeId;
    }

    /**
     * @param mixed $programmeId
     */
    public function setProgrammeId($programmeId) {
        $this->programmeId = $programmeId;
    }

    /**
     * @return int
     */
    public function getRealisateurId() {
        return $this->realisateurId;
    }

    /**
     * @param int $realisateurId
     */
    public function setRealisateurId($realisateurId) {
        $this->realisateurId = $realisateurId;
    }

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
     * @return int
     */
    public function getDuree() {
        return $this->duree;
    }

    /**
     * @param int $duree
     */
    public function setDuree($duree) {
        $this->duree = $duree;
    }

    /**
     * @return string
     */
    public function getNomProgramme() {
        return $this->nomProgramme;
    }

    /**
     * @param string $nomProgramme
     */
    public function setNomProgramme($nomProgramme) {
        $this->nomProgramme = $nomProgramme;
    }

    /**
     * @return RealisateurDTO
     */
    public function getRealisateurDTO() {
        return $this->realisateurDTO;
    }

    /**
     * @param RealisateurDTO $realisateurDTO
     */
    public function setRealisateurDTO($realisateurDTO) {
        $this->realisateurDTO = $realisateurDTO;
    }

    /**
     * @return TypeDiffusionDTO
     */
    public function getTypeDiffusionDTO() {
        return $this->typeDiffusionDTO;
    }

    /**
     * @param TypeDiffusionDTO $typeDiffusionDTO
     */
    public function setTypeDiffusionDTO($typeDiffusionDTO) {
        $this->typeDiffusionDTO = $typeDiffusionDTO;
    }
}