<?php

namespace App\Models;

use Codeigniter\Model;
use Codeigniter\Database\ConnectionInterface;

class AuthModel extends Model
{

    protected $db;

    public function __construct(ConnectionInterface &$db)
    {

        $this->db =& $db;

    }









}

