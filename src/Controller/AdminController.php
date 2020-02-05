<?php
namespace src\Controller;

class AdminController extends AbstractController {
    // vue TWIG page Admin
    public function index(){
        UserController::roleNeed('administrateur');
        $file='master.css';
        $dataCss = file_get_contents('./asset/css/'.$file);
        return $this->twig->render('Admin/index_admin.html.twig', [
            //contenu du fichier css envoyé dans la vue
            'cssFileData' => $dataCss
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