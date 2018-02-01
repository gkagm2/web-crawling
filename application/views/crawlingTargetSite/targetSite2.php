<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);


include_once FCPATH . '/vendor/autoload.php';


use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
 
class Sir
{
 
    private $protocol = "https";
    private $doamin = "sir.co.kr";
 
 
    public function __construct() {
 
    }
 
    public function __destruct() {
 
    }
 
    public function getList($page = 2) {
 
        $bo_table = "cm_free"; //자유게시판명
 
        $url = $this->protocol."://".$this->doamin."/{$bo_table}/p{$page}";
        $client = new GuzzleHttp\Client();
 
        //https 접속시 ssl 오류가 발생하면, ['verify' => false] 옵션을 추가한다.
        $result = $client->request('GET', $url, ['verify' => false]);
        $html = $result->getBody()->getContents();
 
        $dom = new Crawler($html);
        $items = $dom->filter('div.sir_ul01 ul')->children();
 
        $result = array();
        foreach($items as $item) {
            $row = array();
            $obj = new Crawler($item);
            try {
                $title =  $obj->filter('a.title_link')->text();
                $href = $obj->filter('a.title_link')->attr("href");
                if(strpos($href, "//") ===0) $href = $this->protocol.":".$href;
 
                $row['title'] = trim($title);
                $row['href'] = trim($href);
                $result[] = $row;
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }
 
        return $result;
    }
 
    /**
     * url 에 있는 파일을 다운받아 $filepath 에 저장한다.
     * $filepath 는 cheditor 경로
     * @param $url
     * @param $filepath
     * @param $is_dryrun true : 실제 파일다운로드를 실행하지 않음. default : false
     */
    public function downloadAndSaveImage($url, $filepath, $is_dryrun = false) {
 
        if(!$is_dryrun) {
            $file_handle = fopen($filepath, 'w');
            $client = new \GuzzleHttp\Client();
            $response = $client->get($url, ['save_to' => $file_handle]);
            return ['response_code'=>$response->getStatusCode(), 'url' => $url];
        } else {
            return ['response_code'=>200, 'url' => $url];
        }
    }
}



$sir = new Sir();

for($i = 0; $i < 3; $i++) {
    $list = $sir->getList($i); //자유게시판 리스트를 스크래핑(파싱)한다.
 
    echo "<xmp>";
    print_r($list);
    echo "</xmp>";
}

?>