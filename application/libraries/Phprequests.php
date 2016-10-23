<?php
/**
 * Created by IntelliJ IDEA.
 * User: janruls1
 * Date: 15-08-2016
 * Time: 01:34
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/libraries/requests/Requests.php";
class PHPRequests {
    public function __construct() {
        Requests::register_autoloader();
    }
}