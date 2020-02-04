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

/* Admin/index_admin.html.twig */
class __TwigTemplate_aed6283b5d2a310d722776ded6a337f03f4cfb4cc19c99b816f2258115e52a49 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "index.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("index.html.twig", "Admin/index_admin.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->displayParentBlock("title", $context, $blocks);
        echo " - console admin ";
    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "
    <div class=\"container-fluid mt-2\">
        <form method=\"post\" action=\"/Admin/sendCss\">
            <div class=\"form-group\">
                <label class=\"text-primary\" for=\"cssFile\">Modification du Css du blog</label>
                <textarea class=\"form-control\" id=\"cssFile\" name=\"cssContent\" rows=\"10\">";
        // line 9
        echo twig_escape_filter($this->env, ($context["cssFileData"] ?? null), "html", null, true);
        echo "</textarea>
            </div>
            <input type=\"submit\" class=\"btn btn-blog\" value=\"Soumetre\">
        </form>
    </div>

";
    }

    public function getTemplateName()
    {
        return "Admin/index_admin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 9,  59 => 4,  55 => 3,  47 => 2,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"index.html.twig\" %}
{% block title %}{{ parent() }} - console admin {% endblock %}
{% block body %}

    <div class=\"container-fluid mt-2\">
        <form method=\"post\" action=\"/Admin/sendCss\">
            <div class=\"form-group\">
                <label class=\"text-primary\" for=\"cssFile\">Modification du Css du blog</label>
                <textarea class=\"form-control\" id=\"cssFile\" name=\"cssContent\" rows=\"10\">{{ cssFileData }}</textarea>
            </div>
            <input type=\"submit\" class=\"btn btn-blog\" value=\"Soumetre\">
        </form>
    </div>

{% endblock %}", "Admin/index_admin.html.twig", "C:\\Users\\langl\\Desktop\\Cours\\Projets\\BlogPHP\\templates\\Admin\\index_admin.html.twig");
    }
}
