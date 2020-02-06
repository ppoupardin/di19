<?php
namespace src\Controller;

use src\Model\Bdd;
use src\Model\User;

class UserController extends  AbstractController {

    public function loginForm(){
        unset($_SESSION['errorlogin']);
        return $this->twig->render('User/login.html.twig');
    }
    public function inscriptionForm(){
        unset($_SESSION['errorinscription']);
        unset($_SESSION['errorinscriptionhtml']);
        unset($_SESSION['errorinscriptionhtmllink']);
        return $this->twig->render('User/inscription.html.twig');
    }

    public function loginCheck()
    {


        if (trim($_POST['email']) == '') {
            $_SESSION['errorlogin'] = "Veuillez entrer une adresse Email";
            header('Location:/Login');
            return;
        }
        if (trim($_POST['password']) == '') {
            $_SESSION['errorlogin'] = "Veuillez entrer un mot de passe";
            header('Location:/Login');
            return;
        }
        if(trim($_POST['password']) != strip_tags(trim($_POST['password']))) {
            $_SESSION['errorlogin'] = "Le mot de passe n'a pas une structure valide";
            header('Location:/Login');
            return;
        }
        if(trim($_POST['email']) != strip_tags(trim($_POST['email']))) {
            $_SESSION['errorlogin'] = "L'adresse email n'a pas une structure valide";
            header('Location:/Login');
            return;
        }
        $userall = new User();
        $emails = $userall->SqlGetAllEmail(Bdd::GetInstance());
        $email_exist = false;
        foreach ($emails as $email) {
            if (strtolower(trim($_POST['email'])) == $email) {
                $email_exist = true;
            }
        }
        var_dump($email_exist);
        if($email_exist==false){
            $_SESSION['errorlogin'] = "Email ou Mot de passe incorrect";
            header('Location:/Login');
            return;
        }
        $options = [
            'salt' => md5(strtolower($_POST['email'])),
            'cost' => 12 // the default cost is 10
        ];
        define('PEPPER', sha1(strtolower($_POST['email'])));
        $pwd_hashed_entry = password_hash(($_POST['password']) . PEPPER, PASSWORD_DEFAULT, $options);
        $user = new User();
        $userInfoLog = $user->SqlGetLogin(Bdd::GetInstance(), ($_POST['email']));
        $pwd_hashed_bdd = $userInfoLog['uti_password'];

        if($userInfoLog['uti_status']=='0'){
            $_SESSION['errorlogin'] = "votre compte n'a pas encore été approuvé par un administrateur";
            header('Location:/Login');
            return;
        }
        if($userInfoLog['uti_status']=='2'){
            $_SESSION['errorlogin'] = "votre compte a été refusé par un administrateur";
            header('Location:/Login');
            return;
        }
        if($userInfoLog['uti_status']=='3'){
            $_SESSION['errorlogin'] = "votre compte a été banni par un administrateur";
            header('Location:/Login');
            return;
        }
        else {
            if ($pwd_hashed_entry == $pwd_hashed_bdd) {
                $arrayRole = explode(" ", $userInfoLog['uti_role']);
                $_SESSION['login'] = array("id" => $userInfoLog['id_uti'],
                    "roles" => $arrayRole,
                    "Prenom" => $userInfoLog['uti_prenom'],
                    "Nom" => $userInfoLog['uti_nom'],
                    "Status" => $userInfoLog['uti_status'],
                    "Email"=>$userInfoLog['uti_mail']);
                header('Location:/');
            } else {
                $_SESSION['errorlogin'] = "Email ou Mot de passe incorrect";
                header('Location:/Login');
                return;
            }
        }
    }

    public function logout(){
        unset($_SESSION['login']);
        unset($_SESSION['errorlogin']);
        session_destroy();

        header('Location:/');
    }

