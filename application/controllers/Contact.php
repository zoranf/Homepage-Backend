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
        
        // Helper/Library
        $this->load->library('email');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
        // Rules for form validation
        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("message", "Message", "required");

        // Če uporabnik ni izpolnil vse polj
        if ($this->form_validation->run() === false) {
           
            $this->_returnAjax(false, "Izpolni vsa polja");
        }

        // Admin email
        $admin = "zoran.felbar@gmail.com";

        // User data
        $email = $data["email"];
        $subject = "Spletna stran - povpraševanje";
        $message = $data["message"];

        // Sending mail from, user -> admin
        $this->email->from($email);
        $this->email->to($admin); 

        $this->email->subject($subject);
        $this->email->message($message);	

        // Send mail
        $this->email->send();

        //$errro = $this->email->print_debugger()

        $this->_returnAjax(true, "Email uspesno poslan.");
    } 
}
