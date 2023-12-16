<?php

require "../models/model.php";
require '../../vendor/autoload.php'; // Include Composer's autoloader

use app\models\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["event_name"]) && $_POST["event_name"] == 'send_message') {
        try {
            $client = new Client();
            $headers = [
                'Authorization' => 'Basic ' . $_POST["API_KEY"],
                'Content-Type' => 'application/json'
            ];
            $body = '{
        "countryCode": "+91",
        "phoneNumber": "' . $_POST['customer_mobile_no'] . '",
        "callbackData": "Hello",
        "type": "Template",
        "template": {
            "name": "' . $_POST['template_name'] . '",
            "languageCode": "en",
            "headerValues": [
                "https://interaktprodstorage.blob.core.windows.net/mediaprodstoragecontainer/acfcda27-3c33-45d3-8726-f6c5435828c0/message_template_media/ltdFpVSxLWQG/logo-no_background-high-21-removebg-preview%20%282%29.png?se=2028-12-06T09%3A19%3A52Z&sp=rt&sv=2019-12-12&sr=b&sig=JjKlzPAbzoxwo/dgIC3jMvV%2BLdxE7h/xHLM%2By0ZpEwo%3D"
              ],
            "bodyValues": [
                "' . $_POST["customer_name"] . '"
            ],
            "buttonValues": {
            }
        }
    }';
            $request = new Request('POST', 'https://api.interakt.ai/v1/public/message/', $headers, $body);
            $res = $client->send($request);

            echo $res->getBody();
            return true;
        } catch (GuzzleHttp\Exception\ClientException $e) {
            echo "Error: " . $e->getResponse()->getBody()->getContents();
            return true;
        }
    }
}
