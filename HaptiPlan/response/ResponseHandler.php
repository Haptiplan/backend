<?php

class ResponseHandler
{

    function sendResponse(Response $response)
    {
        http_response_code($response->getHttpResponseCode());
        $headers = $response->getHttpHeaders();
        foreach ($headers as $key => $value) {
            header("$key: $value");
        }

        echo $response->getHttpBody();
    }
}
