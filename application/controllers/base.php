<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller {

    function __construct()
    {
//         header('Access-Control-Allow-Origin: *');
//         header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
       

//         if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
//             die();
//         }
        
        parent::__construct();

    }
    

    function render($page, $data = array(), $template = 'templates/admin', $activated = FALSE) {
    
        $home = TRUE;
      
        $this->data ['content'] = $this->load->view ( $page, $data, true );
        $this->load->view ( $template, $this->data );
    }
    
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */