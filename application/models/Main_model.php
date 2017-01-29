<?php

Class Main_model extends CI_Model {
    
        public function __construct()
        {
                $this->load->database();
                date_default_timezone_set('Asia/Manila');
        }
        
        public function games()
        {
                $query = $this -> db -> get('tbl_games');
                return  $query->result();
        }
        
        public function cultural()
        {
            $query = $this -> db -> get('tbl_cultural');
            return  $query->result();
        }       
     

        
        public function schools()
        {
            $query = $this -> db -> get('school');
            return  $query->result();
        }
        
}