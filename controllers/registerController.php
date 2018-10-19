<?php

$bdd = new PDO('mysql:host=localhost;dbname=parking', 'root','root');

if(isset($_POST['formInscription']))
{       $nom = htmlspecialchars($_POST['nom']); 
        $prenom = htmlspecialchars($_POST['prenom']);
        $mail = htmlspecialchars($_POST['mail']);
        
 
    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']))//pour s'assurer que les champs ne sont pas vides
    { 
        $nomlength = strlen($nom); //Permet de vérifier la longeur du pseudo, c'est strlen qui compte le nb de caractères.
        if($nomlength <=255)
        {
               $reqmail = $bdd->prepare("SELECT * FROM personne WHERE mail=?");//CETTE PARTIE PERMET DE SAVOIR SI CE MAIL EST DÉJÀ EXISTANT DANS LA BDD   
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount(); //Compte le nb de colonne
               
               if($mailexist==0)
               {
                   if(filter_var($mail, FILTER_VALIDATE_EMAIL)) //...on vérifie la syntaxe du mail pour voir s'il est vrai.
                   {
                     
                        $insertuser = $bdd->prepare("INSERT INTO personne (nom,prenom,mail) VALUES (?,?,?)");
                        $insertuser->execute(array($nom, $prenom, $mail));
                        $message = "Votre compte à bien été créé !";
                        header('Location: ../Views/homeView.php');        
                    }  
                   else{$message = "Votre email n'est pas valide.";}
                    }
                else{$message = "Adresse mail déjà utilisée.";}
        }
        else {$message = "Votre pseudo ne doit pas contenir plus de 255 caractères.";}
        } 
    else
    {$message = "Tous les champs doivent être complétés ! ";}//On créer la variable $message qui sera utiliser à la fin du code
}

        if(isset($message)) //Appel de la fonction
        {
            echo '<font color="red">'.$message.'</font>'; //Utilisation de la variable $message définie au début du code.
        }

require "../views/registerView.php";

?>
