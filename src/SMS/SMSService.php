<?php

namespace Anburocky3\Msg91\SMS;

use Anburocky3\Msg91\Client;
use Anburocky3\Msg91\Support\Service;

/**
 * Class SMSService
 * @package Anburocky3\Msg91\SMS
 */
class SMSService extends Service
{
    /**
     * Options for Request
     * @var Options
     */
    protected Options $options;

    /**
     * Create a new service instance
     * @param Client $client
     * @param int|string|\Anburocky3\Msg91\Contracts\Options $payload
     * @return void
     */
    public function __construct(Client $client, $payload = null)
    {
        $this->client = $client;
        $this->options = (new Options())
            ->resolveConfig($this->client->getConfig())
            ->mergeWith($payload);
    }

    /**
     * Send sms
     * @return \Anburocky3\Msg91\Support\Response
     */
    public function send(): \Anburocky3\Msg91\Support\Response
    {
        return $this->sendRequest(SendRequest::class);
    }

    /**
     * Set the recipients of the message
     * @param int|null $mobile - recipients's mobile numbers
     * @return $this
     */
    public function to($mobiles = null)
    {
        $this->options->to($mobiles);

        return $this;
    }

    /**
     * Set the recipients with placeholders
     * @param array|null $recipients - recipients with mobile number and placeholders
     * @return $this
     */
    public function recipients(array $recipients = null): SMSService
    {
        $this->options->recipients($recipients);

        return $this;
    }

    /**
     * Set the flow id for the sms
     * @param string|null $flow_id - flow id for sms
     * @return $this
     */
    public function flow(string $flow_id = null): SMSService
    {
        $this->options->flow($flow_id);

        return $this;
    }

    /**
     * Set the message content (same as message method)
     * @param string|null $message
     * @return $this
     */
    public function content(?string $message = ''): SMSService
    {
        $this->options->content($message);

        return $this;
    }

    /**
     * Set a variable's value for all the recipients
     * @param string $name - name of the variable in the template
     * @param string|null $value - value for the variable to be placed in template
     * @return $this
     */
    public function variable(string $name, string $value = null): self
    {
        $this->options->variable($name, $value);

        return $this;
    }
}
