<?php
namespace Controller;


use Model\Dao\ChaineDAO;
use Model\Dao\ProgrammationDAO;
use Model\Dao\ProgrammeDAO;
use Model\Dto\ProgrammationDTO;
use View\View;

class ProgrammationController {
    public function createAction($parameters) {
        $programmationDAO = new ProgrammationDAO();
        $chaineDAO = new ChaineDAO();
        $programmeDAO = new ProgrammeDAO();

        $programmationDTO = new ProgrammationDTO();
        if (!empty($parameters['by']) && !empty($parameters['id'])) {
            if ($parameters['by'] === 'chaine') {
                $chaineDTO = $chaineDAO->find($parameters['id']);
                if ($chaineDTO !== null) {
                    $programmationDTO->setChaineDTO($chaineDTO);
                }
            } elseif ($parameters['by'] === 'programme') {
                $programmeDTO = $programmeDAO->find($parameters['id']);
                if ($programmeDTO !== null) {
                    $programmationDTO->setProgrammeDTO($programmeDTO);
                }
            }
        }

        if (!empty($_POST)) {
            $programmationDTO->hydrate($_POST);
            $programmationDAO->insert($programmationDTO);
            if ($programmationDTO->getChaineDTO() !== null) {
                // The one we selected
                header('location: /chaine/' . $programmationDTO->getChaineId());
            } elseif ($programmationDTO->getProgrammeDTO() !== null) {
                // The one we selected
                header('location: /programme/' . $programmationDTO->getProgrammeId());
            } else {
                header('location: /');
            }
            exit();
        }
        echo (new View('programmation', 'form'))->create([
            'programmationDTO' => $programmationDTO,
            'availableChaines' => $chaineDAO->findAll(),
            'availableProgrammes' => $programmeDAO->findAll(),
        ]);
    }

    public function deleteAction($parameters) {
        $programmationDTO = new ProgrammationDTO();
        $programmationDTO->hydrate($parameters);
        $programmationDAO = new ProgrammationDAO();
        $programmationDAO->delete($programmationDTO);
        if (!empty($parameters['by'])) {
            if ($parameters['by'] === 'chaine') {
                header('location: /chaine/' . $programmationDTO->getChaineId());
                exit();
            } elseif ($parameters['by'] === 'programme') {
                header('location: /programme/' . $programmationDTO->getProgrammeId());
                exit();
            }
        }
        header('location: /');
    }
}