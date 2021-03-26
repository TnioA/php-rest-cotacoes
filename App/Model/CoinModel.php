<?php
    namespace App\Model;

    class CoinModel extends BaseModel
    {
        public $Name;
        public $Flag;     
        public $Value;
        
        public function __construct($name = null, $flag = null, $value = null) 
        {
            $this->Name = $name;
            $this->Flag = $flag;
            $this->Value = $value;
        }
    }
?>