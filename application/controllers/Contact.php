<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Services for admin control purposes
 */
class Contact extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->_checkAuthentication(); // Kontrola prometa
    }
    
    // User sends mail to admin
    public function sendMail()
    {
        $data = $this->input->post();        
        
        // Admin email
        $admin = "zoran.felbar@gmail.com";
        
        // User data
        $email = $data["email"];
        $name = $data["name"];
        $subject = $data["subject"];
        $message = $data["message"];
        
        // Helper/Library
        $this->load->library('email');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));

        // Sending mail from, user -> admin
        $this->email->from($email, $name);
        $this->email->to($admin); 

        $this->email->subject($subject);
        $this->email->message($message);	

        // Send mail
        $this->email->send();

        //echo $this->email->print_debugger();
    } 
}
