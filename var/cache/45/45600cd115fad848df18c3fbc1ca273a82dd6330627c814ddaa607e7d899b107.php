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

/* User/inscription.html.twig */
class __TwigTemplate_b4bfdacba71500995318f37a5db467329b572044d9bf756f6fc7da1056c0ae16 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "
<!DOCTYPE html>

<html lang=\"en\">

<head>

    <meta charset=\"UTF-8\">

    <title>PWB-Domo - Inscription</title>

    <link rel=\"stylesheet\" href=\"https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css\">

    <link rel=\"stylesheet\" href=\"/Asset/styleinscription.css\">

</head>



";
        // line 20
        $this->displayBlock('body', $context, $blocks);
        // line 112
        echo "



</html>";
    }

    // line 20
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 21
        echo "    </a></div>

    <div class=\"content\">

        <div class=\"container\">


            <div class=\"menu\">

                <a href=\"connexion\" class=\"btn-enregistrer
                active\">


                    <h2>Se Connecter</h2>

                </a>

                <a href=\"inscription\" class=\"btn-connexion\"></a>

                <h2>S'inscrire</h2>

                </a>

            </div>



            <div class=\"enregistrer\">

                <form name=\"inscription\" class=\"contact-form\" method=\"post\" enctype=\"multipart/form-data\">

                    <div class=\"form-group row\">
                        <label>Nom</label>
                        <input name=\"Nom\" placeholder=\"\" type=\"text\" class=\"form-control\" required>
                    </div>
                    <div class=\"form-group row\">
                        <label>Prénom</label>
                        <input name=\"Prenom\" placeholder=\"\" type=\"text\" class=\"form-control\" required>
                    </div>
                    <div class=\"form-group row\">
                        <label>E-mail</label>
                        <input name=\"Email\" placeholder=\"\" type=\"text\" class=\"form-control\" required
                               pattern=\"^(([-\\w\\d]+)(\\.[-\\w\\d]+)*@([-\\w\\d]+)(\\.[-\\w\\d]+)*(\\.([a-zA-Z]{2,5}|[\\d]{1,3})){1,2})\$\"
                        >
                    </div>
                    <div class=\"form-group row\">
                        <label>Mot de passe</label>
                        <input name=\"Password\" placeholder=\"\" type=\"password\" class=\"form-control\" required>
                    </div>
                    <div class=\"form-group row\">
                        <label>Confirmation de mot de passe</label>
                        <input name=\"Password2\" placeholder=\"\" type=\"password\" class=\"form-control\" required>
                    </div>
                    <div class=\"check\">

                        <label>

                            <input id=\"check\" type=\"checkbox\" class=\"checkbox\" required
                                   aria-required=\"true\">

                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"26px\" height=\"23px\">

                                <path class=\"path-back\"
                                      d=\"M1.5,6.021V2.451C1.5,2.009,1.646,1.5,2.3,1.5h18.4c0.442,0,0.8,0.358,0.8,0.801v18.398c0,0.442-0.357,0.801-0.8,0.801H2.3c-0.442,0-0.8-0.358-0.8-0.801V6\">

                                </path>

                                <path class=\"path-moving\"
                                      d=\"M24.192,3.813L11.818,16.188L1.5,6.021V2.451C1.5,2.009,1.646,1.5,2.3,1.5h18.4c0.442,0,0.8,0.358,0.8,0.801v18.398c0,0.442-0.357,0.801-0.8,0.801H2.3c-0.442,0-0.8-0.358-0.8-0.801V6\">

                                </path>

                            </svg>

                        </label>

                        <h3>J'accepte les conditions d'utilisation</h3>

                    </div>

                    <input class=\"submit\" value=\"S'inscrire\" type=\"submit\">

                </form>

            </div>

        </div>

    </div>

";
    }

    public function getTemplateName()
    {
        return "User/inscription.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  73 => 21,  69 => 20,  61 => 112,  59 => 20,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
<!DOCTYPE html>

<html lang=\"en\">

<head>

    <meta charset=\"UTF-8\">

    <title>PWB-Domo - Inscription</title>

    <link rel=\"stylesheet\" href=\"https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css\">

    <link rel=\"stylesheet\" href=\"/Asset/styleinscription.css\">

</head>



{% block body %}
    </a></div>

    <div class=\"content\">

        <div class=\"container\">


            <div class=\"menu\">

                <a href=\"connexion\" class=\"btn-enregistrer
                active\">


                    <h2>Se Connecter</h2>

                </a>

                <a href=\"inscription\" class=\"btn-connexion\"></a>

                <h2>S'inscrire</h2>

                </a>

            </div>



            <div class=\"enregistrer\">

                <form name=\"inscription\" class=\"contact-form\" method=\"post\" enctype=\"multipart/form-data\">

                    <div class=\"form-group row\">
                        <label>Nom</label>
                        <input name=\"Nom\" placeholder=\"\" type=\"text\" class=\"form-control\" required>
                    </div>
                    <div class=\"form-group row\">
                        <label>Prénom</label>
                        <input name=\"Prenom\" placeholder=\"\" type=\"text\" class=\"form-control\" required>
                    </div>
                    <div class=\"form-group row\">
                        <label>E-mail</label>
                        <input name=\"Email\" placeholder=\"\" type=\"text\" class=\"form-control\" required
                               pattern=\"^(([-\\w\\d]+)(\\.[-\\w\\d]+)*@([-\\w\\d]+)(\\.[-\\w\\d]+)*(\\.([a-zA-Z]{2,5}|[\\d]{1,3})){1,2})\$\"
                        >
                    </div>
                    <div class=\"form-group row\">
                        <label>Mot de passe</label>
                        <input name=\"Password\" placeholder=\"\" type=\"password\" class=\"form-control\" required>
                    </div>
                    <div class=\"form-group row\">
                        <label>Confirmation de mot de passe</label>
                        <input name=\"Password2\" placeholder=\"\" type=\"password\" class=\"form-control\" required>
                    </div>
                    <div class=\"check\">

                        <label>

                            <input id=\"check\" type=\"checkbox\" class=\"checkbox\" required
                                   aria-required=\"true\">

                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"26px\" height=\"23px\">

                                <path class=\"path-back\"
                                      d=\"M1.5,6.021V2.451C1.5,2.009,1.646,1.5,2.3,1.5h18.4c0.442,0,0.8,0.358,0.8,0.801v18.398c0,0.442-0.357,0.801-0.8,0.801H2.3c-0.442,0-0.8-0.358-0.8-0.801V6\">

                                </path>

                                <path class=\"path-moving\"
                                      d=\"M24.192,3.813L11.818,16.188L1.5,6.021V2.451C1.5,2.009,1.646,1.5,2.3,1.5h18.4c0.442,0,0.8,0.358,0.8,0.801v18.398c0,0.442-0.357,0.801-0.8,0.801H2.3c-0.442,0-0.8-0.358-0.8-0.801V6\">

                                </path>

                            </svg>

                        </label>

                        <h3>J'accepte les conditions d'utilisation</h3>

                    </div>

                    <input class=\"submit\" value=\"S'inscrire\" type=\"submit\">

                </form>

            </div>

        </div>

    </div>

{% endblock %}




</html>", "User/inscription.html.twig", "C:\\Users\\langl\\Desktop\\Cours\\Projets\\BlogPHP\\templates\\User\\inscription.html.twig");
    }
}
