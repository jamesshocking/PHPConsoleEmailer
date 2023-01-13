<?php


use Symfony\Component\HttpClient\HttpClient;


class Mail2RUWebModel 
{
    public function getEmailAddresses($web_url = "") {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', $web_url);

        print $web_url;

        $addresses = [];

        if($response->getStatusCode() == 200) {
            $findStart = "var addresses=[";
            $findEnd = "];";

            $content = $response->getContent();
        //    print($content);
            $startPos = strpos($content, $findStart);
            if($startPos != FALSE) {
                $endPos = strpos($content, $findEnd, $startPos);
                if($endPos != FALSE) {
                    $addressesRaw = substr($content, $startPos+strlen($findStart), $endPos-($startPos+strlen($findStart)));

                    //
                    $addressArray = explode(',', $addressesRaw);
                    foreach($addressArray as $value) {
                        // clean up the addresses and load into the $address array
                        array_push($addresses, str_replace("\"", "", $value));
                    }
                }
            }            
        }
        else {
            echo "response is not 200";
        }

        return $addresses;
    }

}

?>
