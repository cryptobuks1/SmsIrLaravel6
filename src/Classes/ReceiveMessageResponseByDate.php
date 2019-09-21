<?php


namespace MahdiIDea\SmsIrLaravel6\Classes;


class ReceiveMessageResponseByDate
{
    /**
     * gets API Message Receive Url.
     *
     * @return string Indicates the Url
     */
    protected function getAPIMessageReceiveUrl()
    {
        return "http://RestfulSms.com/api/ReceiveMessage";
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
     * Gets Sent Message Response By Date.
     *
     * @param string $Shamsi_FromDate Shamsi From Date
     * @param string $Shamsi_ToDate Shamsi To Date
     * @param string $RowsPerPage Rows Per Page
     * @param string $RequestedPageNumber Requested Page Number
     * @return string Indicates the sent sms result
     */
    public function ReceiveMessageResponseByDate($Shamsi_FromDate, $Shamsi_ToDate, $RowsPerPage, $RequestedPageNumber)
    {

        $token = (new GetToken($this->APIKey, $this->SecretKey))->GetToken();
        if ($token != false) {

            $url = $this->getAPIMessageReceiveUrl() . "?Shamsi_FromDate=" . $Shamsi_FromDate . "&Shamsi_ToDate=" . $Shamsi_ToDate . "&RowsPerPage=" . $RowsPerPage . "&RequestedPageNumber=" . $RequestedPageNumber;
            $ReceiveMessageResponseByDate = $this->execute($url, $token);

            $object = json_decode($ReceiveMessageResponseByDate);

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

//try {
//
//    date_default_timezone_set("Asia/Tehran");
//
//    // your sms.ir panel configuration
//    $APIKey = "enter your api key ...";
//    $SecretKey = "enter your secret key ...";
//
//    $Shamsi_FromDate = '1397/02/1';
//    $Shamsi_ToDate = '1397/02/31';
//    $RowsPerPage = 10;
//    $RequestedPageNumber = 1;
//
//    $SmsIR_ReceiveMessageResponseByDate = new SmsIR_ReceiveMessageResponseByDate($APIKey, $SecretKey);
//    $ReceiveMessageResponseByDate = $SmsIR_ReceiveMessageResponseByDate->ReceiveMessageResponseByDate($Shamsi_FromDate, $Shamsi_ToDate, $RowsPerPage, $RequestedPageNumber);
//    var_dump($ReceiveMessageResponseByDate);
//
//} catch (Exeption $e) {
//    echo 'Error ReceiveMessageResponseByDate : ' . $e->getMessage();
//}
