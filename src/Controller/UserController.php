<?php
namespace src\Controller;

use src\Model\Bdd;
use src\Model\Categorie;
use src\Model\User;

class UserController extends  AbstractController {

    //Chargement du twig pour la page connexion
    public function loginForm(){
        unset($_SESSION['errorlogin']);
        return $this->twig->render('User/login.html.twig');
    }

    //Chargement du twig pour la page d'inscription
    public function inscriptionForm(){
        unset($_SESSION['errorinscription']);
        unset($_SESSION['errorinscriptionhtml']);
        unset($_SESSION['errorinscriptionhtmllink']);
        return $this->twig->render('User/inscription.html.twig');
    }

    //Gestion des données entrées dans le formulaire de connexion
    public function loginCheck()
    {
        //Si on clique sur "mot de passe oublié" => On affiche l'erreur Oh mince.. C'est dommage ça !
        if($_POST['passforget']){
            $_SESSION['errorlogin'] = "Oh mince.. C'est dommage ça !";
            header('Location:/Login');
            return;
        }

        //Verifie que l'email ne contient pas uniquement des espaces
        if (trim($_POST['email']) == '') {
            $_SESSION['errorlogin'] = "Veuillez entrer une adresse Email";
            header('Location:/Login');
            return;
        }

        //Verifie que le mot de passe ne contient pas uniquement des espaces
        if (trim($_POST['password']) == '') {
            $_SESSION['errorlogin'] = "Veuillez entrer un mot de passe";
            header('Location:/Login');
            return;
        }

        //Verifie que le mot de passe ne contient pas de balises (<scritp> , <?php ,etc..)
        if(trim($_POST['password']) != strip_tags(trim($_POST['password']))) {
            $_SESSION['errorlogin'] = "Le mot de passe n'a pas une structure valide";
            header('Location:/Login');
            return;
        }

        //Verifie que l'email ne contient pas de balises (<scritp> , <?php ,etc..)
        if(trim($_POST['email']) != strip_tags(trim($_POST['email']))) {
            $_SESSION['errorlogin'] = "L'adresse email n'a pas une structure valide";
            header('Location:/Login');
            return;
        }

        //===========================Gestion d'une erreur SQL===========================================
        //Appel à la fonction qui récupère tout les emails des utilisateurs dans la base de données
        $userall = new User();
        $emails = $userall->SqlGetAllEmail(Bdd::GetInstance());
        //Prédéfinition de la variable donnant l'existence de l'email dans la bdd
        $email_exist = false;
        //Traitement : pour chaque email dans la bdd , on regarde la correspondanceavec l'email entré dans le formulaire
        foreach ($emails as $email) {
            if (strtolower(trim($_POST['email'])) == $email) {
                //Si l'email existe la variable passe à TRUE
                $email_exist = true;
            }
        }
        //Si la variable est à FALSE (l'email n'existe pas dans la BDD) on renvoi une erreur d'authentification
        if($email_exist==false){
            $_SESSION['errorlogin'] = "Email ou Mot de passe incorrect";
            header('Location:/Login');
            return;
        }
        // Cette fonctionnalité permet d'éviter d'effecter une requete dans la bdd sur un email qui n'existe pas
        //(voir suite du code)
        //===================================================================

        //===========================Hash du mot de passe(pour la verification)===========================================
        //On définit un salt et un cost
        $options = [
            //le salt est propre à chaque utilisateur
            'salt' => md5(strtolower($_POST['email'])),
            'cost' => 12 // the default cost is 10
        ];
        //on définit un pepper propre à chaque utilisateur != du salt
        define('PEPPER', sha1(strtolower($_POST['email'])));
        //hashage : On hash le mot de passe entré avec son pepper , avec l'algorythme password_default (BCRYPT)
        $pwd_hashed_entry = password_hash(($_POST['password']) . PEPPER, PASSWORD_DEFAULT, $options);
        //===========================================================================================================

        //==================================Recupération des info utilisateur en fonction de l'email entré==============
        $user = new User();
        $userInfoLog = $user->SqlGetLogin(Bdd::GetInstance(), ($_POST['email']));
        $pwd_hashed_bdd = $userInfoLog['uti_password'];
        //================================================================

        //Le status user 0 correspond à un utilisateur non vérifié , si c'est le cas pour l'utilisateur correspondant à l'email
        //On renvoi une erreur (le faire avant la verif du mdp est un choix)
        if($userInfoLog['uti_status']=='0'){
            $_SESSION['errorlogin'] = "votre compte n'a pas encore été approuvé par un administrateur";
            header('Location:/Login');
            return;
        }

        //Le status user 2 correspond à un utilisateur refusé , si c'est le cas pour l'utilisateur correspondant à l'email
        //On renvoi une erreur (le faire avant la verif du mdp est un choix)
        if($userInfoLog['uti_status']=='2'){
            $_SESSION['errorlogin'] = "votre compte a été refusé par un administrateur";
            header('Location:/Login');
            return;
        }

        //Le status user 3 correspond à un utilisateur banni , si c'est le cas pour l'utilisateur correspondant à l'email
        //On renvoi une erreur (le faire avant la verif du mdp est un choix)
        if($userInfoLog['uti_status']=='3'){
            $_SESSION['errorlogin'] = "votre compte a été banni par un administrateur";
            header('Location:/Login');
            return;

        } else {
            //=======================Vérification de la validité du mdp====================================
            //Si le mot de passe hashé entré correspond au mot de passe hashé en BDD
            if ($pwd_hashed_entry == $pwd_hashed_bdd) {
                //on crée un tableau à partir de la colonne "role" de l'utilisateur correspondant
                //(les roles sont enregistrés sous la forme d'une chaine de caractère , séparé par un espace)
                $arrayRole = explode(" ", $userInfoLog['uti_role']);
                //On enregistre dans la session 'login' : l'id , les roles , le prenom , le nom , le status , l'email
                $_SESSION['login'] = array("id" => $userInfoLog['id_uti'],
                    "roles" => $arrayRole,
                    "Prenom" => $userInfoLog['uti_prenom'],
                    "Nom" => $userInfoLog['uti_nom'],
                    "Status" => $userInfoLog['uti_status'],
                    "Email"=>$userInfoLog['uti_mail']);
                header('Location:/');
                //Si les mots de passes en correspondent pas on renvoi une erreur d'authentification
            } else {
                $_SESSION['errorlogin'] = "Email ou Mot de passe incorrect";
                header('Location:/Login');
                return;
            }
        }
    }

