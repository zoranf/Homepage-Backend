<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertisements extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->_checkAuthentication();
        // Load Advertisements_model
        $this->load->model("Advertisements_model");
    }

    // Returns list of advertisements
    public function get()
    {
        $this->_access("get");
        $data = $this->Advertisements_model->getAdList();
        return $this->_returnAjax(true, $data);
    }

    // Add new advertisement
    public function post()
    {
        $this->_access("post");
        $this->Advertisements_model->add($title, $picture, $enabled);
        return $this->_returnAjax(true, array($title, $picture, $enabled));
    }

    // Delete spcific advertisement
    public function delete($id)
    {
        $this->_access("delete");
        $this->Advertisements_model->delete($id);

        return $this->_returnAjax(true, $id);
    }

    // Enable / spcific ad
    public function enable($id)
    {
        $this->_access("put");
        $this->Advertisements_model->enable($id, 1);

        return $this->_returnAjax(true, $id);
    }

    // Disable spcific ad
    public function disable($id)
    {
        $this->_access("put");
        $this->Advertisements_model->enable($id, 0);

        return $this->_returnAjax(true, $id);
    }
}
