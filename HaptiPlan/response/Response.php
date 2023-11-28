<?php

/**
 * This is a class that contains information about HTTP headers, HTTP body and these types of applications.
 *It is passed as a parameter to the sendResponse method of the ResponsHandler class,
 *to send the response to the client
 */

class Response
{
    private array $httpHeaders;
    private string $httpBody;
    private int $httpResponseCode;

    public static function jsonResponse(mixed $body, int $responseCode = 200): Response
    {
        $httpBody = json_encode($body);
        $response = new Response();
        $response->setHttpHeader('Content-Type', 'application/json');
        $response->setHttpResponseCode($responseCode);
        $response->setHttpBody($httpBody);
        return $response;
    }

    public static function viewResponse(string $path, int $responseCode = 200): Response
    {

        ob_start();
        require_once "$path";
        $httpBody = ob_get_clean();
        
        $response = new Response();
        $response->setContentType('text/html');
        $response->setHttpResponseCode($responseCode);
        $response->setHttpBody($httpBody);

        return $response;
    }

    public function getHttpHeaders(): array
    {
        return $this->httpHeaders;
    }

    public function setHttpHeaders($httpHeaders): void
    {
        $this->httpHeaders = $httpHeaders;
    }

    public function setHttpHeader(string $headerName, string $value): void
    {
        $this->httpHeaders[$headerName] = $value;
    }

    public function getHttpHeader(string $headerName): string
    {
        if (array_key_exists($headerName, $this->httpHeaders)) {
            return $this->httpHeaders[$headerName];
        }
        return Null;
    }

    public function deleteHttpHeader(string $headerName): void
    {
        unset($this->httpHeaders[$headerName]);
    }

    public function setHttpBody(string $httpBody): void
    {
        $this->httpBody = $httpBody;
    }

    public function getHttpBody(): string
    {
        return $this->httpBody;
    }

    public function setHttpResponseCode(int $httpResponseCode): void
    {
        $this->httpResponseCode = $httpResponseCode;
    }

    public function getHttpResponseCode(): int
    {
        return $this->httpResponseCode;
    }

    /**
     * Changes the content type of this response to the given one 
     */
    public function setContentType(string $contentValue)
    {
        $this->setHttpHeader('Content-Type', $contentValue);
    }
}
