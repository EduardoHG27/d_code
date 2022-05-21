<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;


class PaysModel extends Model
{
    protected $table      = 'tbl_members_pay';
    protected $primaryKey = 'id_pay';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_member', 'date_in','date_out','cost','pay_status'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getUserBy(string $column, string $value)
    {
        return $this->where($column, $value)->first();
    }
}
