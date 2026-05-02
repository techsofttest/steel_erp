<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ErrorLogger extends Controller
{
    public function log()
    {
        $data = $this->request->getJSON(true);

        log_message('error', 'JS ERROR: ' . json_encode($data));

        return $this->response->setJSON([
            'status' => 'logged'
        ]);
    }
}