<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* User/login.html.twig */
class __TwigTemplate_127b873b4fba811396dd95a6392a5802a1398a76a883adc0a782792997221055 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>

<html lang=\"en\">

<head>

    <meta charset=\"UTF-8\">

    <title>PWB-Domo - Connexion</title>

    <link rel=\"stylesheet\" href=\"https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css\">

    <link rel=\"stylesheet\" href=\"/Asset/styleinscription&connexion.css\">

</head>




<body id=\"connexion\">

<div class=\"content\">


    <div class=\"container\">

        ";
        // line 27
        if (twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "errorlogin", [], "any", true, true, false, 27)) {
            // line 28
            echo "            <div class=\"alert alert-danger\"
            style=\"position: absolute;
            width:90%;
            top:15px;
            left:5%;
            border-radius: 10px;
            border-width: 1px;
            border-style: solid\">
                <p style=\"text-align: center\">";
            // line 36
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["session"] ?? null), "errorlogin", [], "any", false, false, false, 36), "html", null, true);
            echo "</p>
            </div>
        ";
        }
        // line 39
        echo "

        <div class=\"menu\">




            <a href=\"login\" class=\"btn-connexion\">

                <h2>Se Connecter</h2>

            </a>

            <a href=\"inscription\" class=\"btn-enregistrer
active\">


                <h2>S'inscrire</h2>

            </a>

        </div>

        <div class=\"connexion\">


            <form class=\"contact-form\" name=\"connexion\" method=\"post\" action=\"/Login\">

                <label>Identifiant</label>

                <input name=\"email\" placeholder=\"\" type=\"email\">


                <label>Mot de passe</label>

                <input name=\"password\" placeholder=\"\" type=\"password\">

                <div class=\"check\">

                    <label>

                        <input id=\"check\" type=\"checkbox\" class=\"checkbox\">

                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"26px\" height=\"23px\">

                            <path class=\"path-back\"
                                  d=\"M1.5,6.021V2.451C1.5,2.009,1.646,1.5,2.3,1.5h18.4c0.442,0,0.8,0.358,0.8,0.801v18.398c0,0.442-0.357,0.801-0.8,0.801H2.3c-0.442,0-0.8-0.358-0.8-0.801V6\">

                            </path>

                            <path class=\"path-moving\"
                                  d=\"M24.192,3.813L11.818,16.188L1.5,6.021V2.451C1.5,2.009,1.646,1.5,2.3,1.5h18.4c0.442,0,0.8,0.358,0.8,0.801v18.398c0,0.442-0.357,0.801-0.8,0.801H2.3c-0.442,0-0.8-0.358-0.8-0.801V6\">

                            </path>

                        </svg>

                    </label>

                    <h3>Restez connecté</h3>

                </div>

                <input class=\"submit\" value=\"Connexion\" type=\"submit\">

            </form>

            <hr>

            <a href=\"https://www.grandvincent-marion.fr/\" target=\"_blank\">

                <h4>Mot de passe Oublié ? </h4>

            </a>

        </div>



    </div>


</body>




</html>";
    }

    public function getTemplateName()
    {
        return "User/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 39,  77 => 36,  67 => 28,  65 => 27,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>

<html lang=\"en\">

<head>

    <meta charset=\"UTF-8\">

    <title>PWB-Domo - Connexion</title>

    <link rel=\"stylesheet\" href=\"https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css\">

    <link rel=\"stylesheet\" href=\"/Asset/styleinscription&connexion.css\">

</head>




<body id=\"connexion\">

<div class=\"content\">


    <div class=\"container\">

        {% if session.errorlogin is defined %}
            <div class=\"alert alert-danger\"
            style=\"position: absolute;
            width:90%;
            top:15px;
            left:5%;
            border-radius: 10px;
            border-width: 1px;
            border-style: solid\">
                <p style=\"text-align: center\">{{ session.errorlogin }}</p>
            </div>
        {% endif %}


        <div class=\"menu\">




            <a href=\"login\" class=\"btn-connexion\">

                <h2>Se Connecter</h2>

            </a>

            <a href=\"inscription\" class=\"btn-enregistrer
active\">


                <h2>S'inscrire</h2>

            </a>

        </div>

        <div class=\"connexion\">


            <form class=\"contact-form\" name=\"connexion\" method=\"post\" action=\"/Login\">

                <label>Identifiant</label>

                <input name=\"email\" placeholder=\"\" type=\"email\">


                <label>Mot de passe</label>

                <input name=\"password\" placeholder=\"\" type=\"password\">

                <div class=\"check\">

                    <label>

                        <input id=\"check\" type=\"checkbox\" class=\"checkbox\">

                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"26px\" height=\"23px\">

                            <path class=\"path-back\"
                                  d=\"M1.5,6.021V2.451C1.5,2.009,1.646,1.5,2.3,1.5h18.4c0.442,0,0.8,0.358,0.8,0.801v18.398c0,0.442-0.357,0.801-0.8,0.801H2.3c-0.442,0-0.8-0.358-0.8-0.801V6\">

                            </path>

                            <path class=\"path-moving\"
                                  d=\"M24.192,3.813L11.818,16.188L1.5,6.021V2.451C1.5,2.009,1.646,1.5,2.3,1.5h18.4c0.442,0,0.8,0.358,0.8,0.801v18.398c0,0.442-0.357,0.801-0.8,0.801H2.3c-0.442,0-0.8-0.358-0.8-0.801V6\">

                            </path>

                        </svg>

                    </label>

                    <h3>Restez connecté</h3>

                </div>

                <input class=\"submit\" value=\"Connexion\" type=\"submit\">

            </form>

            <hr>

            <a href=\"https://www.grandvincent-marion.fr/\" target=\"_blank\">

                <h4>Mot de passe Oublié ? </h4>

            </a>

        </div>



    </div>


</body>




</html>", "User/login.html.twig", "C:\\Users\\langl\\Desktop\\Cours\\Projets\\BlogPHP\\templates\\User\\login.html.twig");
    }
}
