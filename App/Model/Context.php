<?php
    namespace App\Model;

    class Context
    {
        public $Connection;
        public function __construct() 
        {
            $this->Connection = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
        }
    }
?>