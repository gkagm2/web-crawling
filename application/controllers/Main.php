<?php
class Main extends CI_Controller {
    //초기화
    function __construct(){
        parent::__construct();

        $this->load->view('common/header');   
        $this->load->view('common/navigate');
    }
    function __destruct (){
        $this->load->view('common/footer');

    }

    //시작
    function index(){
    }

    //크롤링 한 사이트들
    function siteTarget($getSite){
        $this->load->view('crawlingAsset/goutte');
        
        $this->load->view('crawlingClass/crawling');    

        //getSite로 사이트를 표출.
        $this->load->view('crawlingTargetSite/targetSite' . $getSite);

    }
    function cartoon(){
        $this->load->view('python/cartoon.csv');
    }
    function basketball_player_info(){
        $this->load->view('python/Test7_Basketball.csv');
    }
}   

?>