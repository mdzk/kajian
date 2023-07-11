<?php

namespace App\Models;

use CodeIgniter\Model;

class UsulanModel extends Model
{
    protected $table      = 'usulan';
    protected $primaryKey = 'id_usulan';
    protected $allowedFields = ['users_id', 'id_kajian', 'prihal_usulan', 'instansi', 'status_usulan'];
    protected $useTimestamps = true;
    protected $dateFormat    = 'date';
}
