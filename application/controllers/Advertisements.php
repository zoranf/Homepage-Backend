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
        $this->_returnAjax(true, $data);
    }

    // Add new advertisement
    public function post()
    {
        $this->_access("post");

        $status = $this->Advertisements_model->add($this->input->post());

        if (is_int($status) === true) {

            $this->_returnAjax(true, ["id" => $status]);
        }

        $this->_returnAjax(false);
    }

    // Delete selected advertisement
    public function delete()
    {
        $this->_access("delete");
        $status = $this->Advertisements_model->delete($this->input->post());

        $this->_returnAjax(true);
    }

    // Enable / selected ad
    public function enable()
    {
        $this->_access("post");
        $satus = $this->Advertisements_model->enable($this->input->post());

        return $this->_returnAjax(true, $status);
    }
}
