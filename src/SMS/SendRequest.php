<?php

namespace Anburocky3\Msg91\SMS;

use Anburocky3\Msg91\Support\Request;
use Anburocky3\Msg91\URLs;

class SendRequest extends Request
{
    protected string $url = URLs::SEND_SMS_URL;

    protected function validate(array $payload)
    {
        parent::validate($payload);
        $flow_id = $payload['flow_id'] ?? "";
        if (! $flow_id) {
            $this->validator->addError('flow_id', 'Please provide a Flow ID for the sms.');
        }
    }
}
