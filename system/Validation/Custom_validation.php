<?php 
namespace CodeIgniter\Validation;
use Config\Database;

class Avoid_Script {

    public function __construct()
    {
        $this->session = session();
        $this->db = db_connect();
    }

    public function remove_script(string $str = null)
    {
        
        if(empty($str))
        {

            return false;

        } elseif (preg_match('/^(?:([^:]*)\:)?\/\/(.+)$/', $str, $matches)){
   
            return true;
          
        } else {

            return false;
        }
    }
}