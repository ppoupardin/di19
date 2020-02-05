<?php
namespace src\Controller;

use src\Model\Categorie;
use src\Model\Bdd;

class AdminController extends AbstractController {
    // vue TWIG page Admin
    public function index(){
        UserController::roleNeed('administrateur');
        // fichier css
        $file='master.css';
        $dataCss = file_get_contents('./asset/css/'.$file);
        // liste categories
        $categorie = new Categorie();
        $listCategorie = $categorie->SqlGetAll(Bdd::GetInstance());

        return $this->twig->render('Admin/index_admin.html.twig', [
            //contenu du fichier css envoyé dans la vue
            'cssFileData' => $dataCss
            ,"listCategorie" => $listCategorie
        ]);
    }

    // fonction enregistrement fichier CSS
    public function sendCss(){
        UserController::roleNeed('administrateur');
        $monfichier = fopen('./asset/css/master.css', 'w');
        fputs($monfichier, $_POST['cssContent']);
        fclose($monfichier);
        header('Location:/Admin');
        return;
    }
}