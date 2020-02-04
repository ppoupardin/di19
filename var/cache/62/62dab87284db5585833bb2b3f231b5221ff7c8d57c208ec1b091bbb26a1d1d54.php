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

/* index.html.twig */
class __TwigTemplate_9aad8e3476ea312996b1f864356765d7ae6abe013ea566ecb7bd16bc01310032 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'css' => [$this, 'block_css'],
            'body' => [$this, 'block_body'],
            'javascript' => [$this, 'block_javascript'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\">
    <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\">
    <link rel=\"stylesheet\" href=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/pepper-grinder/jquery-ui.css\">
    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.8.1/css/all.css\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css\">
    <link rel=\"stylesheet\" href=\"./asset/css/master.css\">
    ";
        // line 11
        $this->displayBlock('css', $context, $blocks);
        // line 12
        echo "</head>

<body>

    <!--Barre de navigation>-->
<nav class=\"navbar sticky-top nav-pills navbar-expand-lg navbar-dark bg-dark\">
    <a class=\"navbar-brand\" href=\"/Article/ListAll\">Blog de PWB Domo</a>
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo02\" aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
    </button>
    <div class=\"collapse navbar-collapse\" id=\"navbarTogglerDemo02\">
        <ul class=\"navbar-nav mr-auto mt-2 mt-lg-0\">
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/Login\">Connexion</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/Inscription\">Inscription</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/Article/Add\">Ajout d'un article</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/Admin\">Administrateur</a>
            </li>
        </ul>

        <!--liste déroulante de catégories dans la Recherche -->
        <form class=\"form-inline\" method=\"search\" action=\"/Catégorie/Show/";
        // line 39
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["post"] ?? null), "search", [], "any", false, false, false, 39), "html", null, true);
        echo "\">
            <select name=\"Catégorie\" id=\"catégo-select\">
                <option value=\"Toutes les catégories\">Toutes les catégories</option>
                <option value=\"Alarme\">Alarme</option>
                <option value=\"Eclairage\">Eclairage</option>
                <option value=\"Détecteur\">Détecteur</option>
                <option value=\"Chauffage\">Chauffage</option>
                <option value=\"Motorisation\">Motorisation</option>
                <option value=\"Electro\">Electroménager</option>
                <option value=\"EquipExté\">Equipement d'extérieur</option>
            </select>
            <input type=\"submit\" class=\"btn btn-outline-success my-2 my-sm-0\" value=\"OK\" name=\"searchSubmit\">
        </form>
</nav>


    ";
        // line 55
        $this->displayBlock('body', $context, $blocks);
        // line 56
        echo "
<script src=\"https://code.jquery.com/jquery-3.4.0.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"></script>
<script src=\"https://code.jquery.com/ui/1.12.1/jquery-ui.js\"></script>
<script src=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/i18n/jquery-ui-i18n.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js\"></script>
";
        // line 63
        $this->displayBlock('javascript', $context, $blocks);
        // line 64
        echo "
</body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "PWB Domo BLOG";
    }

    // line 11
    public function block_css($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 55
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 63
    public function block_javascript($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  145 => 63,  139 => 55,  133 => 11,  126 => 5,  119 => 64,  117 => 63,  108 => 56,  106 => 55,  87 => 39,  58 => 12,  56 => 11,  47 => 5,  41 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!doctype html>
<html lang=\"fr\">
<head>
    <meta charset=\"utf-8\">
    <title>{% block title %}PWB Domo BLOG{% endblock %}</title>
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\">
    <link rel=\"stylesheet\" href=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/pepper-grinder/jquery-ui.css\">
    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.8.1/css/all.css\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css\">
    <link rel=\"stylesheet\" href=\"./asset/css/master.css\">
    {% block css %}{% endblock %}
</head>

<body>

    <!--Barre de navigation>-->
<nav class=\"navbar sticky-top nav-pills navbar-expand-lg navbar-dark bg-dark\">
    <a class=\"navbar-brand\" href=\"/Article/ListAll\">Blog de PWB Domo</a>
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo02\" aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
    </button>
    <div class=\"collapse navbar-collapse\" id=\"navbarTogglerDemo02\">
        <ul class=\"navbar-nav mr-auto mt-2 mt-lg-0\">
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/Login\">Connexion</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/Inscription\">Inscription</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/Article/Add\">Ajout d'un article</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"/Admin\">Administrateur</a>
            </li>
        </ul>

        <!--liste déroulante de catégories dans la Recherche -->
        <form class=\"form-inline\" method=\"search\" action=\"/Catégorie/Show/{{ post.search }}\">
            <select name=\"Catégorie\" id=\"catégo-select\">
                <option value=\"Toutes les catégories\">Toutes les catégories</option>
                <option value=\"Alarme\">Alarme</option>
                <option value=\"Eclairage\">Eclairage</option>
                <option value=\"Détecteur\">Détecteur</option>
                <option value=\"Chauffage\">Chauffage</option>
                <option value=\"Motorisation\">Motorisation</option>
                <option value=\"Electro\">Electroménager</option>
                <option value=\"EquipExté\">Equipement d'extérieur</option>
            </select>
            <input type=\"submit\" class=\"btn btn-outline-success my-2 my-sm-0\" value=\"OK\" name=\"searchSubmit\">
        </form>
</nav>


    {% block body %}{% endblock %}

<script src=\"https://code.jquery.com/jquery-3.4.0.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\"></script>
<script src=\"https://code.jquery.com/ui/1.12.1/jquery-ui.js\"></script>
<script src=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/i18n/jquery-ui-i18n.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js\"></script>
{% block javascript %}{% endblock %}

</body>
</html>
", "index.html.twig", "C:\\project1\\TP\\templates\\index.html.twig");
    }
}
