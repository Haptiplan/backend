<?php

/**
 * Verarbeitet eine HttpResponse und sendet http_response_code, header sowie auch body an den Browser
 */

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
