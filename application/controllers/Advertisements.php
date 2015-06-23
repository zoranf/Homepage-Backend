<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Services for admin control purposes
 */
class Advertisements extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->_checkAuthentication();
        $this->load->model("Advertisements_model");
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    // Returns list of advertisements
    public function get()
    {
        $this->_access("get");
        $data = $this->Advertisements_model->getAdList(Advertisements_model::FULL_LIST);
        $this->_returnAjax(true, $data);
    }

    // Add new advertisement
    public function post()
    {
        $this->_access("post");

        // error if picture is not sent
        if ($this->_fileInRequest() === false) {
            $this->_returnAjax(false, "Picture is required.");
        }

        $data = $this->input->post();

        // upload file configuration
        $config['upload_path']          = "./upload/";
        $config['allowed_types']        = "gif|jpg|png|jpeg";
        $config['file_name']            = $data["title"];
        $config['overwrite']            = false;
        $config['max_size']             = 100000;
        $config['max_width']            = 10240;
        $config['max_height']           = 7680;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config);

        $rules = array(
            array(
                "field" => "title",
                "label" => "Title",
                "rules" => "required|is_unique[advertisements.title]"
            )
        );

        $this->form_validation->set_rules($rules);

        if (empty($data["title"]) === true) {

            $this->_returnAjax(false, "You must enter the title!");
        } else if ($this->form_validation->run() === true) {

            if ($this->upload->do_upload("picture") === true) {

                $uploadData = $this->upload->data();
                $data["picture"] = $uploadData["file_name"];
                $status = $this->Advertisements_model->add($data);

                if (is_int($status) === true) {
                    $this->_returnAjax(true, ["id" => $status]);
                }

            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->_returnAjax(false, "Uploading file failed.");
            }

        }

        $this->_returnAjax(false, "Change the title.");
    }

    // Update advertisement
    public function edit()
    {
        $this->_access("post");
        $this->load->library('form_validation');

        $data = $this->input->post();

        $fileInRequest = $this->_fileInRequest();
        if ($fileInRequest === true) {
            // upload file configuration
            $config['upload_path']          = "./upload/";
            $config['allowed_types']        = "gif|jpg|png|jpeg";
            $config['file_name']            = $data["title"];
            $config['overwrite']            = false;
            $config['max_size']             = 100000;
            $config['max_width']            = 10240;
            $config['max_height']           = 7680;
            $config['file_ext_tolower']     = true;

            $this->load->library('upload', $config);
        }

        $rules = array(
            array(
                "field" => "id",
                "label" => "ID",
                "rules" => "required"
            )
        );

        $this->form_validation->set_rules($rules);

        if (empty($data["id"]) === true) {
            $this->_returnAjax(false, "ID field is required!");
        } else if ($this->form_validation->run() === true) {
            if ($fileInRequest === true) {
                if ($this->upload->do_upload("picture") === true) {
                    $newImgData = $this->upload->data();
                    $data["picture"] = $newImgData["file_name"];
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    $this->_returnAjax(false, "Uploading file failed.");
                }
            }

            $status = $this->Advertisements_model->update($data);
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

    protected function _fileInRequest()
    {
        if (empty($_FILES["picture"]["name"]) === true) {
            return false;
        }
        return true;
    }
}
