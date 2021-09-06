<?php

namespace App\Models;

use CodeIgniter\Model;

class OrangModel extends Model
{
    protected $table = 'orang';
    protected $useTimeStamps = 'true';
    protected $allowedFields = ['nama', 'alamat'];
}
