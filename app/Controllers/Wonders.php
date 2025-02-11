<?php

namespace App\Controllers;

// Para poder instanciar el Modelo FACTS con su Tabla FACTS
use App\Models\FactsModel;
// Para poder instanciar el Modelo WONDERS con su Tabla 7WONDERS
use App\Models\WondersModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Wonders extends BaseController {

    public function index($location):string {

        /* Instancia modelo de la tabla 7wonders */
        $wonders_model = model(WondersModel::class);

        // Nos da todas las filas en formato array de la tabla Wonders
        $data["wonders"] = $wonders_model->findAll();

        // Para usar solo una función
        if($location == 'frontend'){
            return view("frontEnd/header", $data)
            .view("frontEnd/index")
            .view("frontEnd/footer");
        } else {
            return view("templates/header", $data)
            .view("admin/wonders/wonders")
            .view("templates/footer");
        }

    }

    // Requiere un parametro el cual se pide por $route -> wonder/(:segment)
    public function show($id_wonder):string {

        /* Instancias tablas */
        $wonders_model = model(WondersModel::class);
        $facts_model = model(FactsModel::class);

        // Obtener las maravillas para los botones
        $data["wonders"] = $wonders_model->findAll();

        // Obtener datos de las maravillas segun $id_wonder
        $data["wonder_selected"] = $wonders_model->where(['id' => $id_wonder])->first();

        // Obtener los Facts de cada maravilla segun $id_wonder
        $data['wonder_facts'] = $facts_model->where(['wonder_id'=> $id_wonder])->find();

        return view("frontEnd/header", $data)
                .view("frontEnd/wonder")
                .view("frontEnd/footer");
    }

    // FORMULARIO nueva WONDER
    public function new(){

        helper('form');

        return view('templates/header', ['title' => 'Create a new wonder'])
            .view('admin/wonders/create')
            .view('templates/footer');
    }

    // INSERTAR nueva WONDER en la BD
    public function create(){

        helper('form');

        // ejemplo 'wonder' hace referencia al name="wonder" del formulario
        if(!$this->validate([
            'wonder' => 'required|max_length[255]|min_length[3]',
            'location' => 'required|max_length[255]|min_length[3]',
            'imagen' => 'required',
        ])){
            // Devuelve  a la función new para volver a hacer el formulario de creación.
            return $this->new();
        }

        // Si pasa lo anterior obtenemos los datos validados
        $post = $this->validator->getValidated();

        $model = model(WondersModel::class);

        $model->save([
            'wonder' => $post['wonder'],
            'location' => $post['location'],
            'imagen' => $post['imagen'],
        ]);

        return redirect()->to(base_url('admin/wonders'));
    }

    // BORRAR
    public function delete($id){

        if($id == null){
            throw new PageNotFoundException("Cannot delete the item");
        }

        $model = model(WondersModel::class);
        if($model->where('id', $id)->find()){
            $model->where('id', $id)->delete();
        } else {
            throw new PageNotFoundException("Selected item does not exist in database");
        }

        return redirect()->to(base_url('admin/wonders'));

    }

    // FORMULARIO editar  (Es parecido a Create, pero con algunos cambios)
    public function updateForm($id) {

        helper('form');

        if($id == null){
            throw new PageNotFoundException("Canno update the item");
        }

        $model = model(WondersModel::class);

        if($model->where('id', $id)->find()){
            $data = [
                'wonder' => $model->where('id', $id)->first(),
            ];
        }

        return view('templates/header', ['title' => 'Update a new wonder'])
            .view('admin/wonders/update', $data)
            .view('templates/footer');
    }

    // INSERTAR update de la edición
    public function update($id){

        helper('form');

        // ejemplo 'wonder' hace referencia al name="wonder" del formulario
        if(!$this->validate([
            'wonder' => 'required|max_length[255]|min_length[3]',
            'location' => 'required|max_length[255]|min_length[3]',
            'imagen' => 'required', // Añadir required
        ])){
            // Devuelve  a la función new para volver a hacer el formulario de creación.
            return $this->new();
        }

        // Si pasa lo anterior obtenemos los datos validados
        $post = $this->validator->getValidated();

        $data = [
            'id' => $id,
            'wonder' => $post['wonder'],
            'location' => $post['location'],
            'imagen' => $post['imagen'],
        ];

        $model = model(WondersModel::class);

        $model->save($data);

        return redirect()->to(base_url('admin/wonders'));

    }

}