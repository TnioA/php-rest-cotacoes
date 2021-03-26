<?php
    namespace App\Annotation;

    use App\Enum\ErrorMessage;

    #[Attribute]
    class Route
    {
        public function __construct(string $url, array $methods) { }

        public static function CheckRouteAndMethod(object $objectToValid, string $route, string $method)
        {
            $reflectionClass = new \ReflectionClass($objectToValid::class);
            $valid = false;

            foreach ($reflectionClass->getMethods() as $endPoint) {
                $methodName = $endPoint->getName();
                $attributes = $endPoint->getAttributes(self::class);

                foreach ($attributes as $attribute) {
                    $validation = $attribute->getArguments();
                    //$validationInstance = $attribute->newInstance();
                    
                    if($validation[0] === $route && in_array($method, $validation[1])){
                        $valid = true;
                    }
                }
            }

            if(!$valid){
                throw new \Exception(sprintf(ErrorMessage::INVALID_REQUEST_METHOD, ucfirst($route), $method));
            }
        }
    }
?>
