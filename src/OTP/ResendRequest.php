<?php

namespace Anburocky3\Msg91\OTP;

use Anburocky3\Msg91\Support\Request;
use Anburocky3\Msg91\URLs;
use GuzzleHttp\RequestOptions;

/**
 * Class ResendRequest
 * @package Anburocky3\Msg91\OTP
 */
class ResendRequest extends Request
{
    protected string $url = URLs::OTP_RESEND_URL;

    protected $content_type = RequestOptions::FORM_PARAMS;
}
