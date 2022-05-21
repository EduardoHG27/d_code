<?php

namespace App\Models;

use CodeIgniter\Model;


class InformativoModel extends Model
{
    protected $table      = 'tbl_members_pay';
    protected $primaryKey = 'id_pay';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['date_in', 'date_out','cost','id_member'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getUserBy(string $column, string $value)
    {
        return $this->where($column, $value)->first();
    }
}
