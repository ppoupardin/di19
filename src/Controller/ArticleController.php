<?php
namespace src\Controller;

use src\Model\Article;
use src\Model\Bdd;
use DateTime;
use src\Model\Categorie;

class ArticleController extends AbstractController {

    public function Index(){
        return $this->ListAll();
    }

    public function ListAll(){
    $article = new Article();
    $listArticle = $article->SqlGetAll(Bdd::GetInstance());

    //Lancer la vue TWIG
    return $this->twig->render(
        'Article/list.html.twig',[
            'articleList' => $listArticle
        ]
    );
}
    public function GetLastFive(){
        $article = new Article();
        $lastfiveArticle = $article->SqlGetLastFive(Bdd::GetInstance());

        //Lancer la vue TWIG
        return $this->twig->render(
            'Article/list.html.twig',[
                'articleList' => $lastfiveArticle
            ]
        );
    }
    public function add(){
        UserController::roleNeed('redacteur');
        if($_POST){// AND $_SESSION['token'] == $_POST['token']){
            $sqlRepository = null;
            $nomImage = null;
            if(!empty($_FILES['image']['name']) )
            {
                $tabExt = array('jpg','gif','png','jpeg');    // Extensions autorisees
                $extension  = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                if(in_array(strtolower($extension),$tabExt))
                {
                    $nomImage = md5(uniqid()) .'.'. $extension;
                    $dateNow = new DateTime();
                    $sqlRepository = $dateNow->format('Y/m');
                    $repository = './uploads/images/'.$dateNow->format('Y/m');
                    if(!is_dir($repository)){
                        mkdir($repository,0777,true);
                    }
                    move_uploaded_file($_FILES['image']['tmp_name'], $repository.'/'.$nomImage);
                }
            }

            if(($_POST['Titre'])!=(trim($_POST['Titre']))){
                $_SESSION['errorarticleadd'] = "Le titre ne peut commencer ou finir par un espace";
                header('Location:/Article/Add');
                return;
            }
            if(trim($_POST['Titre']) != strip_tags(trim($_POST['Titre']))) {
                $_SESSION['errorarticleadd'] = "Le titre n'a pas une structure valide";
                header('Location:/Article/Add');
                return;
            }

            if(($_POST['Description'])!=(trim($_POST['Description']))){
                $_SESSION['errorarticleadd'] = "La description ne peut commencer ou finir par un espace";
                header('Location:/Article/Add');
                return;
            }
            if(trim($_POST['Description']) != strip_tags(trim($_POST['Description']))) {
                $_SESSION['errorarticleadd'] = "La description n'a pas une structure valide";
                header('Location:/Article/Add');
                return;
            }

            if(($_POST['DateAjout'])!=(trim($_POST['DateAjout']))){
                $_SESSION['errorarticleadd'] = "La date d'ajout ne peut commencer ou finir par un espace";
                header('Location:/Article/Add');
                return;
            }
            if(trim($_POST['DateAjout']) != strip_tags(trim($_POST['DateAjout']))) {
                $_SESSION['errorarticleadd'] = "La date d'ajout n'a pas une structure valide";
                header('Location:/Article/Add');
                return;
            }
            //die(var_dump($_POST));
            $article = new Article();
            $article->setTitre($_POST['Titre']);
            $article->setDescription($_POST['Description']);
            $article->setAuteur($_POST['Auteur']);
            $article ->setDateAjout($_POST['DateAjout']);
            $article->setImageRepository($sqlRepository);
            $article->setImageFileName($nomImage);
            $article->setStatus(0);
            $article->setIdcat($_POST['categorie']);

            $article->SqlAdd(BDD::getInstance());
            header('Location:/Article');
            unset($_SESSION['errorarticleadd']);
        }else{
            // Génération d'un TOKEN
            $token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;
            // liste categories
            $categorie = new Categorie();
            $listCategorie = $categorie->SqlGetAll(Bdd::GetInstance());
            return $this->twig->render('Article/add.html.twig',
                [
                    'token' => $token
                    ,'listCategorie' => $listCategorie
                ]);
        }
    }

