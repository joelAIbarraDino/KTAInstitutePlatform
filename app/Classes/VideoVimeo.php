<?php

namespace App\Clases;

use DinoEngine\Http\Response;
use InvalidArgumentException;
use Vimeo\Vimeo as Vimeo;

class VideoVimeo{
    
    private static string $clientID;
    private static string $clientSecret;
    private static string $accessToken;
    
    public string $name;
    public string $description;
    public string $urlFile;

    public function __construct($name, $description, $urlFile){

        self::$clientID = $_ENV['CLIENT_ID_VIMEO']??null;
        self::$clientSecret = $_ENV['CLIENT_SECRET_VIMEO']??null;
        self::$accessToken = $_ENV['TOKEN_ACCESS_VIMEO']??null;

        $this->name = $name;
        $this->description = $description;
        $this->urlFile = $urlFile;
    }


    public function uploadURL():void{
    }

    public function uploadVideo():array{
        $vimeo = new Vimeo(self::$clientID, $this->clientSecret, $this->accessToken);

        $uri = $vimeo->upload($this->urlFile, [
            'name' => $this->name,
            'description' => $this->description
        ]);


        $response = $vimeo->request($uri.'?fields=transcode.status');

        $status = $response['body']['transcode']['status'];
        $url = null;


        if($status == 'complete'){
            $response = $vimeo->request($uri . '?fields=link');
            $url = $response['body']['link'];    
        }else if($status == 'in_progress'){
            $response = $vimeo->request($uri . '?fields=link');
            $url = $response['body']['link'];
        }else{
            $status = null;
        }

        $res = [
            'status'=> $status,
            'url'=> $url
        ];

        return $res;
    }
}