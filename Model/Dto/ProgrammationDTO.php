<?php
namespace Model\Dto;


class ProgrammationDTO {
    use Hydrator;

    /** @var int */
    private $chaineId;
    /** @var int */
    private $programmeId;
    /** @var \DateTime */
    private $dateDiffusion;
    /** @var ProgrammeDTO */
    private $programmeDTO;
    /** @var ChaineDTO */
    private $chaineDTO;

    /**
     * @return mixed
     */
    public function getChaineId() {
        return $this->chaineId;
    }

    /**
     * @param mixed $chaineId
     */
    public function setChaineId($chaineId) {
        $this->chaineId = $chaineId;
    }

    /**
     * @return int
     */
    public function getProgrammeId() {
        return $this->programmeId;
    }

    /**
     * @param int $programmeId
     */
    public function setProgrammeId($programmeId) {
        $this->programmeId = $programmeId;
    }

    /**
     * @return \DateTime
     */
    public function getDateDiffusion() {
        return $this->dateDiffusion;
    }

    /**
     * @param mixed $dateDiffusion
     */
    public function setDateDiffusion($dateDiffusion) {
        if ($dateDiffusion instanceof \DateTime) {
            $this->dateDiffusion = $dateDiffusion;
        } else {
            $this->dateDiffusion = new \DateTime($dateDiffusion);
        }
    }

    /**
     * @return ProgrammeDTO
     */
    public function getProgrammeDTO() {
        return $this->programmeDTO;
    }

    /**
     * @param ProgrammeDTO $programmeDTO
     */
    public function setProgrammeDTO($programmeDTO) {
        $this->programmeDTO = $programmeDTO;
    }

    /**
     * @return ChaineDTO
     */
    public function getChaineDTO() {
        return $this->chaineDTO;
    }

    /**
     * @param ChaineDTO $chaineDTO
     */
    public function setChaineDTO($chaineDTO) {
        $this->chaineDTO = $chaineDTO;
    }
}