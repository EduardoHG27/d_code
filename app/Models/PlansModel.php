<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;


class PlansModel extends Model
{
    protected $table      = 'tbl_plans';
    protected $primaryKey = 'id_plan';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['name','month','discount','status'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getUserBy(string $column, string $value)
    {
        return $this->where($column, $value)->first();
    }
}
