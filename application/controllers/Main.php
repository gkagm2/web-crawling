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

        $this->output
        ->set_content_type("image/jpeg") 
        ->set_header('Content-Disposition: inline;')
        ->set_output(file_get_contents("C:\Bitnami\wampstack-7.1.12-0\apache2\htdocs\application\views\Python\1.jpeg"));

        $this->load->view('common/footer');
    }
    function test(){

        //$imageUrl = $_POST['imageUrl'];
        $imageUrl = "asdfasdff";

        $this->load->view("showImage",array('imageUrl'=>$imageUrl));
        
    }
}   

?>