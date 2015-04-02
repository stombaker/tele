<?php
namespace Model\Dto;


class RealisateurDTO {
    use Hydrator;

    /** @var int */
    private $realisateurId;
    /** @var string */
    private $nomRealisateur;

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
     * @return string
     */
    public function getNomRealisateur() {
        return $this->nomRealisateur;
    }

    /**
     * @param string $nomRealisateur
     */
    public function setNomRealisateur($nomRealisateur) {
        $this->nomRealisateur = $nomRealisateur;
    }


}