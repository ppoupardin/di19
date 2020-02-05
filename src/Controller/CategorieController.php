<?php
namespace  src\Controller;

use src\Model\Bdd;
use src\Model\Categorie;

class CategorieController extends AbstractController {
    public function ListAll(){
        $categorie = new Categorie();
        $listCategorie = $categorie->SqlGetAll(Bdd::GetInstance());

        //Lancer la vue TWIG
        return $this->twig->render(
            'Categorie/list.html.twig',[
                'listCategorie' => $listCategorie
            ]
        );
    }

    public function add(){
        UserController::roleNeed('administrateur');
        //if($_POST AND $_SESSION['token'] == $_POST['token']){
        if($_POST){
            $categorie = new Categorie();
            $categorie->setCategories($_POST['categorie']);
            $categorie->SqlAdd(BDD::getInstance());
            header('Location:/Admin');
        }
    }

    public function update($categorieID){
        UserController::roleNeed('administrateur');
        $categorieSQL = new Categorie();
        $categorie = $categorieSQL->SqlGet(BDD::GetInstance(),$categorieID);
        //if($_POST AND $_SESSION['token'] == $_POST['token']){
        if($_POST){
            $categorie->setCategories($_POST['categorie']);
            $categorie->SqlUpdate(BDD::getInstance());
            header('Location:/Admin');
        }
    }

    public function Delete($categorieID){
        UserController::roleNeed('administrateur');
        //if($_POST AND $_SESSION['token'] == $_POST['token']){
            $categorieSQL = new Categorie();
            $categorie = $categorieSQL->SqlGet(BDD::getInstance(),$categorieID);
            $categorie->SqlDelete(BDD::getInstance(),$categorieID);
        //]
        header('Location:/Admin');
    }

}