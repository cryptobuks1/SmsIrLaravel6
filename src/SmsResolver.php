<?php

namespace MahdiIDea\SmsIrLaravel6;

use MahdiIDea\SmsIrLaravel6\Classes\GetToken;
use MahdiIDea\SmsIrLaravel6\Classes\GetCredit;
use MahdiIDea\SmsIrLaravel6\Classes\GetSmsLines;
use MahdiIDea\SmsIrLaravel6\Classes\SendMessage;
use MahdiIDea\SmsIrLaravel6\Classes\SentMessageResponseByDate;
use MahdiIDea\SmsIrLaravel6\Classes\SentMessageResponseById;
use MahdiIDea\SmsIrLaravel6\Classes\UltraFastSend;
use MahdiIDea\SmsIrLaravel6\Classes\VerificationCode;

/**
 * Class SmsResolver
 * @package MahdiIDea\SmsIrLaravel6
 *
 * @property string line
 * @property string apiKey
 * @property string secretKey
 */
class SmsResolver
{
    /**
     * SmsResolver constructor.
     */
    public function __construct()
    {
        $this->line = env("SMS_IR_LINE");
        $this->apiKey = env("SMS_IR_API_KEY");
        $this->secretKey = env("SMS_IR_SECRET_KEY");
    }

    /** @return SmsResolver */
    public static function instance(): SmsResolver
    {
        return (new SmsResolver);
    }

    /** @return float */
    public function credit()
    {
        return (new GetCredit($this->apiKey, $this->secretKey))->GetCredit();
    }

    /** @return array */
    public function lines()
    {
        return (new GetSmsLines($this->apiKey, $this->secretKey))->GetSmsLines();
    }

    /** @return string */
    public function token()
    {
        return (new GetToken($this->apiKey, $this->secretKey))->GetToken();
    }

    /**
     * @param string $phone
     * @param string|int $code
     * @return string
     */
    public function verification($phone, $code)
    {
        return (new VerificationCode($this->apiKey, $this->secretKey))->VerificationCode($code, $phone);
    }

    /**
     * @param array $data
     * @return string
     */
    public function ultraFastSend(array $data)
    {
        return (new UltraFastSend($this->apiKey, $this->secretKey))->UltraFastSend($data);
    }

    /**
     * @param string $line
     * @param array|string $phone
     * @param array|string $text
     * @return string
     */
    public function send($phone, $text, $line = null)
    {
        return (new SendMessage($this->apiKey, $this->secretKey, $line ?? $this->line))->SendMessage(is_array($phone) ? $phone : array($phone), is_array($text) ? $text : array($text), date("Y-m-d\TH:i:s"));
    }
}
