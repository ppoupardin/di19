<?php
namespace src\Model;

class Categorie implements \JsonSerializable {

    private $idCat;
    private $categories;

    public function jsonSerialize()
    {
        return [
            'id' => $this->getIdCat(),
            'categorie' => $this->getCategories()
        ];
    }

    public function SqlAdd(\PDO $bdd)
    {
        $query = $bdd->prepare('INSERT INTO categorie (cat_libelle) VALUES (:cat_libelle)');
        $query->execute([
            "cat_libelle" => $this->getCategories()
        ]);
    }

    public function SqlGetAll(\PDO $bdd){
        $requete = $bdd->prepare('SELECT * FROM categorie');
        $requete->execute();
        $arrayCategorie = $requete->fetchAll();

        $listCategorie = [];
        foreach ($arrayCategorie as $categorieSQL){
            $categorie = new Categorie();
            $categorie->setIdCat($categorieSQL['id_cat']);
            $categorie->setCategories($categorieSQL['cat_libelle']);

            $listCategorie[] = $categorie;
        }
        return $listCategorie;
    }

    public function SqlGet(\PDO $bdd,$idCategorie){
        $requete = $bdd->prepare('SELECT * FROM categorie where id_cat = :idCategorie');
        $requete->execute([
            'idCategorie' => $idCategorie
        ]);

        $datas =  $requete->fetch();
        $categorie = new Categorie();
        $categorie->setIdCat($datas['id_cat']);
        $categorie->setCategories($datas['cat_libelle']);

        return $categorie;
    }

    public function SqlUpdate(\PDO $bdd){
        try{
            $requete = $bdd->prepare('UPDATE categorie set cat_libelle=:cat_libelle WHERE id_cat=:id_cat');
            $requete->execute([
                'id_cat' => $this->getIdCat()
                ,'cat_libelle' => $this->getCategories()
            ]);
            return array("0", "[OK] Update");
        }catch (\Exception $e){
            return array("1", "[ERREUR] ".$e->getMessage());
        }
    }

    public function SqlDelete (\PDO $bdd,$idCategorie){
        try{
            $requete = $bdd->prepare('DELETE FROM categorie where id_cat = :id_cat');
            $requete->execute([
                'id_cat' => $idCategorie
            ]);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return mixed
     */
    public function getIdCat()
    {
        return $this->idCat;
    }

    /**
     * @param mixed $idCat
     */
    public function setIdCat($idCat)
    {
        $this->idCat = $idCat;
    }
}