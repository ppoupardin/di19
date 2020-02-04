<?php
namespace src\Controller;

class AdminController extends AbstractController {
    public function index(){
        //Lancer la vue TWIG
        return $this->twig->render('Admin/index_admin.html.twig');
    }
}