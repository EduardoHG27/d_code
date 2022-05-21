<?php

namespace App\Libraries;

use CodeIgniter\Model;

class Datatable
{

    private $model;
    private $group;
    private $columns;
    public function __construct(Model $model, String $group, array $columns)
    {
        $this->model = $model;
        $this->group = $group;
        $this->columns = $columns;
    }

    public function getResponse(array $filters)
    {
        [
            'draw' => $draw,
            'length' => $length,
            'start' => $start,
            'total_count' => $total_count,
            'order' => $order,
            'direction' => $direction,
            'search' => $search,
            'like' => $like

        ] = $filters;
        $data = $like;
        $page = ceil(($start - 1) / $length + 1);
        if (!empty($search)) {
            $this->applyFilters($search);
        } else {
            // $this->applyArray($data); 
            foreach ($data as $column => $value) {
                if ($value == '') {
                } else {
                    $this->model->like($column, $value);
                }
            }
        }

        $data = $this->model
            ->orderBy($this->getColumn($order), $direction)
            ->paginate($length, $this->group, $page);
        return [
            "draw" => $draw,
            "recordsTotal" => count($total_count),
            "recordsFiltered" => count($total_count),
            "data" => $data
        ];
    }
    private function getColumn($index)
    {
        return $this->columns[$index];
    }

    private function applyFilters(string $match)
    {
        foreach ($this->columns as $column) {
            $this->model->orLike($column, $match);
        }
    }
}
