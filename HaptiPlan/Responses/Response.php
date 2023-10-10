<?php

class Response
{

    private array $httpHeaders;
    private string $httpBody;
    private int $httpResponseCode;

    public function gethttpHeaders():array
    {
        return $this->httpHeaders;
    }

    public function setHttpHeaders($httpHeaders):void
    {
        $this->httpHeaders = $httpHeaders;
    }

    public function addHttpHeader(string $headerName, string $value):void
    {
        $this->httpHeaders[$headerName] = $value;
    }

    public function getHttpHeader(string $headerName):string
    {
        if (array_key_exists($headerName, $this->httpHeaders)) {
            return $this->httpHeaders[$headerName];
        }
        return Null;
    }

    public function deleteHttpHeader(string $headerName):void
    {
        unset($this->httpHeaders[$headerName]);
    }

    public function setHttpBody(string $httpBody):void
    {
        $this->httpBody = $httpBody;
    }

    public function gettHttpBody():string
    {
        return $this->httpBody;
    }

    public function setHttpResponseCode(int $httpResponseCode):void
    {
        $this->httpResponseCode = $httpResponseCode;
    }

    public function getHttpResponseCode():int
    {
        return $this->httpResponseCode;
    }
}

