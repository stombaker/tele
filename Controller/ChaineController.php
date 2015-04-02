<?php
namespace Controller;

use Model\Dao\ChaineDAO;
use Model\Dao\ProgrammationDAO;
use Model\Dto\ChaineDTO;
use View\View;

class ChaineController {
    public function listAction() {
        $chaineDAO = new ChaineDAO();
        $chaines = $chaineDAO->findAll();
        $data = ['chaines' => $chaines];
        $view = new View('chaine', 'list');
        echo $view->create($data);
    }

    public function readAction($parameters) {
        $chaineDAO = new ChaineDAO();
        $programmationDAO = new ProgrammationDAO();
        $chaine = $chaineDAO->find($parameters['id']);
        if ($chaine !== null) {
            $programmations = $programmationDAO->findByChaine($chaine->getChaineId(), true);
            echo (new View('chaine', 'read'))->create([
                'chaine' => $chaine,
                'programmations' => $programmations
            ]);
        } else {
            echo (new View('chaine', '404'))->create($parameters);
        }
    }

    public function createAction() {
        $chaineDTO = new ChaineDTO();
        if (!empty($_POST)) {
            $chaineDTO->setChaineCablee(false); // avoid null
            $chaineDTO->hydrate($_POST);
            $chaineDAO = new ChaineDAO();
            $chaineDAO->insert($chaineDTO);
            header('location:/chaine/' . $chaineDTO->getChaineId());
        }
        echo (new View('chaine', 'form'))->create([
            'chaineDTO' => $chaineDTO,
            'action' => 'post'
        ]);
    }

    public function updateAction($parameters) {
        $chaineDAO = new ChaineDAO();
        $chaineDTO = $chaineDAO->find($parameters['id']);
        if ($chaineDTO !== null) {
            if (!empty($_POST)) {
                // because with checkboxes, it won't be updated when not checked.
                $chaineDTO->setChaineCablee(false);
                $chaineDTO->hydrate($_POST);
                $chaineDAO->update($chaineDTO);
                header('location:/');
            }
            echo (new View('chaine', 'form'))->create([
                'chaineDTO' => $chaineDTO,
                'action' => 'put'
            ]);
        } else {
            header('location:/chaine/' . $chaineDTO->getChaineId());
        }
    }

    public function deleteAction($parameters) {
        $chaineDAO = new ChaineDAO();
        $chaineDTO = $chaineDAO->find($parameters['id']);
        if ($chaineDTO !== null) {
            try {
                $chaineDAO->delete($chaineDTO);
                header('location:/');
            } catch (\Exception $e) {
                $_SESSION['error'] = $e->getCode() == 23000
                    ? 'Veuillez supprimer les programmations liées avant de supprimer.'
                    : 'Une erreur est survenue ('. $e->getCode() .': '. $e->getMessage() .')';
                header('location:/chaine/' . $chaineDTO->getChaineId());
            }
        } else {
            $_SESSION['error'] = 'Programme inexistant';
            header('location:/');
        }
    }
}