<?php

Class Score_model extends CI_Model {
    
        public function __construct()
        {
                $this->load->database();
                date_default_timezone_set('Asia/Manila');
        }
        
        
        public function event_details($event_id){
            
    
            $query = $this->db->query("SELECT e.event_num, e.type, e.school1, e.school2, e.division, e.category, t.date, t.time,t.location, e.event_code, e.round_counter, e.event_class,
                                           g.name as event_name, c.player as player
                                           FROM events  e
                    
                                           Join tbl_games g
                                           ON e.event_class = g.id
                        
                                           Join tbl_category c
                                           ON e.category = c.id 
                    
                                           Join tbl_time t
                                           ON t.event_id = e.event_id 
                                           
                                           WHERE e.type = 'sports' and e.event_id = '".$event_id."'  ORDER BY g.id, t.date ASC, e.event_num ASC");
            return $query;
        }
        
        public function getScore($event_id){
        	$query = $this->db->query("SELECT e.event_num, e.school1, e.school2, e.division, t.date, t.time, t.location, e. event_code,
                                        sb.final_score, sb.result,  
        								g.name as event_class, c.player as category
                                        FROM events  e
        
                                        Join tbl_games g
                                       	ON e.event_class = g.id
        	
                                        Join tbl_category c
                                        ON e.category = c.id

                                        Join tbl_time t
                                        ON t.event_id = e.event_id 
                                           
										JOIN score_board sb
										ON sb.event_id = e.event_id
										
        								WHERE type = 'sports' and e.event_id = '".$event_id."'  ORDER BY g.id, t.date ASC, event_num ASC, sb.score_board_id DESC limit 2");
        	return $query->result();
        }
        
        
        public function getLastRecord($event_code){
        	$this->db->where('event_code', $event_code);
        	$this->db->order_by("event_num", "desc");
        	$this->db->limit(1);
        	$query = $this->db->get('events');
        	
        	
        	return $query;
        }
        
        public function insertScore($score){
        	$this->db->insert('score_board', $score);
        	 
        	 
        	 return $this->db->affected_rows();
        }
        
        public function saveEvents($events){
            $this->db->insert('events', $events);
            return $this->db->affected_rows();
        }
        
        public function updateEvents($sched_id, $newSched){
        	$this->db->where('event_id', $sched_id);
        	$query = $this->db->update('events', $newSched);
        	 
        	return $this->db->affected_rows();
        }
        
        public function updateStatus($event_code, $status){
        	$data = array('status' => 'end');
        	$this->db->where('event_code', $event_code);
        	$this->db->where('status', $status);
        	$query = $this->db->update('score_board', $data);
        
        	return $this->db->affected_rows();
        }
        
        //next round if there's a school with vacant oponent
        public function sendToNextRound($data, $event_code, $last_gameno){
        	$this->db->where('event_code', $event_code);
        	$this->db->where('event_num', $last_gameno);
        	$query = $this->db->update('events', $data);
        	
        	return $this->db->affected_rows();
        }
}

?>