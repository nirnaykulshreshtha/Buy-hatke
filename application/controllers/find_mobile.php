<?php

/**
 * Created by IntelliJ IDEA.
 * User: daner
 * Date: 10/19/2016
 * Time: 9:46 AM
 */
class find_mobile extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('find_mobiles');
    }

    public function index(){
        $this->load->view('menu');
        $this->load->view('find');
    }

    function get_mob(){
        if (isset($_GET['term'])) {
            $string = strtolower($_GET['term']);
            $this->find_mobiles->get_mobile($string);
        }
    }

    function showdata(){
        if(isset($_GET['find_mobile'])){
            $name = $_GET['find_mobile'];
        }
        $data['data'] = ($this->find_mobiles->show_price($name));
        $this->load->view('menu');
        $this->load->view('show', $data);

    }

    function showdatafull(){
        $this->find_mobiles->show_prices();
    }
}