    //Fonction qui permet de se déconnecter (vide et supprime les session utilisateurs
    public function logout(){
        unset($_SESSION['login']);
        unset($_SESSION['errorlogin']);
        session_destroy();

        header('Location:/');
    }

    //Fonction qui traite les données renvoyer par le formulaire d'inscription
    public function InscriptionCheck()
    {
        //Si on est en méthd post
        if ($_POST) {
            //verifie que le mdp contient au moins 5 caractère sans compter les espaces en début et fin de chaine
            if(!filter_var(
                trim($_POST['Password']),
                FILTER_VALIDATE_REGEXP,
                array("options" => array("regexp"=>"/[a-zA-Z]{5,}/")))
            ){
                //Si ce n'est pas le cas on renvoi une erreur
                $_SESSION['errorinscription'] = "Le mot de passe ne peut être inférieur à 5 caractères";
                header('Location:/Inscription');
                return;
            }

            //verifie que le mot de passe ne contient pas de mot de passe en début et fin de chaine
                if(($_POST['Password'])!=(trim($_POST['Password']))){
                    $_SESSION['errorinscription'] = "Le mot de passe ne peut commencer ou finir par un espace";
                    header('Location:/Inscription');
                    return;
                }

                //de même pour le mot de passe de vérification
                if(($_POST['Password2'])!=(trim($_POST['Password2']))){
                    $_SESSION['errorinscription'] = "Le mot de passe ne peut commencer ou finir par un espace";
                    header('Location:/Inscription');
                    return;
                }

                //Verfie que le mot de passe ne contient pas de balises
                if(trim($_POST['Password']) != strip_tags(trim($_POST['Password']))) {
                    $_SESSION['errorinscription'] = "Le mot de passe n'a pas une structure valide";
                    header('Location:/Inscription');
                    return;
                }
                //idem pour le nom
                if(trim($_POST['Nom']) != strip_tags(trim($_POST['Nom']))) {
                    $_SESSION['errorinscription'] = "Le nom entré n'a pas une structure valide";
                    header('Location:/Inscription');
                    return;
                }
                //idem pour le prenom
                if(trim($_POST['Prenom']) != strip_tags(trim($_POST['Prenom']))) {
                    $_SESSION['errorinscription'] = "Le Prenom entré n'a pas une structure valide";
                    header('Location:/Inscription');
                    return;
                }
                //verifie la correspondance du champ mdp et du champ confirmation du mdp
                if(($_POST['Password'])!=($_POST['Password2'])){
                    $_SESSION['errorinscription'] = "Les mots de passe ne correspondent pas";
                    header('Location:/Inscription');
                    return;
                }

                //verifie que l'email ne contient pas de balises
                if(trim($_POST['Email']) != strip_tags(trim($_POST['Email']))) {
                    $_SESSION['errorinscription'] = "L'addresse Email n'a pas une structure valide";
                    header('Location:/Inscription');
                    return;
                }

                //=======================recupère tout les emails dans la bdd==============================
                $userall = new User();
                $emails = $userall->SqlGetAllEmail(Bdd::GetInstance());
                $email_exist = false;
                //===========================================================================
                //========================================regarde si l'email entré dans l'inscription est déjà dans la bdd
                foreach ($emails as $email) {
                    if (strtolower(trim($_POST['Email'])) == strtolower(trim($email)) ) {
                        $email_exist = true;
                    }
                }
                //===================================================================

                //Si l'email existe déjà dans la bdd on renvoi une erreur contenant un lien pour aller à la page de connexion
                if($email_exist==true){
                    $_SESSION['errorinscriptionhtmllink']='/Login';
                    $_SESSION['errorinscriptionhtml']="Se connecter";
                    $_SESSION['errorinscription'] = "L'email appartient déjà à un compte existant : ".$html;
                    header('Location:/Inscription');
                    return;

                } else {

                    //================================Hashage du mot de passe=========================
                    $options = [
                        'salt' => md5(strtolower($_POST['Email'])),
                        'cost' => 12 // the default cost is 10
                    ];
                    define('PEPPER', sha1(strtolower($_POST['Email'])));
                    $pwd_hashed = password_hash(($_POST['Password']) . PEPPER, PASSWORD_DEFAULT, $options);
                    //=======================================================================

                    //création de l'objet user qui va etre inséré dans la bdd
                    $user = new User();
                    $user->setUtiprenom(trim($_POST["Prenom"]));
                    $user->setUtinom(trim($_POST["Nom"]));
                    $user->setUtimail(strtolower(trim($_POST['Email'])));
                    $user->setUtipassword($pwd_hashed);
                    //
                    //ajout dans la bdd via la fonction adéquat dans le model
                    $user->SqlAdd(Bdd::GetInstance());
                    //defait les session error(les erreurs disparaisse apres un rafraichissement de page)
                    unset($_SESSION['errorinscription']);
                    unset($_SESSION['errorlogin']);
                    //renvoi sur la page de connexion
                    header('Location:/Login');
                }
        }
    }

