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

        $this->Advertisements_model->add($title, $picture, $enabled);

        return $this->_returnAjax(true, array($title, $picture, $enabled));
    }

    // Delete spcific advertisement
    public function deleteAds($id) {
        $this->_access("DELETE");
        $this->Advertisements_model->delete($id);

        return $this->_returnAjax(true, $id);
    }

    // Enable / spcific ad
    public function enableAd($id) {

        $this->Advertisements_model->enable($id, 1);

        return $this->_returnAjax(true, $id);
    }

    // Disable spcific ad
    public function disableAd($id) {

        $this->Advertisements_model->enable($id, 0);

        return $this->_returnAjax(true, $id);
    }
}
