<?php

namespace Anburocky3\Msg91\OTP;

use Anburocky3\Msg91\Support\Request;
use Anburocky3\Msg91\URLs;

/**
 * Class SendRequest
 * @package Anburocky3\Msg91\OTP
 */
class SendRequest extends Request
{
    protected string $url = URLs::OTP_URL;
}
