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
        $this->session->set_userdata("loggedIn", true);
        $this->_returnAjax(true);
    }
}
