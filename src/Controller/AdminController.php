<?php
namespace src\Controller;

use src\Model\Article;
use src\Model\Categorie;
use src\Model\Bdd;
use src\Model\User;

class AdminController extends AbstractController {
    // vue TWIG page Admin
    public function index(){
        UserController::roleNeed('administrateur');
        unset($_SESSION['errorcsschange']);
        // fichier css
        $file='master.css';
        $dataCss = file_get_contents('./asset/css/'.$file);

        // liste categories
        $categorie = new Categorie();
        $listCategorie = $categorie->SqlGetAll(Bdd::GetInstance());

        //liste email a confirmer
        $user = new User();
        $listMail = $user->SqlMailNotAprouved(Bdd::GetInstance());

        //liste article a comfirmer
        $article = new Article();
        $listArticle = $article->SqlGetAllWaiting(Bdd::GetInstance());

        return $this->twig->render('Admin/index_admin.html.twig', [
            //contenu du fichier css envoyé dans la vue
            'cssFileData' => $dataCss
            ,"listCategorie" => $listCategorie
            ,'listMail' => $listMail
            ,'listArticle' => $listArticle
        ]);
    }

    // fonction enregistrement fichier CSS
    public function sendCss(){
        if((strip_tags($_POST['cssContent']))!=($_POST['cssContent'])){
            $_SESSION['errorcsschange']="Ce code CSS n'est pas conforme";
            header("location/admin");
        }
        UserController::roleNeed('administrateur');
        $monfichier = fopen('./asset/css/master.css', 'w');
        fputs($monfichier, $_POST['cssContent']);
        fclose($monfichier);
        header('Location:/Admin');
        return;
    }


}