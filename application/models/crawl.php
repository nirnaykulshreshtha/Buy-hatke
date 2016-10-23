<?php

/**
 * Created by IntelliJ IDEA.
 * User: daner
 * Date: 10/19/2016
 * Time: 3:55 PM
 */
class crawl extends CI_Model {
    private $table = 'mobile';

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function amazon($data){
        
        $price = str_replace(',','',$data['price']);
        $price = intval(str_replace('&nbsp;','',$price)).'.00';

        $query = "INSERT IGNORE INTO $this->table (title, href, price, source, imgsrc, data_asin) values ('{$data['title']}', '{$data['href']}', $price, '{$data['source']}', '{$data['imgsrc']}', '{$data['data_asin']}')";
        $this->db->query($query);
    }

    public function amazon_link($array){

    }
}