    //Fonction qui permet de verifier que l'utilisateur à le bon role
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

    //Fonction qui permet de verifier que l'utilisateur à le bon id
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

    //fonction qui passer le status d'un user à 1 (appel de la fonction dans le model)
    public function accept($idUser){
        UserController::roleNeed('administrateur');
        $UserSQL = new User();
        $UserSQL->SqlUpdateStatus(BDD::GetInstance(),$idUser,1);
        header('Location:/Admin');
    }

    //fonction qui permet de passer le status d'un user à 2 (appel de la fonction dans le model)
    public function refused($idUser){
        UserController::roleNeed('administrateur');
        $UserSQL = new User();
        $UserSQL->SqlUpdateStatus(BDD::GetInstance(),$idUser,2);
        header('Location:/Admin');
    }

    //fonction qui permet de passer le status d'un user à 3 (appel de la fonction dans le model)
    public function banned($idUser){
        UserController::roleNeed('administrateur');
        $UserSQL = new User();
        $UserSQL->SqlUpdateStatus(BDD::GetInstance(),$idUser,3);
        header('Location:/Admin');
    }

    //fonction qui permet de modifier les roles d'un user (appel de la fonction dans le model)
    public function update($idUser){
        UserController::roleNeed('administrateur');
        $UserSQL = new User();
        $UserSQL->SqlUpdateRole(BDD::GetInstance(),$idUser);
        header('Location:/Admin');
    }


    //fonction qui permet d'afficher le profil
    public function ShowProfil($idUser){
        //verification que le profil concerné appartient bien à l'utilisateur concerné
        UserController::idNeed($idUser);

        //on regarde si l'utilisateur possède un token ou non
        $user = new User();
        $userTokenArray = $user->SqlHaveToken(Bdd::GetInstance(), $idUser);
        $UserToken=$userTokenArray['uti_token'];

        //recupère toute les catégorie des articles
        $categorie = new Categorie();
        $listCategorie = $categorie->SqlGetAll(Bdd::GetInstance());

        //permet de retirer les messages d'infos après un refresh
        unset($_SESSION['infoprofil']);
        return $this->twig->render('User/profil.html.twig',[
            "tokenUser"=>$UserToken
            ,"listCategorie" => $listCategorie
        ]);
    }

    //fonction qui permetTRA (amélioration continue m'voyez) de modifier son email , nom , prenom directement depuis le profil
    public function UpdateProfil($idUser){
        UserController::idNeed($idUser);
        $_SESSION['infoprofil']="Cette fonctionnalité n'est pas encore disponible";
        header('Location:/Profile/'.$idUser);
    }
}