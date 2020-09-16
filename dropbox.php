<?php
$filename = 'images.zip';

$api_url = 'https://content.dropboxapi.com/2/files/upload'; //dropbox api url
        $token = 'ayQLtp4V6QsAAAAAAAAAAX24XJjV0mV8G2wIpZVNRIvPSc3n8MwAIJf6UbdbDpXJ'; // oauth token

        $headers = array('Authorization: Bearer '. $token,
            'Content-Type: application/octet-stream',
            'Dropbox-API-Arg: '.
            json_encode(
                array(
                    "path"=> '/'."test/". basename($filename),
                    "mode" => "add",
                    "autorename" => true,
                    "mute" => false
                )
            )

        );

        $ch = curl_init($api_url);

       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_POST, true);

        $path = $filename;


        $fp = fopen($path, 'rb');
        $filesize = filesize($path);

         curl_setopt($ch, CURLOPT_POSTFIELDS, fread($fp, $filesize));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, 1); // debug

        $response = curl_exec($ch);


        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);



        echo($response.'<br/>');
        echo($http_code.'<br/>');

        curl_close($ch);