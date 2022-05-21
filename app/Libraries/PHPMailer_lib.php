<?php

namespace App\Libraries;

use CodeIgniter\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class PHPMailer_lib
{
    public function construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        // Include PHPMailer library files
        require_once RUTA_APP . '/ThirdParty/PHPMailer/Exception.php';
        require_once RUTA_APP . '/ThirdParty/PHPMailer/PHPMailer.php';
        require_once RUTA_APP . '/ThirdParty/PHPMailer/SMTP.php';
        $mail=new PHPMailer;
        return $mail;
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
