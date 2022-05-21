<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;


class UsersModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType     = User::class;
    protected $useSoftDeletes = true;
    protected $allowedFields = ['username', 'password','type'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getUserBy(string $column, string $value)
    {
        return $this->where($column, $value)->first();
    }
}
