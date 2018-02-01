<?php
use GuzzleHttp\Stream\Stream;

//Crawler를 사용하기위해
use Symfony\Component\DomCrawler\Crawler;

use Symfony\Component\CssSelector;


/************ 클래스 area *************/

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


        /* 응답받기 */

        //https 접속시 ssl 오류가 발생하면, ['verify' => false] 옵션을 추가한다.
        $response = $client->request('GET', $this->url, ['verify' => false]);
        //$response = $client->request('GET', $this->url); //이것으로 해도 됨.


        try {//body부분의 태그들을 가져온다.
            //$body = $response->getBody(true);
            $body = $response->getBody()->getContents();
            //echo $body; //body를 출력
        } catch (ClientErrorResponseException $e) {
            $responseBody = $e->getResponse()
                              ->getBody(true);
            echo $responseBody;
        }


        /* 페이지 긁기 */
        //추출하기
        $crawler = new Crawler($body);
        $filter = '.tbl_type01'; //필터에서 이부분을 걸러요.
        $catsHTML = $crawler
                        ->filter($filter)
                        ->each(function (Crawler $node) {
                            return $node->html();
                        });
        unset($crawler); //추출한 다음 크롤러의 객체가 필요 없으므로 제거

        //echo $catsHTML;
        foreach($catsHTML as $v){
            var_dump($v);
        }
//        $catsHTML;
    }




}

/************ 실행 area **************/


//smetch사이트의 url을 받아옵니다.
$smet = new Smetch('http://www.smtech.go.kr/front/ifg/no/notice01_list.do');  

//list를 불러옵니다.
$smet->getList();


?>