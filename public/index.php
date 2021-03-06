<?php
session_start();

require '../vendor/autoload.php';

function chargerClasse($classe){
    $ds = DIRECTORY_SEPARATOR;
    $dir = __DIR__."{$ds}.."; //Remonte d'un dossier par rapport à l'index.php
    $classeName = str_replace('\\', $ds,$classe);

    $file = "{$dir}{$ds}{$classeName}.php";
    if(is_readable($file)){
        require_once $file;
    }
}

spl_autoload_register('chargerClasse');

$router = new \src\Router\Router($_GET['url']);
// Index
$router->get('/', "Article#GetLastFive");
// Article
$router->get('/Article', "Article#ListAll");
$router->post('/Article', "Article#ListAll");
$router->get('/Article/LastFive', "Article#GetLastFive");
$router->get('/Article/Update/:id', "Article#Update#id");
$router->post('/Article/Update/:id', "Article#Update#id");
$router->get('/Article/Add', "Article#Add");
$router->post('/Article/Add', "Article#Add");
$router->get('/Article/Delete/:id', "Article#Delete#id");
$router->get('/Article/Fixtures', "Article#Fixtures");
$router->get('/Article/Write', "Article#Write");
$router->get('/Article/Read', "Article#Read");
$router->get('/Article/WriteOne/:id', "Article#Read#id");
$router->get('/Article/ListAll','Article#listAll');
$router->get('/Article/Show/:id','Article#show#id');
// Article - confirmation
$router->post('/Article/Accept/:id', 'Article#accept#id');
$router->post('/Article/Refused/:id', 'Article#refused#id');
// Api
$router->get('/Api/Article', "Api#ArticleGet");
$router->get('/Api/Article/LastFive', "Api#ArticleGetLastFive");
$router->post('/Api/Article', "Api#ArticlePost");
$router->put('/Api/Article/:id/:json', "Api#ArticlePut#id#json");
// Formulaire contact
$router->get('/Contact', 'Contact#showForm');
$router->post('/Contact/sendMail', 'Contact#sendMail');
$router->post('/Contact/sendMailOnArticle/:id', 'Contact#sendMailOnArticle#id');
// connexion
$router->get('/Login', 'User#loginForm');
$router->post('/Login', 'User#loginCheck');
$router->get('/Logout', 'User#logout');

// Admin
$router->get('/Admin', 'Admin#index');
$router->post('/Admin/sendCss', 'Admin#sendCss');
// Inscription
$router->get('/Inscription', 'User#inscriptionForm');
$router->post('/Inscription', 'User#inscriptionCheck');
// Categorie
$router->post('/Categorie/delete/:id', 'Categorie#Delete#id');
$router->post('/Categorie/update/:id', 'Categorie#update#id');
$router->post('/Categorie/choice/:id', 'Categorie#choice#id');
$router->get('/Categorie/update/:id', 'Categorie#update#id');
$router->post('/Categorie/add', 'Categorie#add');
// User
$router->post('/User/Accept/:id', 'User#accept#id');
$router->post('/User/Refused/:id', 'User#refused#id');
$router->post('/User/Banned/:id', 'User#banned#id');
$router->post('/User/update/:id', 'User#update#id');
$router->get('/User/getTokenApi/:id', 'User#getTokenApi#id');
// Profil
$router->get('/Profile/:id', 'User#ShowProfil#id');
$router->post('/Profile/:id', 'User#UpdateProfil#id');
$router->post('/Article/Search/:idcat','Article#GetbyCat#idcat');





echo $router->run();



