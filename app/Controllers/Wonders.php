<?php

namespace App\Controllers;

// Para poder instanciar el Modelo FACTS con su Tabla FACTS
use App\Models\FactsModel;
// Para poder instanciar el Modelo WONDERS con su Tabla 7WONDERS
use App\Models\WondersModel;


class Wonders extends BaseController {

    public function index():string {

        /* Instancia modelo de la tabla 7wonders */
        $wonders_model = model(WondersModel::class);

        // Nos da todas las filas en formato array de la tabla Wonders
        $data["wonders"] = $wonders_model->findAll();

        return view("frontEnd/header", $data)
                .view("frontEnd/index")
                .view("frontEnd/footer");
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

    // Quiero mostrar toda la tabla de Wonders en el BackEnd
    public function backEnd (){
        /* Instancia modelo de la tabla 7wonders */
        $wonders_model = model(WondersModel::class);

        // Nos da todas las filas en formato array de la tabla Wonders
        $data["wonders"] = $wonders_model->findAll();

        return view("templates/header", $data)
                .view("admin/wonders")
                .view("templates/footer");
    }

}