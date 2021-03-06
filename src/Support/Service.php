<?php

namespace Anburocky3\Msg91\Support;

use Anburocky3\Msg91\Client;
use Anburocky3\Msg91\Contracts\Options;
use GuzzleHttp\Client as HttpClient;

/**
 * Class Service
 * @package Anburocky3\Msg91\Support
 */
abstract class Service
{
    /**
     * Options for Request
     * @var Options
     */
    protected Options $options;

    /**
     * The msg91 client instance
     * @var Client
     */
    protected Client $client;

    /**
     * Options for Request
     */
    public function getOptions(): Options
    {
        return $this->options;
    }

    /**
     * Get the http client
     * @return HttpClient
     */
    protected function getHttpClient(): HttpClient
    {
        return $this->client->getHttpClient() ?: new HttpClient();
    }

    /**
     * Set the recipient(s)
     * @param int|null $mobile
     * @return $this
     */
    public function to(int $mobile = null)
    {
        $this->getOptions()->to($mobile);

        return $this;
    }

    /**
     * Set the sender
     * @param int|null $sender_id
     * @return $this
     */
    public function from(int $sender_id = null): Service
    {
        $this->getOptions()->from($sender_id);

        return $this;
    }

    /**
     * Set the content of message
     * @param string|null $message
     * @return $this
     */
    public function message(?string $message = ''): Service
    {
        $this->getOptions()->message($message);

        return $this;
    }

    /**
     * Pass any other options to the message
     * @param mixed $options
     * @return $this;
     */
    public function options($options = null): Service
    {
        $this->getOptions()->mergeWith($options);

        return $this;
    }

    /**
     * Create a new instance of given request
     * @param string $request - Request class name
     * @return Response
     */
    protected function sendRequest(string $request): Response
    {
        return (new $request($this->getHttpClient(), $this->getOptions()))->handle();
    }
}
