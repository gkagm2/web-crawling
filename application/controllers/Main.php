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

        //getSite로 사이트를 표출.
        $this->load->view('crawlingTargetSite/targetSite' . $getSite);
      
        $this->load->view('common/footer');
    }
}

?>