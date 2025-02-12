<?php

namespace App\Models;

use CodeIgniter\Model;

class FactsModel extends Model {

    protected $table = "facts";

    protected $primaryKey = "fact_id";

    protected $allowedFields = ["wonder_id","fact_text"];

    

}