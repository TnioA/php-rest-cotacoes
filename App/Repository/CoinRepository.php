<?php
    namespace App\Repository;
    use App\Model\Context;
    use App\Model\CoinModel;

    class CoinRepository
    {
        private $_context;
        public function __construct() 
        {
            $this->_context = new Context();
        }

        public function GetById(int $id)
        {
            $sql = 'SELECT Id, Name, Flag FROM coin WHERE id = :id';
            $stmt = $this->_context->Connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            }else {
                throw new \Exception("Data not found for this ID!");
            }
        }

        public function GetAll()
        {
            $sql = 'SELECT Id, Name, Flag FROM coin';
            $stmt = $this->_context->Connection->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }else {
                throw new \Exception("Data not found for this ID!");
            }
        }

        public function Add($list)
        {   
            // $sql = 'INSERT INTO coin (Name, Flag) VALUES';
            // foreach($list as $value){
            //     $sql = $sql."('".$value->Name."','".$value->Flag."'),";
            // }

            // //removing last virgula
            // $sql = substr($sql, 0, -1);

            
            // $stmt = $this->_context->Connection->prepare($sql);
            // $stmt->execute();

            // if($stmt->rowCount() > 0){
            //     return $stmt->fetch(\PDO::FETCH_ASSOC);
            // }else {
            //     throw new \Exception("Can't insert data to database!");
            // }
            // return $this->GetCoinsFromMsn();
        }

    } 
?>