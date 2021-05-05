<?php

namespace Anburocky3\Msg91\Support;

use Anburocky3\Msg91\Exceptions\ResponseErrorException;
use GuzzleHttp\Psr7\Response as GuzzleHttpResponse;

/**
 * Class Response
 * @package Anburocky3\Msg91\Support
 */
class Response
{
    /**
     * Http client
     * @var GuzzleHttpResponse
     */
    protected GuzzleHttpResponse $response;

    /**
     * Status of the response
     * @var int
     */
    protected int $statusCode = 422;

    /**
     * Response data
     * @var array
     */
    protected array $data = [];

    /**
     * Response errors
     * @var array|null
     */
    protected ?array $errors = null;

    /**
     * Response message
     * @var string
     */
    protected string $message = '';

    /**
     * @throws ResponseErrorException
     */
    public function __construct(GuzzleHttpResponse $response)
    {
        $this->response = $response;
        $this->handle();
    }

    /**
     * Handle the request
     * @throws ResponseErrorException
     */
    protected function handle()
    {
        $response = $this->response;
        $status_code = $response->getStatusCode();
        $body = (array) json_decode($response->getBody()->getContents());
        if ($body) {
            $this->data = $body;
            if (isset($body['type']) || isset($body['msg_type'])) {
                $type = $body['type'] ?? $body['msg_type'];
                if ($type === 'error') {
                    $status_code = 422;
                }
            }
            $this->message = $body['message'] ?? ($body['msg'] ?? 'No response message');
        }
        $this->statusCode = $status_code;
        if ($status_code / 100 !== 2) {
            throw new ResponseErrorException($this->message, $status_code, null, $this->data);
        }
    }

    /**
     * Get the response status code
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get the response data
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Get the response message
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
