<?php

require "../models/model.php";

use app\models\Model;

$model = (new Model());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["event_name"]) && $_POST["event_name"] == 'send_message') {

        $curl = curl_init();
        echo  $_POST['customer_mobile_no'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.interakt.ai/v1/public/message/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "countryCode": "+91",
                "phoneNumber": "' . $_POST['customer_mobile_no'] . '",
                "callbackData": "some text here",
                "type": "Template",
                "template": {
                    "name": "' . $_POST['template_name'] . '",
                    "languageCode": "en",
                    "headerValues": [
                        "https://interaktprodstorage.blob.core.windows.net/mediaprodstoragecontainer/acfcda27-3c33-45d3-8726-f6c5435828c0/message_template_media/ltdFpVSxLWQG/logo-no_background-high-21-removebg-preview%20%282%29.png?se=2028-12-06T09%3A19%3A52Z&sp=rt&sv=2019-12-12&sr=b&sig=JjKlzPAbzoxwo/dgIC3jMvV%2BLdxE7h/xHLM%2By0ZpEwo%3D"
                      ],
                    "bodyValues": [
                        "' . $_POST["customer_name"] . '"
                        ]
                    }
                }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $_POST["API_KEY"],
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        return true;
    }
}
