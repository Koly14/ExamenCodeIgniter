<?php

namespace App\Controllers;

// Para poder instanciar el Modelo FACTS con su Tabla FACTS
use App\Models\FactsModel;
// Para poder instanciar el Modelo WONDERS con su Tabla 7WONDERS
use App\Models\WondersModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Wonders extends BaseController {

    public function index($location) {

        /* Instancia modelo de la tabla 7wonders */
        $wonders_model = model(WondersModel::class);
        // Nos da todas las filas en formato array de la tabla Wonders
        $data["wonders"] = $wonders_model->findAll();

        // Para usar solo una función / Depende de si es Front o Back tenemos una view u otra.
        if($location == 'frontend'){
            return view("frontend/header", $data)
            .view("frontend/index")
            .view("frontend/footer");
        } else {

            // Controlamos si hay sessión o no para entrar en parte Admin
            $session = session();
            if(empty($session->get('user'))){
                return redirect()->to(base_url('admin/loginForm'));
            }

            return view("templates/header", ['title' => 'Wonders Management'] )
            .view("backend/wonders/index",$data)
            .view("templates/footer");
        }

    }

    // Requiere un parametro el cual se pide por $route -> wonder/(:segment)
    public function show($location,$id_wonder) {

        /* Instancias tablas */
        $wonders_model = model(WondersModel::class);
        $facts_model = model(FactsModel::class);

        // Obtener las maravillas para los botones
        $data["wonders"] = $wonders_model->findAll();

        // Obtener maravilla $id_wonder
        $data["wonder_selected"] = $wonders_model->where(['id' => $id_wonder])->first();

        // Obtener los Facts de la maravilla segun $id_wonder
        $data['wonder_facts'] = $facts_model->where(['wonder_id'=> $id_wonder])->find();

        if ($location == 'frontend') {
            return view("frontEnd/header", $data)
            .view("frontEnd/wonder")
            .view("frontEnd/footer");
        } else {
            // Controlamos si hay sessión o no para entrar en parte Admin
            $session = session();
            if(empty($session->get('user'))){
                return redirect()->to(base_url('admin/loginForm'));
            }

            return view("templates/header", ['title' => 'Wonders Management'] )
            .view("backend/wonders/detail",$data)
            .view("templates/footer");
        }

    }

    // FORMULARIO nueva WONDER
    public function newForm(){

        // Controlamos si hay sessión o no para entrar en parte Admin
        $session = session();
        if(empty($session->get('user'))){
            return redirect()->to(base_url('admin/loginForm'));
        }

        helper('form');

        return view('templates/header', ['title' => 'Create a new wonder'])
            .view('backend/wonders/create')
            .view('templates/footer');
    }

    // INSERTAR nueva WONDER en la BD
    public function create(){

        helper('form');

        if(empty($_FILES['imagen']['name'])){
            throw new PageNotFoundException("Hay que insertar wonder con imagen");
        }


        $data = $this->request->getPost(['wonder', 'location', 'imagen']);

        // El 'wonder' hace referencia al name="wonder" del formulario
        if(!$this->validateData($data, [
            'wonder' => 'required|max_length[255]|min_length[3]',
            'location' => 'required|max_length[255]|min_length[3]',
            'imagen' => 'is_image[imagen]',
        ])){
            // Devuelve a la función new para volver a hacer el formulario de creación.
            return $this->newForm();
        }

        // Si pasa lo anterior obtenemos los datos validados
        $post = $this->validator->getValidated();

        $Wonders_model = model(WondersModel::class);

        //Temporal imagen
        $file = $this->request->getFile('imagen');
        //Nombre imagen
        $wonder_imagen = $file->getName();
        //Mover imagen
        $file->move(ROOTPATH.'public/assets/img/',$wonder_imagen);

        $Wonders_model->save([
            'wonder' => $post['wonder'],
            'location' => $post['location'],
            'imagen' => $wonder_imagen,
        ]);

        return redirect()->to(base_url('admin/wonders'));
    }

    // BORRAR
    public function delete($id){

        $wonders_model = model(WondersModel::class);
        $facts_model = model(FactsModel::class);

        // Comprobar si hay facts asociados a la wonder a eliminar
        if($facts_model->where(['wonder_id' => $id])->find()){
            throw new PageNotFoundException("No se puede eliminar por que tiene Facts asociados");
        } else {
            // PARA BORRAR LA IMAGEN DE NUESTRA BBDD
            // Si tiene imagen la wonder seleccionada por $id se hace unlink del archivo
            if($data['imagen'] = $wonders_model->where('id',$id)->findColumn('imagen')) {
                unlink(ROOTPATH.'public/assets/img/'.$data['imagen'][0]);
                // Despues eliminamos la fila entera de la BBDD
                $wonders_model->where('id',$id)->delete();
            }
            $wonders_model->where('id',$id)->delete();
        }

        return redirect()->to(base_url('admin/wonders'));

    }

    // FORMULARIO editar  (Es parecido a Create, pero con algunos cambios)
    public function updateForm($id) {

        // Controlamos si hay sessión o no para entrar en parte Admin
        $session = session();
        if(empty($session->get('user'))){
            return redirect()->to(base_url('admin/loginForm'));
        }

        helper('form');

        if($id == null){
            throw new PageNotFoundException("Cannot update the Wonder");
        }

        $model = model(WondersModel::class);

        if($model->where('id', $id)->find()){
            $data = [
                'wonder' => $model->where('id', $id)->first(),
            ];
        } else {
            throw new PageNotFoundException("No Wonder");
        }

        return view('templates/header', ['title' => 'Update a new wonder'])
            .view('backend/wonders/update', $data)
            .view('templates/footer');
    }

    // INSERTAR update de la edición
    public function update($id){

        helper('form');

        if (empty($_FILES['imagen']['name'])){
            // Si no pulsamo boton de cargar imagen --> Mantenemos la INAGEN de la base de datos

            $data = $this->request->getPost(['wonder', 'location', 'img_actual']);

            if(!$this->validateData($data, [
                'wonder' => 'required|max_length[255]|min_length[3]',
                'location' => 'required|max_length[255]|min_length[3]',
                'img_actual' => 'max_length[255]|min_length[3]',
            ])){
                // Devuelve a la función new para volver a hacer el formulario de creación.
                return $this->updateForm($id);
            }

            $wonders_model = model(WondersModel::class);
            $post = $this->validator->getValidated();

            $wonders_model->save( [
                'id' => $id,
                'wonder' => $post['wonder'],
                'location' => $post['location'],
                'imagen' => $post['img_actual'],
            ]);

            return redirect()->to(base_url('admin/wonders'));

        } else {
            // Si pulsamos boton de cargar inamen nueva --> Insertamos una nueva IMAGEN y borramos la que había

            $data = $this->request->getPost(['wonder', 'location', 'imagen']);

            if(!$this->validateData($data, [
                'wonder' => 'required|max_length[255]|min_length[3]',
                'location' => 'required|max_length[255]|min_length[3]',
                'imagen' => 'is_image[imagen]',
            ])){
                // Devuelve a la función new para volver a hacer el formulario de creación.
                return $this->updateForm($id);
            }

            $wonders_model = model(WondersModel::class);
            $post = $this->validator->getValidated();

            //Temporal imagen nueva
            $file = $this->request->getFile('imagen');
            //Nombre imagen nueva
            $wonder_imagen = $file->getName();
            //Mover imagen nueva
            $file->move(ROOTPATH.'public/assets/img/',$wonder_imagen);

            // Borrar IMAGEN anterior que teniamos almacenada
            if($data['imagen'] = $wonders_model->where('id',$id)->findColumn('imagen')) {
                unlink(ROOTPATH.'public/assets/img/'.$data['imagen'][0]);
            }

            $wonders_model->save( [
                'id' => $id,
                'wonder' => $post['wonder'],
                'location' => $post['location'],
                'imagen' => $wonder_imagen,
            ]);

            return redirect()->to(base_url('admin/wonders'));

        }

    }

}