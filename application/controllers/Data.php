<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends MY_Controller {

    function __construct() {

        parent::__construct();

        // Load Advertisements_model
        $this->load->model("Advertisements_model");
    }

    // Returns list of advertisements
    public function getAds() {

        $data = $this->Advertisements_model->getAdList();

        return $this->_returnAjax(true, $data);
    }

    // Add new advertisement
    public function postAds($title, $picture, $enabled) {

        $data = [
            "title"     => $title,
            "picture"   => $picture,
            "enabled"   => $enabled
        ];

        $this->Advertisements_model->add($data);
    }

    // Delete spcific advertisement
    public function deleteAds($id) {

        $this->Advertisements_model->delete(array("id" => $id));
    }

    // Enable / spcific ad
    public function enableAd($id) {

        $this->Advertisements_model->enable($id, 1);
    }

    // Disable spcific ad
    public function disableAd($id) {

        $this->Advertisements_model->enable($id, 0);
    }
}
