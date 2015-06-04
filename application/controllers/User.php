<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
    public function login()
    {
        $this->config->load("siteconfig");

        if ($this->data->username !== $this->config->item("admin_username") || $this->data->password !== $this->config->item("admin_password")) {

            $this->_returnAjax(false);
        }
        $this->_returnAjax(true);
    }
}
