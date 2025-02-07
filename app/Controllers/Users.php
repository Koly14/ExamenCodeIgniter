<?php

namespace App\Controllers;

// Instancia UsersModel
use App\Models\UsersModel;

use CodeIgniter\Exceptions\PageNotFoundException;


class Users extends BaseController {

    public function loginForm($error = null) {

        helper('form');

        if($error == null){
            return view('templates/header', ['title' => 'Login Access'])
            .view('users/login', ['error' => ''])
            .view('templates/footer');
        } else {
            return view('templates/header', ['title' => 'Login Access'])
            .view('users/login', ['error' => 'Credenciales incorrectas'])
            .view('templates/footer');
        }
    }

    public function checkUser() {

        helper('form');

        $data = $this->request->getPost(['username', 'password']);

        if(!$this->validateData($data, [
            'username' => 'required',
            'password' => 'required',
        ])) {
            // Vuelve a la function loginForm si es falso
            return $this->loginForm("Credenciales incorrectas");
        }

        // $post es el que recoje el 'username' y 'password' validados
        $post = $this->validator->getValidated();

        $model = model(UsersModel::class);

        // el checkUser de aqui es una instancia del modelo y el metodo del mismo (Se llaman igual)
        if($data['user'] = $model->checkUser($post['username'], $post['password'])){

            // Creación de la sesión
            $session = session();
            $session->set('user', $post['username']);

            return view('templates/header', ['title' => 'Admin Area'])
            .view('users/admin', $data)
            .view('templates/footer');

        } else { 
            return $this->loginForm("error");
        }

    }
    
    public function new() {
        helper('form');
        helper('password');

        return view('templates/header', ['title' => 'New User'])
        .view('users/create')
        .view('templates/footer');

    }

    public function create() {

        helper('form');
        helper('password');

        $data = $this->request->getPost(['username','password','email', 'rol']);
        if(!$this->validateData($data, [
            'username' => 'required|max_length[255]|min_length[8]',
            'password' => 'required|max_length[255]|min_length[8]',
            'email' => 'required',
            'rol' => 'required',
        ])) {
            // Vuelve a la function new si es falso
            return $this->new();
        }

        $post = $this->validator->getValidated();

        $model = model(UsersModel::class);

        $hashedPassword = password_hash($post['password'], PASSWORD_DEFAULT);

        $model->save( [
            'username' => $post['username'],
            'password' => $hashedPassword,
            'email' => $post['email'],
            'rol' => $post['rol'],
        ]);

        return redirect()->to(base_url('admin/loginForm'));

    }

    public function closeSession(){

        // Por que al cerrar session nos mandará al formulario y requiere el helper('form) para no dar error;
        helper('form');

        $session = session();

        // Eliminar variable de sesion específica
        $session->remove('user');

        // Eliminar toda la información de la sesion
        $session->destroy();

        return view('templates/header', ['title' => 'Login Access'])
        .view('users/login', ['error' => ''])
        .view('templates/footer');

    }

}