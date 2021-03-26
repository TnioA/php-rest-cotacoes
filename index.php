<?php
    header('Content-Type: application/json');
    ini_set('default_charset','UTF-8');

    require_once 'vendor/autoload.php';

    if($_GET['url'])
    {
        $url = explode('/', $_GET['url']);

        if($url[0] === 'api')
        {
            array_shift($url);

            $controller = 'App\Controller\\'. ucfirst($url[0]).'Controller';
            array_shift($url);

            $function = $url[0];
            array_shift($url);

            $method = $_SERVER['REQUEST_METHOD'];

            try
            {
                $controllerInstance = new $controller();
                App\Annotation\Route::CheckRouteAndMethod($controllerInstance, $function, $method);
                
                $response = call_user_func_array(array(new $controllerInstance, $function), $url);

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
?>