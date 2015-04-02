<?php
namespace Controller;


use Model\Dao\ProgrammationDAO;
use Model\Dao\ProgrammeDAO;
use Model\Dao\RealisateurDAO;
use Model\Dao\TypeDiffusionDAO;
use Model\Dto\ProgrammeDTO;
use Model\Dto\RealisateurDTO;
use View\View;

class ProgrammeController {
    public function listAction() {
        $programmeDAO = new ProgrammeDAO();
        $programmes = $programmeDAO->findAll(true);
        $data = ['programmes' => $programmes];
        $view = new View('programme', 'list');
        echo $view->create($data);
    }

    public function readAction($parameters) {
        $programmeDAO = new ProgrammeDAO();
        $programmationDAO = new ProgrammationDAO();
        $programme = $programmeDAO->find($parameters['id'], true);
        if ($programme !== null) {
            $programmations = $programmationDAO->findByProgramme($programme->getProgrammeId(), true);
            echo (new View('programme', 'read'))->create([
                'programme' => $programme,
                'programmations' => $programmations
            ]);
        } else {
            echo (new View('programme', '404'))->create($parameters);
        }
    }

    public function createAction() {
        $programmeDAO = new ProgrammeDAO();
        $realisateurDAO = new RealisateurDAO();
        $typeDAO = new TypeDiffusionDAO();
        $programmeDTO = new ProgrammeDTO();
        if (!empty($_POST)) {
            $programmeDTO->hydrate($_POST);
            if ($_POST['realisateurChoice'] === 'new') {
                $realisateurDTO = new RealisateurDTO();
                $realisateurDTO->setNomRealisateur($_POST['newRealisateur']);
                $realisateurDTO = $realisateurDAO->insert($realisateurDTO);
                $programmeDTO->setRealisateurId($realisateurDTO->getRealisateurId());
            } else {
                $programmeDTO->setRealisateurId($_POST['oldRealisateur']);
            }
            $programmeDTO = $programmeDAO->insert($programmeDTO);
            header('location:/programme/' . $programmeDTO->getProgrammeId());
        }
        echo (new View('programme', 'form'))->create([
            'programmeDTO' => $programmeDTO,
            'availableRealisateurs' => $realisateurDAO->findAll(),
            'availableTypes' => $typeDAO->findAll(),
            'action' => 'post'
        ]);
    }

    public function updateAction($parameters) {
        $programmeDAO = new ProgrammeDAO();
        $typeDAO = new TypeDiffusionDAO();
        $realisateurDAO = new RealisateurDAO();
        $programmeDTO = $programmeDAO->find($parameters['id']);
        if ($programmeDTO !== null) {
            if (!empty($_POST)) {
                $programmeDTO->hydrate($_POST);
                if ($_POST['realisateurChoice'] === 'new') {
                    $realisateurDTO = new RealisateurDTO();
                    $realisateurDTO->setNomRealisateur($_POST['newRealisateur']);
                    $realisateurDTO = $realisateurDAO->insert($realisateurDTO);
                    $programmeDTO->setRealisateurId($realisateurDTO->getRealisateurId());
                } else {
                    $programmeDTO->setRealisateurId($_POST['oldRealisateur']);
                }
                $programmeDTO = $programmeDAO->update($programmeDTO);
                header('location:/programme/' . $programmeDTO->getProgrammeId());
            }
            echo (new View('programme', 'form'))->create([
                'programmeDTO' => $programmeDTO,
                'availableRealisateurs' => $realisateurDAO->findAll(),
                'availableTypes' => $typeDAO->findAll(),
                'action' => 'put'
            ]);
        } else {
            header('location:/programme/' . $programmeDTO->getProgrammeId());
        }
    }

    public function deleteAction($parameters) {
        $programmeDAO = new ProgrammeDAO();
        $programmeDTO = $programmeDAO->find($parameters['id']);
        if ($programmeDTO !== null) {
            try {
                $programmeDAO->delete($programmeDTO);
                header('location:/programmes');
            } catch (\Exception $e) {
                $_SESSION['error'] = $e->getCode() == 23000
                    ? 'Veuillez supprimer les programmations liées avant de supprimer.'
                    : 'Une erreur est survenue ('. $e->getCode() .': '. $e->getMessage() .')';
                header('location:/programme/' . $programmeDTO->getProgrammeId());
            }
        } else {
            $_SESSION['error'] = 'Programme inexistant';
            header('location:/programmes');
        }
    }
}