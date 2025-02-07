<?php

use App\Controllers\Facts;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\Wonders;
use App\Controllers\Users;

/**
 * @var RouteCollection $routes
 */

// Lo que cargan las rutas dentro del ('la URL a muestrar', [Clase, Metodo])

 // Página principal del frontEnd
$routes->get('/', [Wonders::class, 'index']);
$routes->get('wonder/(:segment)', [Wonders::class, 'show']);


$routes->group("admin", function ($routes) {
    //Grupo de Rutas para controlar acciones del backend:

    /** Ingresar como User dentro del Admin - BACKEND */
    $routes->get('loginForm', [Users::class, "loginForm"]);
    // Poner Post y Como en el <form> hemos puesto dentro de action="admin/login" esto se recoje y ejecuta el checkUser
    $routes->post('login', [Users::class, "checkUser"]);

    // Tablas del backEnd para poder editar, añadir y eliminar
    $routes->get('wonders', [Wonders::class, "backEnd"]);
    $routes->get('facts', [Facts::class, "backEnd"]);
    $routes->get('users', [Users::class, "backEnd"]);

    /** Crear nuevo usuario */ 
    $routes->get('registerForm', [Users::class, 'new']);
    $routes->post('create', [Users::class, 'create']);

    /** Cerrar session */
    $routes->get('session', [Users::class, 'closeSession']);

});