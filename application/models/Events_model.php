<?php

Class Events_model extends CI_Model {
    
        public function __construct()
        {
                $this->load->database();
                date_default_timezone_set('Asia/Manila');
        }
        
        
        public function eventList($type){
            
            if($type == 'sports'){
            $query = $this->db->query("SELECT e.event_num, e.school1, e.school2, e.division, t.date, t.time,t.location,
                                           g.name as event_class, c.player as category
                                           FROM events  e
                    
                                           Join tbl_games g
                                           ON e.event_class = g.id
                        
                                           Join tbl_category c
                                           ON e.category = c.id 
                                           
                                           right Join tbl_time t 
                                           ON t.event_id = e.event_id

                                           WHERE type = '".$type."' ORDER BY g.id, t.date ASC, event_num ASC");
            }
            else {
                $query = $this->db->query("SELECT e.event_num, e.school1, e.school2, e.division, t.date, t.time,t.location,
                                           cl.name as event_class, c.player as category
                                           FROM events  e
                        
                                           Join tbl_cultural cl
                                           ON e.event_class = cl.id
                
                                           Join tbl_time
                                           On t.event_id = e.event_id
                                           
                                           Join tbl_category c
                                           ON e.category = c.id WHERE type = '".$type."'  ORDER BY date ASC, event_num ASC");
            }

            return $query;
        }
        
        public function eventByCode($event_code)
        {
            $this->db->where('event_code', $event_code);
            $query = $this->db->get('events');

            return $query->row()->participants;
        }
        
        public function search_event($type, $event, $category, $level, $date){
            
            if($type == 'sports'){
                $query = $this->db->query("SELECT e.event_num, e.school1, e.school2, e.division, t.date, t.time,t.location,
                                           g.name as event_class, c.player as category
                                           FROM events  e
                    
                                           Join tbl_games g
                                           ON e.event_class = g.id
                        
                                           Join tbl_category c
                                           ON e.category = c.id
                                           
                                           Join tbl_time t 
                                           ON t.event_id = e.event_id
                
                                        WHERE type = '".$type."'
                                        AND g.name = '".$event."' AND (
                                         c.player = '".$category."'
                                        OR division = '".$level."'
                                        OR t.date = '".$date."')
                                        ORDER BY t.date ASC, e.event_num ASC");
               
            }
            
            return $query;
            
        }
        
        

        public function saveEvents($events){
            $this->db->insert('events', $events);
            return $this->db->affected_rows();
        }
        
        public function setSchedule($schedule){
            $this->db->insert('tbl_time', $schedule);
            return $this->db->affected_rows();
        }
        
        public function getEventResult($event_num, $event_code, $result)
        {
            $this->db->where('event_num', $event_num);
            $this->db->where('event_code', $event_code);
            $this->db->where('result', $result);
            
            $query = $this->db->get('score_board');
            
            return $query->row()->school;
        }
        
        public function checkFinishedGame($event_code, $status){
        	
            $query = $this->db->query("select * from score_board
										where event_code = '".$event_code."' AND status = '".$status."'
										ORDER BY event_num DESC
										LIMIT 1");
            
            return $query->row()->event_num;
        }

        public function setNewSched($event_code, $sched, $event_num){
        	$this->db->where('event_code', $event_code);
        	$this->db->where('event_num', $event_num);
        	$query = $this->db->update('tbl_time', $sched);
        	
        	return $this->db->affected_rows();
        }
}

?>