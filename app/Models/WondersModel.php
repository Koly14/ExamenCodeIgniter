<?php

namespace App\Models;

use CodeIgniter\Model;

class WondersModel extends Model {

    protected $table = "7wonders";

    protected $primaryKey = "id";

    protected $allowedFields = ["wonder","location", "imagen"];




}