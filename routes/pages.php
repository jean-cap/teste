<?php

use App\Http\Response;
use App\Controller\Pages;

$router->get('/', [
    function ($request) {
        return new Response(200, Pages\Venda::getVenda($request));
    }
]);

$router->get('/produtos', [
    function ($request) {
        return new Response(200, Pages\Products::getProducts($request));
    }
]);

$router->post('/produtos', [
    function ($request) {
        return new Response(200, Pages\Products::insertProduct($request));
    }
]);

$router->post('/tipos', [
    function ($request) {
        return new Response(200, Pages\Products::insertType($request));
    }
]);

$router->get('/sobre', [
    function () {
        return new Response(200, Pages\About::getAbout());
    }
]);

$router->get('/pagina/{idPagina}/{acao}', [
    function ($idPagina, $acao) {
        return new Response(200, 'Página ' . $idPagina . ' - ' . $acao);
    }
]);