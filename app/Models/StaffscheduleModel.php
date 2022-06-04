<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;


class StaffscheduleModel extends Model
{
    protected $table      = 'tab_staff_schedule';
    protected $primaryKey = 'id_schedule';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['id_staff','l','m','x','j','v','s','d'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getUserBy(string $column, string $value)
    {
        return $this->where($column, $value)->first();
    }
}
