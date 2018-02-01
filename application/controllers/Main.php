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
        $this->load->view('contents');    
        $this->load->view('goutte');
        
        $this->load->view('crawlingClass/crawling');    
        $this->load->view('crawlingTargetSite/targetSite');

        $this->load->view('common/footer');
    }
    function testGoutte(){
        
        $this->load->view('contents');
        $this->load->view('goutte');
        $this->load->view('common/footer');
    }
    function testCode1(){
        
        $this->load->view('testParseCode/testcode1');
        $this->load->view('common/footer');
    }
}

?>