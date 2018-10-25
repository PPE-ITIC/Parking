<?php

class AdminController extends BaseController
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function indexAction()
    {
        if (isset($_SESSION['personne']) && is_object (unserialize($_SESSION['personne'])) && get_class(unserialize($_SESSION['personne'])) == 'Parking\Personne')
        {
            $data = array();
            $data['personne'] = unserialize($_SESSION['personne']);
            if ($data['personne']->isAdmin())
            {
                $crudPersonne = new Parking\DbTable\Personne($this->connection);
                $personnes = $crudPersonne->findByStatut(INV_ID);
                $data['personnes'] = $personnes;
                $this->setView('adminView');
                $this->render($data);
            }
            else
            {
                $_SESSION['connexion_error'] = "Vous devez vous connecter à votre compte admin pour accéder à cette page";
            }
        }
        else
        {
            $_SESSION['connexion_error'] = "Vous devez vous connecter pour accéder à cette page";
        }
        if (isset($_SESSION['connexion_error']))
        {
            $this->setView('loginView');
            $this->render();
        }
    }

    public function validerAction($params)
    {
        if (isset($_SESSION['personne']) && is_object (unserialize($_SESSION['personne'])) && get_class(unserialize($_SESSION['personne'])) == 'Parking\Personne')
        {
            $personne = unserialize($_SESSION['personne']);
            if ($personne->isAdmin())
            {
                $crudPersonne = new Parking\DbTable\Personne($this->connection);
                $persUpd = $crudPersonne->find($params['id']);

                if ($persUpd)
                {
                    $crudStatut = new Parking\DbTable\Statut($this->connection);
                    $statut = $crudStatut->find(IV_ID);
                    $persUpd->setStatut($statut);
                    $crudPersonne->update($persUpd);
                }
                header("Location: ".BASE_URL."admin");
                exit;
            }
            else
            {
                $_SESSION['connexion_error'] = "Vous devez vous connecter à votre compte admin pour accéder à cette page";
            }
        }
        else
        {
            $_SESSION['connexion_error'] = "Vous devez vous connecter pour accéder à cette page";
        }
        if (isset($_SESSION['connexion_error']))
        {
            $this->setView('loginView');
            $this->render();
        }
    }

    public function refuserAction($params)
    {
        if (isset($_SESSION['personne']) && is_object (unserialize($_SESSION['personne'])) && get_class(unserialize($_SESSION['personne'])) == 'Parking\Personne')
        {
            $personne = unserialize($_SESSION['personne']);
            if ($personne->isAdmin())
            {
                $crudPersonne = new Parking\DbTable\Personne($this->connection);
                $persUpd = $crudPersonne->find($params['id']);

                if ($persUpd)
                {
                    $crudStatut = new Parking\DbTable\Statut($this->connection);
                    $statut = $crudStatut->find(IKO_ID);
                    $persUpd->setStatut($statut);
                    $crudPersonne->update($persUpd);
                }
                header("Location: ".BASE_URL."admin");
                exit;
            }
            else
            {
                $_SESSION['connexion_error'] = "Vous devez vous connecter à votre compte admin pour accéder à cette page";
            }
        }
        else
        {
            $_SESSION['connexion_error'] = "Vous devez vous connecter pour accéder à cette page";
        }
        if (isset($_SESSION['connexion_error']))
        {
            $this->setView('loginView');
            $this->render();
        }
    }
}