<?php

/**
 * Request class stores all the required information from the page request
 */
class Request
{
    // contains the URL of the request
    private string $url;
    // contains the segments of the request
    private array $segments;
    // contains the request type of the request : GET | POST
    private string $type;
    // holds the value of Request after submitting the Form
    //private string $params;

    public function __construct()
    {
        $this->init();
    }
    /*
    public function getLastElementInSegments(){

        return $this->segments[count($this->segments)-1];  
    }
    */

    public function init()
    {
        $this->setUrl(strtolower($_SERVER['REQUEST_URI']));
        $this->setType($_SERVER['REQUEST_METHOD']);
        //It returns all the segments of the current URL as an array
        $uriSegments = explode("/", parse_url(substr($this->getUrl(), 1), PHP_URL_PATH));
        $this->setSegments($uriSegments);

        /*
        if ($uriSegments[0] == "") {
            array_shift($uriSegments);
        }*/
    }

    /**
     * Get the value of url
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set the value of url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get the value of segments
     */
    public function getSegments(): array
    {
        return $this->segments;
    }

    /**
     * Set the value of segments
     */
    public function setSegments($segments)
    {
        $this->segments = $segments;
    }

    /**
     * Get the value of type
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the value of type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * check whether variable is set 
     */
    public function has($name): bool
    {
        $has = false;
        if (isset($_REQUEST[$name]) && !empty($_REQUEST[$name])) {
            $has = true;
        }
        return $has;
    }

    /**
     * return the value of the input
     */
    public function input($name)
    {
        return $_REQUEST[$name]; 
    }

    public function getRawData($text)
    {
        // Takes raw data from the request
        $json = file_get_contents('php://input');
        // Converts it into a PHP object
        $data = json_decode($json);
        return $data->$text;
    }

    public function getPathParams(): int{
        $parts = $this->segments;
        $paramsId = $parts[count($parts) -1];
        return $paramsId;
    }
    public function getUrlwithoutPathParams():string{
        
        $url = $this->getUrl();
        $parts = explode('/', $url);
        array_pop($parts);
        $stringResult = implode('/', $parts);
        return $stringResult;
    }
}
