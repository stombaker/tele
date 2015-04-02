<?php
namespace Model\Dto;

class ChaineDTO {
    use Hydrator;

    /** @var int */
    private $chaineId;
    /** @var string */
    private $nomChaine;
    /** @var string */
    private $adresse;
    /** @var string */
    private $code_postal;
    /** @var string */
    private $ville;
    /** @var string */
    private $telephone;
    /** @var bool */
    private $chaineCablee;
    /** @var string */
    private $fax;

    /**
     * @return int
     */
    public function getChaineId() {
        return $this->chaineId;
    }

    /**
     * @param int $chaineId
     */
    public function setChaineId($chaineId) {
        $this->chaineId = $chaineId;
    }

    /**
     * @return mixed
     */
    public function getNomChaine() {
        return $this->nomChaine;
    }

    /**
     * @param mixed $nomChaine
     */
    public function setNomChaine($nomChaine) {
        $this->nomChaine = $nomChaine;
    }

    /**
     * @return string
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getCodePostal() {
        return $this->code_postal;
    }

    /**
     * @param string $code_postal
     */
    public function setCodePostal($code_postal) {
        $this->code_postal = $code_postal;
    }

    /**
     * @return string
     */
    public function getVille() {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville) {
        $this->ville = $ville;
    }

    /**
     * @return string
     */
    public function getTelephone() {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    /**
     * @return boolean
     */
    public function isChaineCablee() {
        return $this->chaineCablee;
    }

    /**
     * @return int
     */
    public function getChaineCablee() {
        return $this->chaineCablee;
    }

    /**
     * @param mixed $chaineCablee
     */
    public function setChaineCablee($chaineCablee) {
        if (is_bool($chaineCablee)) {
            $this->chaineCablee = $chaineCablee;
        } else {
            $this->chaineCablee = $chaineCablee == 1;
        }
    }

    /**
     * @return string
     */
    public function getFax() {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax($fax) {
        $this->fax = $fax;
    }
}