<?php


namespace MahdiIDea\SmsIrLaravel6\Classes;


class SentMessageResponseById
{
    /**
     * gets API Message Send Url.
     *
     * @return string Indicates the Url
     */
    protected function getAPIMessageSendUrl()
    {
        return "http://RestfulSms.com/api/MessageSend";
    }

    /**
     * gets Api Token Url.
     *
     * @return string Indicates the Url
     */
    protected function getApiTokenUrl()
    {
        return "http://RestfulSms.com/api/Token";
    }

    /**
     * gets config parameters for sending request.
     *
     * @param string $APIKey API Key
     * @param string $SecretKey Secret Key
     * @return void
     */
    public function __construct($APIKey, $SecretKey)
    {
        $this->APIKey = $APIKey;
        $this->SecretKey = $SecretKey;
    }

    /**
     * Sent Message Response By Id.
     *
     * @param string $id messages id
     * @return string Indicates the sent sms result
     */
    public function SentMessageResponseById($id)
    {

        $token = (new GetToken($this->APIKey, $this->SecretKey))->GetToken();
        if ($token != false) {

            $url = $this->getAPIMessageSendUrl() . "?id=" . $id;
            $SentMessageResponseById = $this->execute($url, $token);

            $object = json_decode($SentMessageResponseById);

            if (is_object($object)) {
                $array = get_object_vars($object);
                if (is_array($array)) {
                    if ($array['IsSuccessful'] == true) {
                        $result = $array['Messages'];

                    } else {
                        $result = $array['Message'];
                    }
                } else {
                    $result = false;
                }
            } else {
                $result = false;
            }

        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * executes the main method.
     *
     * @param string $url url
     * @param string $token token string
     * @return string Indicates the curl execute result
     */
    private function execute($url, $token)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'x-sms-ir-secure-token: ' . $token
        ));

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
