<?php

namespace Anburocky3\Msg91;

use Anburocky3\Msg91\OTP\OTPService;
use Anburocky3\Msg91\SMS\SMSService;
use GuzzleHttp\Client as GuzzleHttpClient;


/**
 * Class Client
 * @package Anburocky3\Msg91
 */
class Client
{
    /**
     * Client's configuration
     * @var Config
     */
    protected Config $config;


    protected ?GuzzleHttpClient $httpClient;

    /**
     * Construct a new Msg91 Client instance
     *
     * @param array|null $config
     * @param GuzzleHttpClient|null $httpClient
     */
    public function __construct(array $config = null, GuzzleHttpClient $httpClient = null)
    {
        $this->httpClient = $httpClient;
        $this->config = new Config($config);
    }

    /**
     * Return the configuration
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * Set the configuration
     * @param array|null $config
     * @return $this
     */
    public function setConfig(array $config = null): Client
    {
        $this->config = new Config($config);

        return $this;
    }

    /**
     * Set the http client
     */
    public function setHttpClient(GuzzleHttpClient $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Get the http client
     */
    public function getHttpClient(): GuzzleHttpClient
    {
        return $this->httpClient ?: new GuzzleHttpClient();
    }

    /**
     * Access to OTP services
     *
     * @param mixed $payload - initial payload for request
     */
    public function otp($payload = null): OTPService
    {
        return new OTPService($this, $payload);
    }

    /**
     * Access to SMS services
     *
     * @param mixed $payload - initial payload for request
     */
    public function sms($payload = null): SMSService
    {
        return new SMSService($this, $payload);
    }
}
