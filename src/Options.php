<?php


namespace Anburocky3\Msg91;

use Anburocky3\Msg91\Contracts\Options as ContractsOptions;
use Closure;
use JsonSerializable;

/**
 * Class Options
 * @package Anburocky3\Msg91
 */
abstract class Options implements ContractsOptions, JsonSerializable
{
    /**
     * Payload for the message
     * @var array
     */
    protected array $payload = [];

    /**
     * Construct a new Options
     * @param mixed $options - initial payload of the message
     * @return void
     */
    public function __construct($options = null)
    {
        $this->mergeWith($options);
    }

    /**
     * Set the auth key
     * @param string|null $key
     * @return $this
     */
    public function key($key = null): Options
    {
        $this->setPayloadFor('authkey', $key);

        return $this;
    }

    /**
     * Set the receipients
     * @param string|null $key
     * @return $this
     */
    public function to($mobile = null)
    {
        $this->mobile($mobile);
        $this->mobiles($mobile);

        return $this;
    }

    /**
     * Set the sender of the message
     * @param string|null $sender
     * @return $this
     */
    public function from($sender = null)
    {
        $this->setPayloadFor('sender', $sender);

        return $this;
    }

    /**
     * Set if the message contains unicode characters
     *
     * @return $this
     */
    public function unicode(): Options
    {
        $this->setPayloadFor('unicode', 1);

        return $this;
    }

    /**
     * Set the recipient of the message, used in OTP apis
     * @param int|null $mobile - recipient's mobile number
     * @return $this
     */
    protected function mobile(int $mobile = null): Options
    {
        $this->setPayloadFor('mobile', $mobile);

        return $this;
    }

    /**
     * Set the recipients of the message, used in SMS APIs
     * @param int|null $mobile - receipient's mobile number(s)
     * @return $this
     */
    protected function mobiles($mobiles = null): Options
    {
        $this->setPayloadFor('mobiles', $mobiles);

        return $this;
    }

    /**
     * Set the message content (same as message method)
     * @param string|null $message
     * @return $this
     */
    public function content(?string $message = ''): Options
    {
        return $this->message($message);
    }

    /**
     * Set the message content (same as content method)
     * @param string|null $message
     * @return $this
     */
    public function message($message = ''): Options
    {
        $this->setPayloadFor('message', $message);

        return $this;
    }

    /**
     * Set the payload for a given key
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    protected function setPayloadFor(string $key, $value): Options
    {
        $this->payload[$key] = $value;

        return $this;
    }

    /**
     * Get the payload of the message
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * Get payload for a given key
     */
    public function getPayloadForKey(string $key, $default = null)
    {
        $payload = $this->getPayload();
        if (isset($payload[$key])) {
            return $payload[$key];
        }

        return $default;
    }

    /**
     * Get the option's array
     * @return array
     */
    public function toArray(): array
    {
        return $this->payload;
    }

    /**
     * Call the given Closure with this instance then return the instance.
     *
     * @param Closure|null $callback
     * @return $this
     */
    public function tap(Closure $callback = null): Options
    {
        if ($callback) {
            $callback($this);
        }

        return $this;
    }

    /**
     * Merge this instance with payload
     * @param int|string|$this|null $payload
     * @return $this;
     */
    public function mergeWith($options = null)
    {
        // do which ever results in true
        $current_payload = $this->getPayload();
        switch (true) {
            case $options instanceof ContractsOptions:
                $this->payload = array_merge($current_payload, $options->toArray());

                break;
            case is_array($options):
                // if it is an array
                $this->payload = array_merge($current_payload, $options);

                break;
            case is_string($options):
                // if it's a string
                $this->content($options);

                break;
            case $options instanceof Closure:
                // let it mutate if it's a closure
                $this->tap($options);

                break;
        }

        return $this;
    }

    /**
     * Resolve the configuration options
     */
    public function resolveConfig(Config $config)
    {
        $this->mergeWith($config->all());
    }

    /**
     * Convert options to json
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
