<?php

Class Account_model extends CI_Model {
    
        public function __construct()
        {
                $this->load->database();
                date_default_timezone_set('Asia/Manila');
        }
        
        public function login($id,$password)
        {
                $this->db->where('username', $id);
				$this->db->where('password', $password );
				$find = $this-> db -> get('tbl_admin');
                
                if($find -> num_rows() > 0)
                {

                        $employee_id = $find->row()->employee_id;
                        $this->db->select('*');
                        $this->db->from('tbl_emp');
                        $this->db->join('tbl_id', 'tbl_emp.id = tbl_id.id');
                        $this->db->where('tbl_id.employee_id',$employee_id);
                        
                        $query =  $this->db->get();
                        
                        return $query->row()->firstname;
                }
                else
                {
                        return false;
                }
        }
        
        public function admin(){
                $this->db->select('*');
                $this->db->from('tbl_emp');
                $this->db->join('tbl_id', 'tbl_emp.id = tbl_id.id');
                 $this->db->join('tbl_admin', 'tbl_id.employee_id = tbl_admin.employee_id');
                 
               $query = $this->db->get();
               
               return $query->result();
        }
        
        public function check($employee_id,$column)
        {    
                $this->db->where($column,$employee_id);
                 $query = $this->db->get('tbl_admin');
                 
                 if($query->num_rows() == 0 ){
                       return false;
                 }else{
                        if($column != "username"){
                                return $query->row()->username;
                        }
                        else
                        {
                                 return $query->row()->employee_id;
                        }
                 }
                
        }
        
        public function register($data)
        {
                return $this->db->insert('tbl_admin',$data);
        }
        public function employee_id(){
                $this->db->select('*');
                $this->db->from('tbl_emp');
                $this->db->join('tbl_id', 'tbl_emp.id = tbl_id.id');
                 $this->db->where('department','A');
                 
               $query = $this->db->get();
               
                return $query->result();
        }
        
		public function getbyID($emp_id)
		{
			    $this->db->where('employee_id',$emp_id);
                $query = $this->db->get('tbl_admin');
                //$this->db->join('tbl_id', 'tbl_emp.id = tbl_id.id');
        
               if($query -> num_rows > 0)
			   {
						return $query->result();	
			   }else{
						return false;
			   }
			   
		}
		
		public function update_admin($employee_id,$data)
		{
				$this->db->where('employee_id',$employee_id);
				return $this->db->update('tbl_admin',$data);
		}
		
		public function search_delete($id)
		{
                $this->db->select('*');
                $this->db->from('tbl_emp');
                $this->db->join('tbl_id', 'tbl_emp.id = tbl_id.id');
                 $this->db->join('tbl_admin', 'tbl_id.employee_id = tbl_admin.employee_id');
				 
				$this->db->where('tbl_admin.employee_id',$id);
				$query = $this->db->get();
				$result = $query->row()->firstname.' '. $query->row()->middlename.' '. $query->row()->lastname;

				return $result;

		}
}

?>