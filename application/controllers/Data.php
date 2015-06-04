<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function advertisements()
    {
        // test response
        $array = [
            "advertisements" => ["slika1.png", "slika2.png"]
        ];
        print json_encode($array);die();
    }
}
