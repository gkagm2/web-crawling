<?php
use GuzzleHttp\Stream\Stream;
// target site : http://www.smtech.go.kr/front/ifg/no/notice01_list.do
class Smetch extends MyCrawling{
    protected $url;
    function __construct($url){
        $this->url = $url;
    }

    function getUrl($url){
        $this->url = $url;
    }
    function getList(){

        // ZGuzzleHttp\Client를 생성함.
        $client = new GuzzleHttp\Client();

        //https 접속시 ssl 오류가 발생하면, ['verify' => false] 옵션을 추가한다.
        $response = $client->request('GET', $this->url, ['verify' => false]);
        //$response = $client->request('GET', $this->url);


        try {//body부분의 태그들을 가져온다.
            $body = $response->getBody(true);
            echo $body; //body를 출력
        } catch (ClientErrorResponseException $e) {
            $responseBody = $e->getResponse()
                              ->getBody(true);
            echo $responseBody;
        }

        
    }




}


//smetch사이트의 url을 받아옵니다.
$smet = new Smetch('http://www.smtech.go.kr/front/ifg/no/notice01_list.do');  

//list를 불러옵니다.
$smet->getList();


?>