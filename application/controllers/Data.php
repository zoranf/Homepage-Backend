<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends MY_Controller {

    // Returns array of Advertisements
    public function getAds() {

      $this->load->model('Advertisements_model');
      $data = $this->Advertisements_model->getList();

      return $this->_returnAjax(true, $data);
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
