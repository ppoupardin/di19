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
        UserController::roleNeed('admin');
        if($_POST AND $_SESSION['token'] == $_POST['token']){

            $categorie = new Categorie();
            $categorie->setCategories();
            $categorie->SqlAdd(BDD::getInstance());
            header('Location:/Categorie');
        }else{
            // Génération d'un TOKEN
            $token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;
            return $this->twig->render('Categorie/add.html.twig',
                [
                    'token' => $token
                ]);
        }
    }

    public function update($categorieID){
        $categorieSQL = new Categorie();
        $categorie = $categorieSQL->SqlGet(BDD::GetInstance(),$categorieID);
        if($_POST){

            $categorie->setCategories($_POST['categorie'])
            ;

            $categorie->SqlUpdate(BDD::getInstance());
        }

        return $this->twig->render('Categorie/update.html.twig',[
            'article' => $article
        ]);
    }

    public function Delete($categorieID){
        $categorieSQL = new Categorie();
        $categorie = $categorieSQL->SqlGet(BDD::getInstance(),$categorieID);
        $categorie->SqlDelete(BDD::getInstance(),$categorieID);

        header('Location:/Admin');
    }

}