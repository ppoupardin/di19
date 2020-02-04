<?php
namespace src\Controller;

class AdminController extends AbstractController {
    // vue TWIG page Admin
    public function index(){
        $file='master.css';
        $dataCss = file_get_contents('./asset/css/'.$file);
        return $this->twig->render('Admin/index_admin.html.twig', [
            'cssFileData' => $dataCss
        ]);
    }

    // fonction enregistrement fichier CSS
    public function sendCss(){
        $monfichier = fopen('./asset/css/master.css', 'w');
        fputs($monfichier, $_POST['cssContent']);
        fclose($monfichier);
        header('Location:/Admin');
        return;
    }
}