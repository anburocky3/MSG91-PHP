<?php


namespace Anburocky3\Msg91\OTP;

use Anburocky3\Msg91\Client;
use Anburocky3\Msg91\Support\Response;
use Anburocky3\Msg91\Support\Service;

/**
 * Class OTPService
 * @package Anburocky3\Msg91\OTP
 */
class OTPService extends Service
{
    /**
     * Options for Request
     * @var Options
     */
    protected \Anburocky3\Msg91\Contracts\Options $options;

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
     * Set the receipients of the message
     * @param int|null $mobile - receipient's mobile number
     * @return $this
     */
    public function to(int $mobile = null)
    {
        $this->options->to($mobile);

        return $this;
    }

    /**
     * Set the method of resending OTP to "text"
     * @return $this
     */
    public function viaText(): OTPService
    {
        return $this->method('text');
    }

    /**
     * Set the method of resending OTP to "voice"
     * @return $this
     */
    public function viaVoice(): OTPService
    {
        return $this->method('voice');
    }

    /**
     * Set the method when resending the otp
     * @param string|null $method
     * @return $this
     */
    protected function method(?string $method = ''): OTPService
    {
        $this->options->method($method);

        return $this;
    }

    /**
     * Set the template id for OTPs
     * @return $this
     */
    public function template($template_id = null): OTPService
    {
        $this->options->template($template_id);

        return $this;
    }

    /**
     * Send otp
     * @return Response
     */
    public function send()
    {
        return $this->sendRequest(SendRequest::class);
    }

    /**
     * @return Response
     */
    public function verify()
    {
        return $this->sendRequest(VerifyRequest::class);
    }

    /**
     * @return Response
     */
    public function resend()
    {
        return $this->sendRequest(ResendRequest::class);
    }
}
