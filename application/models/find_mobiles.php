<?php

/**
 * Created by IntelliJ IDEA.
 * User: daner
 * Date: 10/19/2016
 * Time: 10:00 AM
 */
class find_mobiles extends CI_Model {
    private $table = 'mobile';
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_mobile($string){
        $this->db->select('title');
        $this->db->like('title', $string);
        $this->db->limit(5);
        $query = $this->db->get('mobile');
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = htmlentities(stripslashes($row['title'])); //build an array
            }
            echo json_encode($row_set); //format the array into json data
        }else{
            echo 'No Search Found';
        }
    }

    public function show_price($name){
        $query = "SELECT DISTINCT data_asin, title, price, href, source, imgsrc FROM $this->table WHERE title LIKE '%$name%'";
        $result = $this->db->query($query);
        $row_set = array();
        $i = 0;
        if($result->num_rows() > 0){
            foreach ($result->result_array() as $row){
                $row_set[$i]['product_name'] = htmlentities(stripslashes($row['title'])); //build an array
                $row_set[$i]['product_price'] = htmlentities(stripslashes($row['price']));
                $row_set[$i]['product_href'] = htmlentities(stripslashes($row['href']));
                $row_set[$i]['product_source'] = htmlentities(stripslashes($row['source']));
                $row_set[$i]['product_imgsrc'] = htmlentities(stripslashes($row['imgsrc']));
                $row_set[$i++]['product_data_asin'] = htmlentities(stripslashes($row['data_asin']));
            }
            return ($row_set); //format the array into json data
        }
    }

    public function show_prices(){
        $query = "SELECT DISTINCT title, price, href, source, imgsrc, data_asin FROM $this->table";
        $result = $this->db->query($query);
        $row_set = array();
        $i = 0;
        if($result->num_rows() > 0){
            foreach ($result->result_array() as $row){
                $row_set[$i]['product_name'] = htmlentities(stripslashes($row['title'])); //build an array
                $row_set[$i]['product_price'] = htmlentities(stripslashes($row['price']));
                $row_set[$i]['product_href'] = htmlentities(stripslashes($row['href']));
                $row_set[$i]['product_source'] = htmlentities(stripslashes($row['source']));
                $row_set[$i]['product_imgsrc'] = htmlentities(stripslashes($row['imgsrc']));
                $row_set[$i++]['product_data_asin'] = htmlentities(stripslashes($row['data_asin']));
            }
            echo json_encode($row_set); //format the array into json data
        }
    }
}