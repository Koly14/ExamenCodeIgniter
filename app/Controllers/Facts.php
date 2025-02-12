<?php

namespace App\Controllers;

// Para poder instanciar el Modelo FACTS con su Tabla FACTS
use App\Models\FactsModel;
// Para poder instanciar el Modelo WONDERS con su Tabla 7WONDERS
use App\Models\WondersModel;
use CodeIgniter\Model;

class Facts extends BaseController {

    // Mostrar toda la tabla de FACTS en el BackEnd
    public function index (){

        // Controlamos si hay sessión o no para entrar en parte Admin
        $session = session();
        if(empty($session->get('user'))){
            return redirect()->to(base_url('admin/loginForm'));
        }

        /* Instancia modelo de la tabla Facts */
        $facts_model = model(FactsModel::class);


        /* Instancia modelo Wonders para el Join */
        $wonder_model = model(WondersModel::class);

        // Es necesario hacer un join para tener el nombre de la maravilla
        $data = [
            'facts' => $facts_model->join('7wonders', '7wonders.id=facts.wonder_id')->findAll(),
            'titulo' => "Manage Facts",
        ];

        return view("templates/header", $data)
                .view("backend/facts/index")
                .view("templates/footer");
    }

    public function newForm (){

        // Controlamos si hay sessión o no para crear una Fact nueva
        $session = session();
        if(empty($session->get('user'))){
            return redirect()->to(base_url('admin/loginForm'));
        }

        helper('form');

        // Para poder elegir la maravilla a la que se le inserta la FACT es necesario el WondersModel
        $wonder_model = model(WondersModel::class);

        if($data['wonders'] = $wonder_model->findAll()){
            return view('templates/header', ['title' => 'Create new Fact'])
            .view('backend/facts/create', $data)
            .view('templates/footer');
        }

    }

    public function create(){

        helper('form');

        $data = $this->request->getPost(['fact_text', 'wonder_id']);

        if(!$this->validateData($data, [
            'fact_text' => 'required|max_length[255]|min_length[3]',
            'wonder_id' => 'required',
        ])) {
            // Si no es cierto vuelve a ejecutar la función create()
            return $this->create();
        }

        $post = $this->validator->getValidated();
        $facts_model = model(FactsModel::class);

        $facts_model->save([
            'fact_text' => $post['fact_text'],
            'wonder_id' => $post['wonder_id'],
        ]);

        // Vuelve a donde se muestran todos los facts
        return redirect()->to(base_url('admin/facts'));

    }

    public function delete($id){

        $facts_model = model(FactsModel::class);

        $facts_model->where(['fact_id' => $id])->delete();

        return redirect()->to(base_url('admin/facts'));

    }

    public function updateForm($id){

        // Controlamos si hay sessión o no para crear una Fact nueva
        $session = session();
        if(empty($session->get('user'))){
            return redirect()->to(base_url('admin/loginForm'));
        }

        helper('form');

        //Para rellenar el desplegable
        $wonder_model = model(WondersModel::class);
        $data['wonders'] = $wonder_model->findAll(); // Todas las wonders para el select

        //Para rellenar campos del formulario de fact a modificar
        $facts_model = model(FactsModel::class);
        $data['fact'] = $facts_model->where(['fact_id' => $id])->first(); //Encontrar el FACT que corresponde al ID pasado en la función

        return view('templates/header', ['title' => 'Update Fact'])
        .view('backend/facts/update', $data)
        .view('templates/footer');

    }

    // IGUAL QUE EL CREATE NEW, PERO AÑADIENDO EN EL ->save()['id' => $id] sin el id, se inserta uno nuevo.
    public function update($id){

        helper('form');

        $data = $this->request->getPost(['fact_text', 'wonder_id']);

        if(!$this->validateData($data, [
            'fact_text' => 'required|max_length[255]|min_length[3]',
            'wonder_id' => 'required',
        ])) {
            // Si no es cierto vuelve a ejecutar la función create()
            return $this->updateForm($id);
        }

        $post = $this->validator->getValidated();
        $facts_model = model(FactsModel::class);

        $facts_model->save([
            'fact_id' => $id,
            'fact_text' => $post['fact_text'],
            'wonder_id' => $post['wonder_id'],
        ]);

        // Vuelve a donde se muestran todos los facts
        return redirect()->to(base_url('admin/facts'));

    }

}

