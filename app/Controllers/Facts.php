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

        // Nos da todas las filas en formato array de la tabla Facts
        $data["facts"] = $facts_model->findAll();

        return view("templates/header", $data)
                .view("admin/facts/facts")
                .view("templates/footer");
    }

}