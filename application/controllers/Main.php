<?php
class Main extends CI_Controller {
    //초기화
    function __construct(){
        parent::__construct();

        $this->load->view('common/header');   
        $this->load->view('common/navigate');
    }

    //시작
    function index(){
        $this->load->view('common/footer');
    }

    //크롤링 한 사이트들
    function siteTarget($getSite){
        $this->load->view('goutte');
        
        $this->load->view('crawlingClass/crawling');    

        switch($getSite){
            case 1:
                //target site
                $this->load->view('crawlingTargetSite/targetSite');
            break;
            case 2:
                //test site
                $this->load->view('crawlingTargetSite/targetSite2');
            break;

        }
        
        $this->load->view('common/footer');
    }
}

?>