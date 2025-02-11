<?php

namespace App\Controllers;

// Para poder instanciar el Modelo FACTS con su Tabla FACTS
use App\Models\FactsModel;
// Para poder instanciar el Modelo WONDERS con su Tabla 7WONDERS
use App\Models\WondersModel;


class Facts extends BaseController {

    // Mostrar toda la tabla de FACTS en el BackEnd
    public function backEnd (){

        /* Instancia modelo de la tabla Facts */
        $facts_model = model(FactsModel::class);


        /* Instancia modelo Wonders para el Join */
        $wonder_model = model(WondersModel::class);

        // Es necesario hacer un join para tener el nombre de la maravilla
        $data["facts"] = [
            'facts' => $facts_model->join('7wonders', '7wonders.id=facts.wonder_id')->findAll(),
            'title' => "Manage Facts",
        ];

        return view("templates/header", $data)
                .view("admin/facts/index")
                .view("templates/footer");
    }

    public function newForm (){

        // TO DO

        $wonders_model = model(WondersModel::class);

        if($data['wonders'] = $wonders_model->findAll()){
            return view('templates/header')
            .view('admin/facts/create')
            .view('templates/footer');
        }

    }

    public function create(){

        //TO DO

    }

    public function delete($id){

        $facts_model = model(FactsModel::class);

        $facts_model->where(['facts_id' => $id])->delete();

        return redirect()->to(base_url('admin/facts'));

    }

    public function updateForm($id){

        //Para rellenar el desplegable

        //Para rellenar campos del formulario de fact a modificar

    }

    public function update($id){

    }

}

