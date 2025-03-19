<?php

namespace App\Controllers;

use DinoEngine\Helpers\Helpers;
use DinoEngine\Http\Request;
use DinoEngine\Http\Response;
use Vimeo\Vimeo;

class AdminController
{
    public static function index(string $nameApp): void{

        $client = new Vimeo($_ENV['CLIENT_ID_VIMEO'], $_ENV['CLIENT_SECRET_VIMEO'], $_ENV['TOKEN_ACCESS_VIMEO']);
        $alerts = [];

        if(Request::isPOST()){

            $metaData = Request::getPostData();
            $videoFile = $_FILES['video'];

            $uri = $client->upload($videoFile['tmp_name'], [
                'name' => $metaData['name'],
                'description' => $metaData['desc'],
            ]);

            $response = $client->request($uri . '?fields=transcode.status');
            if ($response['body']['transcode']['status'] === 'complete') {
                $alerts['exito'][] = 'Your video finished transcoding.';   
            } elseif ($response['body']['transcode']['status'] === 'in_progress') {
                $alerts['advertencia'][] = 'Your video is still transcoding.';
            } else {
                $alerts['error'][] = 'Your video encountered an error during transcoding.';
            }

            $response = $client->request($uri . '?fields=link');
            $alerts['exito'][] = "Your video link is: " . $response['body']['link'];

        }

        Response::render('pages_admin/upload', [
            'nameApp'=>$nameApp, 
            'title' => 'Login',
            'alertas' => $alerts
        ]);
    }

    public static function test(string $nameApp):void{
        $client = new Vimeo($_ENV['CLIENT_ID_VIMEO'], $_ENV['CLIENT_SECRET_VIMEO'], $_ENV['TOKEN_ACCESS_VIMEO']);

        $response = $client->request('/tutorial', array(), 'GET');
        print_r($response);
    }   

}