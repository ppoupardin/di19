<?php
namespace src\Controller;

use src\Model\Bdd;
use src\Model\Categorie;

class ContactController extends AbstractController{
    private $mailer;
    private $transport;

    public function __construct()
    {
        parent::__construct();
        $this->transport = (new \Swift_SmtpTransport('smtp.mailtrap.io', 2525))
            //mon mailtrap encoyez pas tous des mails là
            ->setUsername('ed56f41e29d67f')
            ->setPassword('6d79a526116781');
        $this->mailer = new \Swift_Mailer($this->transport);

    }

    public function showForm(){
        unset($_SESSION['errorcontactform']);

        $categorie = new Categorie();
        $listCategorie = $categorie->SqlGetAll(Bdd::GetInstance());

        return $this->twig->render('Contact/form.html.twig',[
            "listCategorie" => $listCategorie
        ]);
    }

    public function sendMail(){
        if(($_POST['email'])!=(trim($_POST['email']))){
            $_SESSION['errorcontactform'] = "L'Email ne peut commencer ou finir par un espace";
            header('Location:/Contact');
            return;
        }
        if(trim($_POST['email']) != strip_tags(trim($_POST['email']))) {
            $_SESSION['errorcontactform'] = "L'Email n'a pas une structure valide";
            header('Location:/Contact');
            return;
        }

        if(($_POST['nom'])!=(trim($_POST['nom']))){
            $_SESSION['errorcontactform'] = "Votre nom ne peut commencer ou finir par un espace";
            header('Location:/Contact');
            return;
        }
        if(trim($_POST['nom']) != strip_tags(trim($_POST['nom']))) {
            $_SESSION['errorcontactform'] = "Votre nom n'a pas une structure valide";
            header('Location:/Contact');
            return;
        }

        if(trim($_POST['content']) != strip_tags(trim($_POST['content']))) {
            $_SESSION['errorcontactform'] = "Le contenu de votre message n'a pas une structure valide ( balises :'<' ,'>' interdites)";
            header('Location:/Contact');
            return;
        }
    try {
        $mail = (new \Swift_Message('Contact à partir du formulaire'))
            ->setFrom([$_POST["email"] => $_POST["nom"]])
            ->setTo('contact@PWB_Domo.fr')
            ->setBody(
                $this->twig->render('Contact/mail.html.twig',
                    [
                        'message' => $_POST["content"]
                    ])
                , 'text/html'
            );
        $result = $this->mailer->send($mail);
    }catch (\Exception $err1) {
        return $this->twig->render('Contact/confirmation.html.twig',[
            'result'=>0
        ]);
    }

        return $this->twig->render('Contact/confirmation.html.twig',[
            'result'=>$result
        ]);
    }

}
