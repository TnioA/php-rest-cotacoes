<?php
    namespace App\Enum;

    class ErrorMessage {
        const INVALID_API_ROUTE = "Can't find a route that satisfies this request!";
        const INVALID_JSON_DATA = "Json object incorrect!";
        const INVALID_REQUEST_IDENTIFICATION = "Can't found api identification!";
        const INVALID_REQUEST_METHOD = "There are no an '%s' endpoint that receives a '%s' request";
    }

?>