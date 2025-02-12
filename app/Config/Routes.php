<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Facts;
use App\Controllers\Wonders;
use App\Controllers\Users;

/**
 * @var RouteCollection $routes
 */

 // Para evitar codigo malicioso
 $routes->setAutoRoute(false);

/**
 * Lo que cargan las rutas dentro del ('la URL a muestrar', [Clase, Metodo]) 
*/

 // Página principal del frontEnd
$routes->get('/', [Wonders::class, 'index/frontend']);
$routes->get('wonder/(:segment)', [Wonders::class, 'show']);


$routes->group("admin", function ($routes) {
    //Grupo de Rutas para controlar acciones del backend:

    /** Ingresar como User dentro del Admin - BACKEND */
    $routes->get('loginForm', [Users::class, "loginForm"]);
    // Poner Post y Como en el <form> hemos puesto dentro de action="admin/login" esto se recoje y ejecuta el checkUser
    $routes->post('login', [Users::class, "checkUser"]);
    // Para entrar directamente a Admin si ya tenemos una sessión activa
    $routes->get('adminArea', [Users::class, "adminArea"]);


    /** Crear nuevo usuario */ 
    $routes->get('registerForm', [Users::class, 'new']);
    $routes->post('create', [Users::class, 'create']);

    /** Cerrar session */
    $routes->get('session', [Users::class, 'closeSession']);

    /**
     * Tablas del backEnd para poder editar, añadir y eliminar
     */

    // View - [WONDERS]
    $routes->get('wonders', [Wonders::class, "index/backend"]);
    // Insertar
    $routes->get('wonders/newForm', [Wonders::class, "newForm"]);
    $routes->post('wonders/create', [Wonders::class, "create"]);
    // Eliminar
    $routes->get('wonders/delete/(:segment)', [Wonders::class, "delete"]);    
    // Editar
    $routes->get('wonders/update/(:segment)', [Wonders::class, "updateForm"]);
    $routes->post('wonders/update/updated/(:segment)', [Wonders::class, "update"]);    

    // View - [FACTS]
    $routes->get('facts', [Facts::class, "index"]);
    // Insertar
    $routes->get('facts/newForm', [Facts::class, "newForm"]);
    $routes->post('facts/create',[Facts::class, "create"]);
    // Eliminar
    $routes->get('facts/delete/(:segment)',[Facts::class, "delete"]);
    // Editar
    $routes->get('facts/update/(:segment)', [Facts::class, 'updateForm']);
    $routes->post('facts/update/updated/(:segment)', [Facts::class, "update"]);    


    // View - Users
    $routes->get('users', [Users::class, "backEnd"]);

});