<?php


namespace App\Http;


class Request
{
    private $router;

    private $httpMethod;

    private $uri;

    private $queryParams = [];

    private $postVars = [];

    private $headers = [];

    public function __construct($router)
    {
        $this->router = $router;
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->setUri();
    }

    /**
     * @return mixed|string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * @return mixed|string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    /**
     * @return array
     */
    public function getPostVars(): array
    {
        return $this->postVars;
    }

    /**
     * @return array|false
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return mixed
     */
    public function getRouter()
    {
        return $this->router;
    }

    public function setUri(): void
    {
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';

        $xURI = explode('?', $this->uri);

        $this->uri = $xURI[0];
    }
}