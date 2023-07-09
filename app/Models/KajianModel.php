<?php

namespace App\Models;

use CodeIgniter\Model;

class KajianModel extends Model
{
    protected $table      = 'kajian';
    protected $primaryKey = 'id_kajian';
    protected $allowedFields = ['nama_kajian', 'bidang', 'prihal', 'file', 'tipe'];
}
