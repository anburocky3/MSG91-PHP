<?php

namespace Anburocky3\Msg91\Support;

use Anburocky3\Msg91\Contracts\Options;
use Anburocky3\Msg91\Exceptions\ResponseErrorException;
use Anburocky3\Msg91\Exceptions\ValidationException;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;

/**
 * Class Request
 * @package Anburocky3\Msg91\Support
 */
abstract class Request
{
    /**
     * Http client for request handling
     * @var GuzzleHttpClient
     */
    protected GuzzleHttpClient $httpClient;

    /**
     * Options for the request
     *
     * @var Options
     */
    protected Options $options;

    /**
     * Request Method
     *
     * @var string
     */
    protected string $method = 'POST';

    /**
     * Request url
     *
     * @var string
     */
    protected string $url = '';

    /**
     * Content type
     */
    protected string $contentType = RequestOptions::JSON;

    /**
     * Validation instance
     *
     * @var Validator
     */
    protected Validator $validator;

    /**
     * Create a new request instance
     *
     * @param GuzzleHttpClient $httpClient
     * @param Options $options
     * @return void
     */
    public function __construct(GuzzleHttpClient $httpClient, Options $options)
    {
        $this->httpClient = $httpClient;
        $this->options = $options;
        $this->validator = new Validator();
    }

    /**
     * Get the request payload
     *
     * @return array
     */
    protected function getPayload(): array
    {
        return $this->options->toArray();
    }

    /**
     * @param array $payload
     */
    protected function validate(array $payload)
    {
        $token = $payload['authkey'] ?? '';
        if (! $token) {
            $this->validator->addError('authkey', 'Authkey is required');
        }
    }

    /**
     * Send the request and return the response or exception
     * @return Response
     * @throws ResponseErrorException |ValidationException
     * |\GuzzleHttp\Exception\ClientException
     * @throws ValidationException
     */
    public function handle(): Response
    {
        $client = $this->httpClient;
        $payload = $this->getPayload();
        $this->validate($payload);
        if (! $this->validator->isValid()) {
            throw new ValidationException('Invalid request parameters', 422, null, $this->validator->errors());
        }
        $method = strtolower($this->method);

        try {
            $resp = $client->{$method}($this->url, [
                $this->contentType => $payload,
                'headers' => [
                    'authkey' => $payload['authkey'],
                ],
            ]);

            return new Response($resp);
        } catch (ClientException $e) {
            throw new ResponseErrorException(
                $e->getMessage(),
                $e->getCode(),
                $e,
                (array)json_decode($e->getResponse()->getBody()->getContents())
            );
        }
    }
}
