<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends MY_Controller
{
    public function getAds()
    {
        // test response --
        $array = [
            "advertisements" => ["slika1.png", "slika2.png"]
        ];
        $this->load->model("Advertisements_model");
        $data = $this->Advertisements_model->get_last_ten_entries();
        var_dump($data);die();

        print json_encode($array);die();
    }

    public function postAds()
    {
        print json_encode(["success" => true]);die();
    }

    public function deleteAds()
    {
        print json_encode(["success" => true]);die();
    }

    public function enableAd()
    {
        print json_encode(["success" => true]);die();
    }

    public function disableAd()
    {
        print json_encode(["success" => true]);die();
    }
}
