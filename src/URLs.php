<?php


namespace Anburocky3\Msg91;

class URLs
{
    /**
     * URL for Send OTP Request
     * @var string
     */
    public const OTP_URL = 'https://api.msg91.com/api/v5/otp';

    /**
     * URL for Verify OTP
     * @var string
     */
    public const OTP_VERIFY_URL = 'https://api.msg91.com/api/v5/otp/verify';

    /**
     * URL for Resend OTP Request
     * @var string
     */
    public const OTP_RESEND_URL = 'https://api.msg91.com/api/v5/otp/retry';

    /**
     * URL for send sms
     * @var string
     */
    public const SEND_SMS_URL = 'https://api.msg91.com/api/v5/flow/';
}
