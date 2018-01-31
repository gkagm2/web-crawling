<?php
class Main extends CI_Controller {
    //초기화
    function __construct(){
        parent::__construct();
    }

    //시작
    function index(){
        $this->load->view('common/header');   
        $this->load->view('contents');
        $this->load->view('goutte');
        $this->load->view('common/footer');
    }
    function testGoutte(){
        //include_once FCPATH . 'vendor/autoload.php';
        $this->load->view('common/header');   
        $this->load->view('contents');
        $this->load->view('goutte');
        $this->load->view('common/footer');
    }
}

?>