<?php
    namespace App\Controller;

    use App\Annotation\Route;
    use App\Service\CoinService;
    use App\Repository\CoinRepository;
    use App\Model\CoinModel;

    class CoinController extends BaseController
    {
        private $_service;
        public function __construct() 
        {
            $this->_service = new CoinService();
        }

        #[Route("getall", ["GET"])]
        public function GetAll()
        {
            return $this->_service->GetAll();
        }

        #[Route("getbyid", ["GET"])]
        public function GetById(int $id = null)
        {
            return "recebeu: + ". json_encode($id);
        }

        #[Route("add", ["POST"])]
        public function Add()
        {
            $_POST = json_decode(file_get_contents("php://input"), true);
            
            return new CoinModel($_POST["Name"], $_POST["Flag"], $_POST["Value"]);
        }

        #[Route("getallfromdb", ["GET"])]
        public function GetAllFromDB()
        {
            $repository = new CoinRepository();
            return $repository->GetAll();
        }

        #[Route("saveintodb", ["POST"])]
        public function SaveIntoDB()
        {
            $repository = new CoinRepository();
            return $repository->Add($this->GetAll());
        }
    }
?>