    public function update($articleID){
        UserController::roleNeed('redacteur');
        $articleSQL = new Article();
        $article = $articleSQL->SqlGet(BDD::getInstance(),$articleID);
        if($_POST){
            $sqlRepository = null;
            $nomImage = null;
            if(!empty($_FILES['image']['name']) )
            {
                $tabExt = array('jpg','gif','png','jpeg');    // Extensions autorisees
                $extension  = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                if(in_array(strtolower($extension),$tabExt))
                {
                    $nomImage = md5(uniqid()) .'.'. $extension;
                    $dateNow = new DateTime();
                    $sqlRepository = $dateNow->format('Y/m');
                    $repository = './uploads/images/'.$dateNow->format('Y/m');
                    if(!is_dir($repository)){
                        mkdir($repository,0777,true);
                    }
                    move_uploaded_file($_FILES['image']['tmp_name'], $repository.'/'.$nomImage);
                    // suppression ancienne image si existante

                    if($_POST['imageAncienne'] != '/'){
                        unlink('./uploads/images/'.$_POST['imageAncienne']);
                    }
                }
            }


            if(($_POST['Titre'])!=(trim($_POST['Titre']))){
                $_SESSION['errorarticleupdate'] = "Le titre ne peut commencer ou finir par un espace";
                header('Location:/Article/Update/'.$articleID);
                return;
            }
            if(trim($_POST['Titre']) != strip_tags(trim($_POST['Titre']))) {
                $_SESSION['errorarticleupdate'] = "Le titre n'a pas une structure valide";
                header('Location:/Article/Update/'.$articleID);
                return;
            }

            if(($_POST['Description'])!=(trim($_POST['Description']))){
                $_SESSION['errorarticleupdate'] = "La description ne peut commencer ou finir par un espace";
                header('Location:/Article/Update/'.$articleID);
                return;
            }
            if(trim($_POST['Description']) != strip_tags(trim($_POST['Description']))) {
                $_SESSION['errorarticleupdate'] = "La description n'a pas une structure valide";
                header('Location:/Article/Update/'.$articleID);
                return;
            }

            if(($_POST['DateAjout'])!=(trim($_POST['DateAjout']))){
                $_SESSION['errorarticleupdate'] = "La date d'ajout ne peut commencer ou finir par un espace";
                header('Location:/Article/Update/'.$articleID);
                return;
            }
            if(trim($_POST['DateAjout']) != strip_tags(trim($_POST['DateAjout']))) {
                $_SESSION['errorarticleupdate'] = "La date d'ajout n'a pas une structure valide";
                header('Location:/Article/Update/'.$articleID);
                return;
            }

            $article->setTitre($_POST['Titre'])
                ->setDescription($_POST['Description'])
                ->setAuteur($_POST['Auteur'])
                ->setDateAjout($_POST['DateAjout'])
                ->setImageRepository($sqlRepository)
                ->setImageFileName($nomImage)
                ->setIdcat($_POST['categorie'])
                ->setStatus(0)
            ;
            $article->SqlUpdate(BDD::getInstance());
            header("location:/");
        }

        return $this->twig->render('Article/update.html.twig',[
            'article' => $article
        ]);
    }

    public function Delete($articleID){
        UserController::roleNeed('redacteur');

        $articleSQL = new Article();
        $article = $articleSQL->SqlGet(BDD::getInstance(),$articleID);
        $article->SqlDelete(BDD::getInstance(),$articleID);
        if($article->getImageFileName() != ''){
            unlink('./uploads/images/'.$article->getImageRepository().'/'.$article->getImageFileName());
        }

        header('Location:/');
    }

    public function fixtures(){
        $arrayAuteur = array('Fabien', 'Brice', 'Bruno', 'Jean-Pierre', 'Benoit', 'Emmanuel', 'Sylvie', 'Marion');
        $arrayTitre = array('PHP en force', 'React JS une valeur montante', 'C# toujours au top', 'Java en légère baisse'
        , 'Les entreprises qui recrutent', 'Les formations à ne pas rater', 'Les langages populaires en 2020', 'L\'année du Javascript');
        $arrayStatus = array('0',"1","2");
        $dateajout = new DateTime();
        $article = new Article();
        $article->SqlTruncate(BDD::getInstance());
        for($i = 1;$i <=35; $i++){
            shuffle($arrayAuteur);
            shuffle($arrayTitre);
            shuffle($arrayStatus);

            $dateajout->modify('+'.$i.' day');

            $article->setTitre($arrayTitre[0])
                ->setDescription('On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L\'avantage du Lorem Ipsum sur un texte générique comme \'Du texte. Du texte. Du texte.\' est qu\'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour \'Lorem Ipsum\' vous conduira vers de nombreux sites qui n\'en sont encore qu\'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d\'y rajouter de petits clins d\'oeil, voire des phrases embarassantes).')
                ->setDateAjout($dateajout->format('Y-m-d'))
                ->setAuteur($arrayAuteur[0])
                ->setStatus($arrayStatus[0])
            ;

            $article->SqlAdd(BDD::getInstance());
        }
        header('Location:/Article');
    }


    public function Write(){

        $article = new Article();
        $listArticle = $article->SqlGetAll(Bdd::GetInstance());

        $file = 'article.json';
        if(!is_dir('./uploads/file/')){

            mkdir('./uploads/file/', 0777, true);
        }
        file_put_contents('./uploads/file/'.$file, json_encode($listArticle));

        header('location:/Article/');
    }

    public function Read(){
        $file='article.json';
        $datas = file_get_contents('./uploads/file/'.$file);
        $contenu = json_decode($datas);

        return $this->twig->render('Article/readfile.html.twig', [
            'fileData' => $contenu
        ]);
    }

    public function WriteOne($idArticle){
        $article = new Article();
        $articleData = $article->SqlGet(Bdd::GetInstance(), $idArticle);

        $file = 'article_'.$idArticle.'.json';
        if(!is_dir('./uploads/file/')){
            mkdir('./uploads/file/', 0777, true);
        }
        file_put_contents('./uploads/file/'.$file, json_encode($articleData));

        header('location:/Article/');
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

    public function accept($idArticle){
        ArticleController::roleNeed('administrateur');
        $UserSQL = new Article();
        $UserSQL->SqlUpdateStatus(BDD::GetInstance(),$idArticle,2);
        header('Location:/Admin');
    }

    public function refused($idArticle){
        ArticleController::roleNeed('administrateur');
        $UserSQL = new Article();
        $UserSQL->SqlUpdateStatus(BDD::GetInstance(),$idArticle,1);
        header('Location:/Admin');
    }
}
