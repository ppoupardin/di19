<?php
namespace src\Controller;

use src\Model\Bdd;
use src\Model\User;

class UserController extends  AbstractController {

    public function loginForm(){
        return $this->twig->render('User/login.html.twig');
    }
    public function inscriptionForm(){
        return $this->twig->render('User/inscription.html.twig');
    }

    public function loginCheck(){

        if(!filter_var(
            $_POST['password'],
            FILTER_VALIDATE_REGEXP,
            array(
                "options" => array("regexp"=>"/[a-zA-Z]{3,}/")
            )
        )){
            $_SESSION['errorlogin'] = "Le mot de passe ne peut être inférieur à 3 caractères";
            header('Location:/Login');
            return;
        }

        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $_SESSION['errorlogin'] = "Adresse Email invalide";
            header('Location:/Login');
            return;
        }

        if($_POST["email"]=="admin@admin.com"
            AND $_POST["password"] == "password"
        ){

            $_SESSION['login'] = array(
                'Nom' => 'Administrateur'
            ,'Prénom' => 'Sylvain'
            ,'roles' => array('admin', 'redacteur')
            );
            header('Location:/');
        }else{
            $_SESSION['errorlogin'] = "Erreur d'authentification";
            header('Location:/Login');
        }
    }

    public function logout(){
        unset($_SESSION['login']);
        unset($_SESSION['errorlogin']);

        header('Location:/');
    }

    public function InscriptionCheck()
    {
        if ($_POST) {
            $errMsg='';

            if(!filter_var(
                $_POST['password'],
                FILTER_VALIDATE_REGEXP,
                array(
                    "options" => array("regexp"=>"/[a-zA-Z]{3,}/")
                )
            )){
                $_SESSION['errinscription'] = "Le mot de passe ne peut être inférieur à 3 caractères";
                header('Location:/Inscription');
                unset($_SESSION['errinscription']);
                return;
            }


            if ($errMsg != '') {
                header('Location:/inscription');
            }

            else{

                $options = [
                    'salt' => md5(strtolower($_POST['Email'])),
                    'cost' => 12 // the default cost is 10
                ];
                define('PEPPER', sha1(strtolower($_POST['Email'])));
                $pwd_hashed = password_hash(($_POST['Password']) . PEPPER, PASSWORD_DEFAULT, $options);

                $user = new User();
                $user->setUtiprenom($_POST["Prenom"]);
                $user->setUtinom($_POST["Nom"]);
                $user->setUtimail(strtolower($_POST['Email']));
                $user->setUtipassword($pwd_hashed);
                $user->SqlAdd(Bdd::GetInstance());
                unset($_SESSION['errinscription']);
                header('Location:/');

            }
        } else {
            return $this->twig->render("User/inscription.html.twig");

        }
    }

    public static function roleNeed($roleATester){
        if(isset($_SESSION['login'])){
            if(!in_array($roleATester,$_SESSION['login']['roles'])){
                $_SESSION['errorlogin'] = "Manque le role : ".$roleATester;
                header('Location:/Contact');
            }
        }else{
            $_SESSION['errorlogin'] = "Veuillez vous identifier";
            header('Location:/Login');
        }
    }

}