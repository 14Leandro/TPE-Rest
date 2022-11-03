<?php
require_once './libs/Router.php';
require_once './app/controllers/categoria.controller.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
$router->addRoute('categorias', 'GET', 'CategoriaApiController', 'getCategorias');
$router->addRoute('categorias/:ID', 'GET', 'CategoriaApiController', 'getCategoria');
$router->addRoute('categorias/:ID', 'DELETE', 'CategoriaApiController', 'deleteCategoria');
$router->addRoute('categorias', 'POST', 'CategoriaApiController', 'insertCategoria'); 

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);