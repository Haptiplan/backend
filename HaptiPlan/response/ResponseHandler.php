<?php

/**
 * Processes an httpResponse and sends http_response_code, header and body to the browser.
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
