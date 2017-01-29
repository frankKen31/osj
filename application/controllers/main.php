<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'base.php';
class Main extends Base {
    
    function __construct(){
        parent::__construct();

    }
    
	public function index()
	{
		$this->render('main/index');
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */