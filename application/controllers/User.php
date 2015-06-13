<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
    public function authenticate()
    {
        $this->_access("post");
        $this->config->load("siteconfig");

        if ($this->input->post("username") !== $this->config->item("admin_username") || $this->input->post("password") !== $this->config->item("admin_password")) {

            $this->_returnAjax(false, "False credentials.");
        }
        $generatedSID = $this->_generateSID();
        $this->session->set_userdata("sid", $generatedSID);
        $this->_returnAjax(true, ["sid" => $generatedSID]);
    }

    protected function _generateSID()
    {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $randString = "";
        for ($i = 0; $i < 32; $i++) {
            $randString .= $characters[rand(0, strlen($characters)-1)];
        }
        return $randString;
    }
}
