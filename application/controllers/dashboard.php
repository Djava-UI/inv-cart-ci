<?php
class Dashboard extends CI_Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        $data=array(
            'title'=>'Dashboard',
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_dashboard');
        $this->load->view('element/v_footer',$data);
    }

}
