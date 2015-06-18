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
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->_access("post");

        $rules = array(
            array(
                "field" => "title",
                "label" => "Title",
                "rules" => "required|is_unique[advertisements.title]"
            )
        );

        $this->form_validation->set_rules($rules);

        if (empty($this->input->post("title"))) {

            $this->_returnAjax(false, "You must enter the title!");
        } else if ($this->form_validation->run() !== false) {

            $status = $this->Advertisements_model->add($this->input->post());

            if (is_int($status) === true) {

                $this->_returnAjax(true, ["id" => $status]);
            }
        }

        $this->_returnAjax(false, "Change the title.");
    }

    // Update advertisement
    public function edit()
    {
        $this->_access("post");
        $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

        $rules = array(
            array(
                "field" => "id",
                "label" => "ID",
                "rules" => "required|numeric"
            ),
        );

        $this->form_validation->set_rules($rules);

        if (empty($this->input->post("id"))) {

            $this->_returnAjax(false, "ID field is required!");
        } else if ($this->form_validation->run() !== false) {

            $status = $this->Advertisements_model->update($this->input->post());

            $this->_returnAjax($status);
        }

        $this->_returnAjax(false, "Form validation failed.");
    }

    // Delete selected advertisement
    public function delete()
    {
        $this->_access("delete");
        $status = $this->Advertisements_model->delete($this->input->post("id"));

        $this->_returnAjax(true);
    }

    // Enable / selected ad
    public function enable()
    {
        $this->_access("put");
        $status = $this->Advertisements_model->enable($this->input->post());

        $this->_returnAjax($status);
    }
}
