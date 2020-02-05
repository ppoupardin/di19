<?php
namespace src\Model;

class User implements \JsonSerializable
{

    private $iduti;
    private $utimail;
    private $utinom;
    private $utiprenom;
    private $utitoken;
    private $utirole;
    private $utistatus;
    private $utipassword;

    /**
     * @return mixed
     */
    public function getIduti()
    {
        return $this->iduti;
    }

    /**
     * @param mixed $iduti
     */
    public function setIduti($iduti)
    {
        $this->iduti = $iduti;
    }

    /**
     * @return mixed
     */
    public function getUtimail()
    {
        return $this->utimail;
    }

    /**
     * @param mixed $utimail
     */
    public function setUtimail($utimail)
    {
        $this->utimail = $utimail;
    }

    /**
     * @return mixed
     */
    public function getUtinom()
    {
        return $this->utinom;
    }

    /**
     * @param mixed $utinom
     */
    public function setUtinom($utinom)
    {
        $this->utinom = $utinom;
    }

    /**
     * @return mixed
     */
    public function getUtiprenom()
    {
        return $this->utiprenom;
    }

    /**
     * @param mixed $utiprenom
     */
    public function setUtiprenom($utiprenom)
    {
        $this->utiprenom = $utiprenom;
    }

    /**
     * @return mixed
     */
    public function getUtitoken()
    {
        return $this->utitoken;
    }

    /**
     * @param mixed $utitoken
     */
    public function setUtitoken($utitoken)
    {
        $this->utitoken = $utitoken;
    }

    /**
     * @return mixed
     */
    public function getUtirole()
    {
        return $this->utirole;
    }

    /**
     * @param mixed $utirole
     */
    public function setUtirole($utirole)
    {
        $this->utirole = $utirole;
    }

    /**
     * @return mixed
     */
    public function getUtistatus()
    {
        return $this->utistatus;
    }

    /**
     * @param mixed $utistatus
     */
    public function setUtistatus($utistatus)
    {
        $this->utistatus = $utistatus;
    }

    /**
     * @return mixed
     */
    public function getUtipassword()
    {
        return $this->utipassword;
    }

    /**
     * @param mixed $utipassword
     */
    public function setUtipassword($utipassword)
    {
        $this->utipassword = $utipassword;
    }


    public function jsonSerialize()
    {
        return [
            'Iduti' => $this->getIduti(),
            'utimail' => $this->getUtimail(),
            'utinom' => $this->getUtinom(),
            'utiprenom' => $this->getUtiprenom(),
            'utitoken' => $this->getUtitoken(),
            'utirole' => $this->getUtirole(),
            'utistatus' => $this->getUtistatus(),
            'utipassword' => $this->getUtipassword()
        ];
    }

    public function SqlAdd(\PDO $bdd)
    {
        $query = $bdd->prepare('INSERT INTO utilisateur (uti_prenom, uti_nom, uti_password, uti_mail) VALUES (:prenom, :nom, :password, :email)');
        $query->execute([
            "prenom" => $this->getUtiprenom(),
            "nom" => $this->getUtinom(),
            "password" => $this->getUtipassword(),
            "email" => $this->getUtimail()
        ]);
    }

    public function SqlGetAllEmail(\PDO $bdd){

        $query = $bdd->prepare("SELECT uti_mail FROM utilisateur WHERE uti_status='1'");
        $query->execute();
        $arrayUser = $query->fetchAll();

        $emailUsers = [];
        foreach ($arrayUser as $userSQL){
            $user = new User();
            $user->setUtimail(strtolower($userSQL['USER_EMAIL']));

            $emailUsers[] = $user;
        }
        return $emailUsers;
    }

    public function SqlGetLogin(\PDO $bdd , $emailuser){
        $query = $bdd->prepare('SELECT uti_password, id_uti, uti_role, uti_prenom, uti_nom, uti_status FROM utilisateur WHERE uti_mail = :useremail');
        $query->execute([
            'useremail' => $emailuser
        ]);

        $UserInfoLog = $query->fetch();
        $user = new User();
        $user->setUtipassword($UserInfoLog['uti_password']);
        $user->setIduti($UserInfoLog['id_uti']);
        $user->setUtirole($UserInfoLog['uti_role']);
        $user->setUtiprenom($UserInfoLog['uti_prenom']);
        $user->setUtinom($UserInfoLog['uti_nom']);
        $user->setUtistatus($UserInfoLog['uti_status']);

        $UserInfoLog[] = $user;

        return $UserInfoLog;
    }

}
