<?php

namespace Anburocky3\Msg91\OTP;

use Anburocky3\Msg91\Support\Request;
use Anburocky3\Msg91\URLs;
use GuzzleHttp\RequestOptions;

/**
 * Class VerifyRequest
 * @package Anburocky3\Msg91\OTP
 */
class VerifyRequest extends Request
{
    protected string $url = URLs::OTP_VERIFY_URL;

    protected string $contentType = RequestOptions::FORM_PARAMS;
}