    public function InscriptionCheck()
    {
        if ($_POST) {
            if(!filter_var(
                trim($_POST['Password']),
                FILTER_VALIDATE_REGEXP,
                array(
                    "options" => array("regexp"=>"/[a-zA-Z]{5,}/")
                )
            )){
                $_SESSION['errorinscription'] = "Le mot de passe ne peut être inférieur à 5 caractères";
                header('Location:/Inscription');
                return;
            }
                if(($_POST['Password'])!=(trim($_POST['Password']))){
                    $_SESSION['errorinscription'] = "Le mot de passe ne peut commencer ou finir par un espace";
                    header('Location:/Inscription');
                    return;
                }
                if(($_POST['Password2'])!=(trim($_POST['Password2']))){
                    $_SESSION['errorinscription'] = "Le mot de passe ne peut commencer ou finir par un espace";
                    header('Location:/Inscription');
                    return;
                }
                if(trim($_POST['Password']) != strip_tags(trim($_POST['Password']))) {
                    $_SESSION['errorinscription'] = "Le mot de passe n'a pas une structure valide";
                    header('Location:/Inscription');
                    return;
                }
                if(trim($_POST['Nom']) != strip_tags(trim($_POST['Nom']))) {
                    $_SESSION['errorinscription'] = "Le nom entré n'a pas une structure valide";
                    header('Location:/Inscription');
                    return;
                }
                if(trim($_POST['Prenom']) != strip_tags(trim($_POST['Prenom']))) {
                    $_SESSION['errorinscription'] = "Le Prenom entré n'a pas une structure valide";
                    header('Location:/Inscription');
                    return;
                }
                if(($_POST['Password'])!=($_POST['Password2'])){
                    $_SESSION['errorinscription'] = "Les mots de passe ne correspondent pas";
                    header('Location:/Inscription');
                    return;
                }

                if(trim($_POST['Email']) != strip_tags(trim($_POST['Email']))) {
                    $_SESSION['errorinscription'] = "L'addresse Email n'a pas une structure valide";
                    header('Location:/Inscription');
                    return;
                }
                $userall = new User();
                $emails = $userall->SqlGetAllEmail(Bdd::GetInstance());
                $email_exist = false;
                foreach ($emails as $email) {
                    if (strtolower(trim($_POST['Email'])) == strtolower(trim($email)) ) {
                        $email_exist = true;
                    }
                }
                if($email_exist==true){
                    $_SESSION['errorinscriptionhtmllink']='/Login';
                    $_SESSION['errorinscriptionhtml']="Se connecter";
                    $_SESSION['errorinscription'] = "L'email appartient déjà à un compte existant : ".$html;
                    header('Location:/Inscription');
                    return;
                }
                else {

                    $options = [
                        'salt' => md5(strtolower($_POST['Email'])),
                        'cost' => 12 // the default cost is 10
                    ];
                    define('PEPPER', sha1(strtolower($_POST['Email'])));
                    $pwd_hashed = password_hash(($_POST['Password']) . PEPPER, PASSWORD_DEFAULT, $options);

                    $user = new User();
                    $user->setUtiprenom(trim($_POST["Prenom"]));
                    $user->setUtinom(trim($_POST["Nom"]));
                    $user->setUtimail(strtolower(trim($_POST['Email'])));
                    $user->setUtipassword($pwd_hashed);
                    $user->SqlAdd(Bdd::GetInstance());
                    unset($_SESSION['errorinscription']);
                    unset($_SESSION['errorlogin']);
                    header('Location:/Login');

                }
        }
    }

    public static function roleNeed($roleATester){
        if(isset($_SESSION['login'])){
            if(!in_array($roleATester,$_SESSION['login']['roles'])){
                $_SESSION['errorlogin'] = "Vous n'êtes pas ".$roleATester;
                header('Location:/Login');
            }
        }else{
            $_SESSION['errorlogin'] = "Veuillez-vous identifier";
            header('Location:/Login');
        }
    }
    public static function idNeed($idATester){
        if(isset($_SESSION['login'])){
            if($idATester!=($_SESSION['login']['id'])){
                    $_SESSION['errorlogin'] = "Le compte n°" . $idATester . " ne vous appartient pas";
                    header('Location:/Login');
            }
        }else{
            $_SESSION['errorlogin'] = "Veuillez-vous identifier";
            header('Location:/Login');
        }
    }

    public function accept($idUser){
        UserController::roleNeed('administrateur');
        $UserSQL = new User();
        $UserSQL->SqlUpdateStatus(BDD::GetInstance(),$idUser,1);
        header('Location:/Admin');
    }

    public function refused($idUser){
        UserController::roleNeed('administrateur');
        $UserSQL = new User();
        $UserSQL->SqlUpdateStatus(BDD::GetInstance(),$idUser,2);
        header('Location:/Admin');
    }

    public function banned($idUser){
        UserController::roleNeed('administrateur');
        $UserSQL = new User();
        $UserSQL->SqlUpdateStatus(BDD::GetInstance(),$idUser,3);
        header('Location:/Admin');
    }

    public function ShowProfil($idUser){
        UserController::idNeed($idUser);
        $user = new User();
        $userTokenArray = $user->SqlHaveToken(Bdd::GetInstance(), $idUser);
        $UserToken=$userTokenArray['uti_token'];
        unset($_SESSION['infoprofil']);
        return $this->twig->render('User/profil.html.twig',[
            "tokenUser"=>$UserToken
        ]);
    }

    public function UpdateProfil($idUser){
        UserController::idNeed($idUser);
        $_SESSION['infoprofil']="Cette fonctionnalité n'est pas encore disponible";
        header('Location:/Profile/'.$idUser);

    }
}