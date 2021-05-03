<?php

namespace Anburocky3\Msg91\OTP;

use Anburocky3\Msg91\Support\Request;
use Anburocky3\Msg91\URLs;

class VerifyRequest extends Request
{
    protected string $url = URLs::OTP_VERIFY_URL;

    protected $content_type = \GuzzleHttp\RequestOptions::FORM_PARAMS;
}
