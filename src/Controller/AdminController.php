<?php
namespace src\Controller;

class AdminController extends AbstractController {
    public function index(){
        $file='master.css';
        $dataCss = file_get_contents('./asset/css/'.$file);
        //Lancer la vue TWIG page Admin
        return $this->twig->render('Admin/index_admin.html.twig', [
            'cssFileData' => $dataCss
        ]);
    }

    public function sendCss(){
        // fonction enregistrement fichier CSS
    }
}