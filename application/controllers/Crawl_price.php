<?php

/**
 * Created by IntelliJ IDEA.
 * User: daner
 * Date: 10/19/2016
 * Time: 1:04 PM
 */
class Crawl_price extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('crawl');
        $this->load->library('simple_html_dom.php');
        ini_set('max_execution_time', 0);
    }

    public function amazon_crawl(){
        //$link = 'https://www.amazon.in/s/ref=sr_pg_3?rh=n%3A976419031%2Cn%3A%21976420031%2Cn%3A1389401031%2Cn%3A1389432031&page=3&ie=UTF8&qid=1476903872&spIA=B01EX1WWNE,B01KCLAKQ0,B00UVA8EK2';
        $link = 'https://www.amazon.in/s/ref=lp_1389401031_nr_n_1?fst=as%3Aoff&rh=n%3A976419031%2Cn%3A%21976420031%2Cn%3A1389401031%2Cn%3A1389432031&bbn=1389401031&ie=UTF8&qid=1476862203&rnid=1389401031';
        $html = new simple_html_dom();

        $html->load_file($link);


        $ret = $html->find('div[id=mainResults]');
        echo '<pre>';

        $data = array();

        foreach($ret as $ret1){
            $result = $ret1->find('ul li');
            $i = 0;
            foreach($result as $result1){
                if(!($result1->{"data-asin"}) || strlen(($result1->{"data-asin"})) == 0)
                    continue;
                $data['data_asin'] = ($result1->{"data-asin"});
                $img = $result1->find('img');
                foreach ($img as $img1)
                    $data['imgsrc'] = ($img1->src);
                $x = ($result1->find('div div[class=a-row a-spacing-none] a'));
                foreach($x as $x1){
                    $t =($x1->find('span[class=a-size-base a-color-price s-price a-text-bold]'));
                    foreach($t as $t1){
                        //print_r ($t1->plaintext);
                        $data['price'] = ($t1->plaintext);
                    }
                }
                $z = ($result1->find('div div[class=a-row a-spacing-mini] div[class=a-row a-spacing-none] a'));
                foreach($z as $ze){
                    $data['href'] = ($ze->href);
                    if(!empty($ze->title)){
                        $data['title'] = ($ze->title);
                    }
                    $data['source'] = 'amazon.in'; //pass this data array to model
                }
                //print_r($data);
                $this->crawl->amazon($data);
            }
        }
    }

    public function amazon_crawl_other(){
        $i = 2;
        for($i=2; $i<100; $i++){
        $link = 'https://www.amazon.in/s/ref=sr_pg_3?rh=n%3A976419031%2Cn%3A%21976420031%2Cn%3A1389401031%2Cn%3A1389432031&page='.$i.'&ie=UTF8&qid=1476903872&spIA=B01EX1WWNE,B01KCLAKQ0,B00UVA8EK2';
        //$i = $i + 1;
        $html = new simple_html_dom();

        $html->load_file($link);

        $ret = $html->find('div[id=atfResults]');
        echo '<pre>';

        $data = array();

        foreach($ret as $ret1){
            $result = $ret1->find('ul li');
            foreach($result as $result1){
                if(!($result1->{"data-asin"}) || strlen(($result1->{"data-asin"})) == 0)
                    continue;
                $data['data_asin'] = ($result1->{"data-asin"});
                $img = $result1->find('img');
                foreach ($img as $img1)
                    $data['imgsrc'] = ($img1->src);
                $x = ($result1->find('div div[class=a-row a-spacing-none] a'));
                foreach($x as $x1){
                    $t =($x1->find('span[class=a-size-base a-color-price s-price a-text-bold]'));
                    foreach($t as $t1){
                        //print_r ($t1->plaintext);
                        $data['price'] = ($t1->plaintext);
                    }
                }
                $z = ($result1->find('div div[class=a-row a-spacing-mini] div[class=a-row a-spacing-none] a'));
                foreach($z as $ze){
                    //print_r ($ze->title);
                    //print_r ($ze->href);
                    $data['href'] = ($ze->href);
                    if(!empty($ze->title)){
                        $data['title'] = ($ze->title);
                    }
                }
                //pass this data array to model
                //print_r($data);
                $data['source'] = 'amazon.in';
                $this->crawl->amazon($data);
            }
        }
    }
    }

    public function flipkart(){
        $this->load->library('Phprequests');
        $link = 'https://www.flipkart.com/api/3/search/summary';
        $data = '{"requestContext":{"store":"tyy,4io","start":0,"disableProductData":true,"count":60,"ssid":"m4b1xzlag0g0cwko1476954994218","sqid":"3w0t9sxyhsk4ook81476954994218"}}';
        $json_decode = json_decode($data);
        $request = array();
        echo '<pre>';
        //print_r($json_decode);
        foreach ($json_decode as $json){
            $request['store'] = $json->store;
            $request['start'] = $json->start;
            $request['disableProductData'] = $json->disableProductData;
            $request['count'] = $json->count;
            $request['ssid'] = $json->ssid;
            $request['sqid'] = $json->sqid;
        }
        $context  = stream_context_create($request);
        $result = file_get_contents($link, false, $context);
        print_r($result);
//        print_r($request);
//        $response = Requests::post($link, array(), json_encode($request));
//        print_r($response->body);
    }
}