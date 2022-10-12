<?php

use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/../vendor/autoload.php';

$request = Request::createFromGlobals();

$path = $request->getPathInfo();
$method = $request->getMethod();

// Fonctions et classes utiles
// Au choix, faire avec les fonctions php ou les classes Symfony
// php :
    // header : https://www.php.net/manual/fr/function.header.php
// symfony : https://symfony.com/doc/current/components/http_foundation.html
    // Request
    // Response
    // JsonResponse

// questions :
    // requpete vs réponse http
    // code http ?
    // status http ?
    // headers
        // types mimes
// liens :
    // Général : https://developer.mozilla.org/fr/docs/Web/HTTP/Overview
    // Headers : https://developer.mozilla.org/fr/docs/Web/HTTP/Headers
    // Méthodes http : https://developer.mozilla.org/fr/docs/Web/HTTP/Methods

// créer une fonction chargée de rendre le html
// rappel : never trust user input
function defineRoute(string $file):string
{   
    ob_start();
        require_once __DIR__.'/../templates/'.$file;
    return ob_get_clean(); 
}

$content = '';

// accepte uniquement les requêtes 'GET'
if ($path === '/' && $method === 'GET') 
{
    $content = defineRoute('home.php');
    header('Content-Type: text/html');
}
else if ($path === '/about' && $method === 'GET') 
{
    $content = defineRoute('about.php');
    header('Content-Type: text/html');
}
else if ($path === '/blog' && $method === 'GET' || $method === 'POST') 
{
    $content = defineRoute('blog.php');
    header('Content-Type: text/html');
}
else if ($path === '/blog/post' && $method === 'GET') 
{
    $content = defineRoute('blog_show.php');
    $content= $_GET['id'];
    header('Content-Type: text/html');
}
else if ($path === '/api/token' && $method === 'GET') 
{
    $content ='{
        "token":"454hs65hs6gqrs84"
    }';

    header('Content-Type: application/json');
}
else
{
    $content = defineRoute('404.php');
}


echo $content;
