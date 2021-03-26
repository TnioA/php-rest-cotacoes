<?php
    header('Content-Type: application/json');
    ini_set('default_charset','UTF-8');

    require_once 'vendor/autoload.php';

    class Main
    {
        public static function Start()
        {
            try
            {
                //any route validation
                if(!isset($_GET['url']))
                    throw new Exception(App\Enum\ErrorMessage::INVALID_API_ROUTE);
                
                $fullUrl = $_GET['url'];               
                $urlItens = explode('/', $fullUrl);

                //api route validation
                if($urlItens[0] !== 'api')
                    throw new Exception(App\Enum\ErrorMessage::INVALID_API_ROUTE);

                array_shift($urlItens);
                
                $controller = 'App\Controller\\'. ucfirst(isset($urlItens[0])? $urlItens[0] : '').'Controller';
                array_shift($urlItens);
                
                $function = isset($urlItens[0])? $urlItens[0] : '';
                array_shift($urlItens);
    
                if(!file_exists('\'. $controller.'.php'))
                    var_dump('deu merda aqui --- '. $controller.'.php');
                    throw new Exception(App\Enum\ErrorMessage::INVALID_API_ROUTE);
                
                var_dump('ve se chega aqui');
                $method = $_SERVER['REQUEST_METHOD'];

                //route arguments validation
                App\Annotation\Route::CheckRouteAndMethod(new $controller(), $function, $method);
                
                $response = call_user_func_array(array(new $controller(), $function), $urlItens);

                http_response_code(200);
                echo json_encode(array('Success'=> true, 'Data'=> $response), JSON_UNESCAPED_UNICODE);
                
            }
            catch(Exception $e)
            {
                http_response_code(404);
                echo json_encode(array('Success'=> false, 'Data'=> array('Message'=> $e->getMessage())), JSON_UNESCAPED_UNICODE);
            }
        }
    }

    Main::Start();
?>
