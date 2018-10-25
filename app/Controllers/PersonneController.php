<?php

class PersonneController extends BaseController
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function loginAction()
    {
        unset($_SESSION['connexion_error']);
        $this->setView('loginView');
        $this->render();
    }

    public function connexionAction()
    {
        if ($_SERVER['REQUEST_METHOD'] != "POST")
            $_SESSION['connexion_error'] = "Veuillez envoyer le formulaire rempli";
        else
        {
            $crudPersonne = new Parking\DbTable\Personne($this->connection);
            $personne = $crudPersonne->connexion($_POST['mail'],$_POST['password']);
            if (empty($personne))
                $_SESSION['connexion_error'] = "Mail et/ou mot de passe incorrect";
            else
            {
                unset($_SESSION['connexion_error']);
                $_SESSION['personne'] = serialize($personne);
                if ($personne->isAdmin())
                {
                    header("Location: ".BASE_URL."admin");
                    exit;
                }
                else
                {
                    header("Location: ".BASE_URL."user");
                    exit;
                }
            }
        }
        if (isset($_SESSION['connexion_error']))
        {
            $_SESSION['mail'] = isset($_POST['mail']) ? $_POST['mail'] : "";
            $this->setView('loginView');
            $this->render();
        }
    }
    
    public function registerAction()
    {
        unset($_SESSION['inscription_error']);
        $this->setView('registerView');
        $this->render();
    }
    
    public function inscriptionAction()
    {
        if ($_SERVER['REQUEST_METHOD'] != "POST")
            $_SESSION['inscription_error'] = "Veuillez envoyer le formulaire rempli";
        else 
        {
            $crudPersonne = new Parking\DbTable\Personne($this->connection);
            $personne = $crudPersonne->findByMail($_POST['mail']);
            if (empty($personne))
                $_SESSION['inscription_error'] = "Veuillez utiliser le mail de l'entreprise";
            else
            {
                if ($personne->getStatut()->getId() != NI_ID && !$personne->isAdmin())
                {
                   if ($personne->getStatut()->getId() != INV_ID)
                      $_SESSION['inscription_error'] = "Vous êtes déjà inscrit sur ce site";
                   else
                      $_SESSION['inscription_error'] = "Votre inscription est en attente de validation";
                }
                else
                {
                    unset($_SESSION['inscription_error']);
                    if ($personne->isAdmin())
                    {
                        $crudStatut = new Parking\DbTable\Statut($this->connection);
                        $statut = $crudStatut->find(IV_ID);
                    }
                    else
                    {
                        $crudStatut = new Parking\DbTable\Statut($this->connection);
                        $statut = $crudStatut->find(INV_ID);
                    }
                    $personne->setStatut($statut)
                             ->setPassword($_POST['password']);
                    $crudPersonne->update($personne);
                    $_SESSION['personne'] = serialize($personne);
                    if ($personne->isAdmin())
                    {
                        header("Location: ".BASE_URL."admin");
                        exit;
                    }
                    else
                    {
                        header("Location: ".BASE_URL."user");
                        exit;
                    }
                }
            }  
        }
        if (isset($_SESSION['inscription_error']))
        {
            $_SESSION['mail'] = isset($_POST['mail']) ? $_POST['mail'] : "";  
            $this->setView('registerView');
            $this->render();
        }
    }

    public function indexAction()
    {
        $data = array();
        if (isset($_SESSION['personne']) && is_object (unserialize($_SESSION['personne'])) && get_class(unserialize($_SESSION['personne'])) == 'Parking\Personne')
        {
            $data['personne'] = unserialize($_SESSION['personne']);
            $this->setView('userView');
            $this->render($data);
        }
        else
        {
            $_SESSION['connexion_error'] = "Vous devez vous connecter pour accéder à cette page";
            $this->setView('loginView');
            $this->render();
        }
    }

    public function deconnexion()
    {
        unset($_SESSION['personne']);
        header("Location: ".BASE_URL);
        exit;
    }
}