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
                $users = $crudPersonne->findAll();
                $data['users'] = $users;
                $attentes = $crudPersonne->findByStatut(IA_ID);
                $data['attentes'] = $attentes;
                $crudReservation = new Parking\DbTable\Reservation($this->connection);
                $reservation = $crudReservation->findHisto();
                $data['reservation'] = $reservation;                            
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
                $_SESSION['onglet'] = "inscriptions";
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
                $_SESSION['onglet'] = "inscriptions";
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

    public function monterAction($params)
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
                    $ordre = $persUpd->getAttente()->getOrdre() - 1;
                    $ordre_replace = $persUpd->getAttente()->getOrdre();
                    $crudAttente = new Parking\DbTable\Attente($this->connection);
                    $attente = $crudAttente->findByPersonne($persUpd->getId());
                    $attente->setOrdre($ordre);
                    $attente_replace = $crudAttente->findByOrdre($ordre);
                    $attente_replace->setOrdre($ordre_replace);
                    $crudAttente->update($attente);
                    $crudAttente->update($attente_replace);
                }
                $_SESSION['onglet'] = "liste_attente";
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
     public function attribuerAction($params)
    {
        $_SESSION['onglet'] = "liste_attente";
        if (isset($_SESSION['personne']) && is_object (unserialize($_SESSION['personne'])) && get_class(unserialize($_SESSION['personne'])) == 'Parking\Personne')
        {
            $personne = unserialize($_SESSION['personne']);
            if ($personne->isAdmin())
            {
                $data= array();
                $crudPersonne = new Parking\DbTable\Personne($this->connection);
                $data['personne'] = $crudPersonne->find($params['id']);
                if (empty($data['personne'])) {
                    header("Location: ".BASE_URL."admin");
                }
                if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['debut']) && isset($_POST['fin']))
                {
                    $crudPlace = new Parking\DbTable\Place($this->connection);
                    $place = $crudPlace->findFree();
                    if (empty($place))
                    {
                        $data['attribution_error'] = "Il n'y a plus de place de libre";
                        $this->setView('attributeView');
                        $this->render($data);
                    }
                    else
                    {
                        $today = date("Y-m-d");
                        if ($_POST['debut'] < $today || $_POST['debut'] >= $_POST['fin'])
                        {
                            $data['attribution_error'] = "Les dates ne sont pas valides";
                            $this->setView('attributeView');
                            $this->render($data);
                        }
                        else
                        {
                            $crudAttente = new Parking\DbTable\Attente($this->connection);
                            $ordre = $data['personne']->getAttente()->getOrdre();
                            $attentes = $crudAttente->findAfter($ordre);
                            $crudAttente->delete($data['personne']->getAttente());
                            foreach ($attentes as $attente)
                            {
                                $attente->setOrdre($ordre);
                                $crudAttente->update($attente);
                                $ordre++;
                            }
                            $crudReservation = new Parking\DbTable\Reservation($this->connection);
                            $reservation = new Parking\Reservation();
                            $reservation->setDebut($_POST['debut'])
                                        ->setFin($_POST['fin'])
                                        ->setPersonne($data['personne'])
                                        ->setPlace($place);
                            $crudReservation->add($reservation);
                            $crudStatut = new Parking\DbTable\Statut($this->connection);
                            $statut = $crudStatut->find(IOK_ID);
                            $data['personne']->setStatut($statut);
                            $crudPersonne->update($data['personne']);
                            $_SESSION['personne'] = serialize($data['personne']);
                            header("Location: ".BASE_URL."admin");
                        }
                    }

                }
                else
                {
                    $this->setView('attributeView');
                    $this->render($data);
                }
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
    public function descendreAction($params)
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
                    $ordre = $persUpd->getAttente()->getOrdre() + 1;
                    $ordre_replace = $persUpd->getAttente()->getOrdre();
                    $crudAttente = new Parking\DbTable\Attente($this->connection);
                    $attente = $crudAttente->findByPersonne($persUpd->getId());
                    $attente->setOrdre($ordre);
                    $attente_replace = $crudAttente->findByOrdre($ordre);
                    $attente_replace->setOrdre($ordre_replace);
                    $crudAttente->update($attente);
                    $crudAttente->update($attente_replace);
                }
                $_SESSION['onglet'] = "liste_attente";
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