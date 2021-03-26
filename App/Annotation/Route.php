<?php
    namespace App\Annotation;

    #[Attribute]
    class Route
    {
        public function __construct(public string $url, public array $methods) { }

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
                throw new \Exception("Can't find a route that satisfies this request!");
            }
        }
    }
?>