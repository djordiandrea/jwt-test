<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{   
    protected $db;
    public function __construct(){
        $this->db = db_connect();
    }

    public function getUser($username, $password){
        $query = "select * from user_login where user_username = '".$username."' and user_password = '".$password."'";
        $result = $this->db->query($query);
        
        return $result->getResult();
    }
}
