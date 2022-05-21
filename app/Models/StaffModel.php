<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;


class StaffModel extends Model
{
    protected $table      = 'tab_staff';
    protected $primaryKey = 'id_staff';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['matricula_staff', 'name','email','mobile','status','position','password'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getUserBy(string $column, string $value)
    {
        return $this->where($column, $value)->first();
    }
}
