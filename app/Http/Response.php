<?php


namespace App\Http;


class Response
{
    private $httpCode = 200;

    private $headers = [];

    private $contentType = 'text/html';

    private $content;

    public function __construct($httpCode, $content, $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    /**
     * @param mixed|string $contentType
     */
    public function setContentType($contentType): void
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function sendResponse()
    {
        $this->sendHeaders();

        echo $this->content;
    }

    private function sendHeaders()
    {
        http_response_code($this->httpCode);

        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }
    }
}