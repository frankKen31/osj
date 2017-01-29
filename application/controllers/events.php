<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'base.php';
class Events extends Base {
    
    function __construct(){
        parent::__construct();
        $this->load->model('Events_model');
        $this->load->model('Main_model');
    }
    
	public function listing()
	{
	    if(isset($_GET['eventtype']) && $_GET['eventtype'] != ""){
	       $type =  $_GET['eventtype'];
	      
    	    if(isset($_POST['btnSearch'])){
    	        
    	        $event = $this->input->post('eventClass');
    	        $category = $this->input->post('category');
    	        $level = $this->input->post('division');
    	        $date = $this->input->post('date'); 
    	        
                $data['events'] = $this->Events_model->search_event($type, $event, $category, $level, $date);
    	        
    	    }else{
                $data['events'] = $this->Events_model->eventList($type);
            }
    	    
    	    $data['games'] = $this->Main_model->games();
    	    $data['culturals'] = $this->Main_model->cultural();
    	    
    	    
    	    
    		$this->render('events/index',$data);
	    }else{
	        $this->render('events/eventlist_menu.php');
	    }
	}
	
	public function scheduling(){
	    
	    $response = 0;
	    
	    if(isset($_POST['save'])){
	        
	    	$eventclass =  $this->input->post('event');        
	        $school = $this->input->post('school');        
	        $num_participants = count($school);
	        $division = $this->input->post('division');
	        $category = $this->input->post('category');
// 	        $location =  $this->input->post('location');
	        $startdate = $this->input->post('startdate');
	        $starttime = $this->input->post('starttime');
	        
	        $gametime = $this->input->post('gametime');
	        $gamesperday = $this->input->post('games_per_day');
	        
	        if($num_participants >= 8 ){
	        	 $no_of_games = (( $num_participants - 1 ) * 2) + 1;
	        }else{
	        	 $no_of_games = (( $num_participants - 1 ) * 2);
	        }
	       
	        
	        shuffle($school);

	        $event_code =  date('ymdhi-'). rand(1,100);
	        
	        if($num_participants % 2){
	        	$mod = 1;
	        }else{
	        	$mod = 2;
	        }

	        $game_no = 0;
	        
	        $event_ids = array( );
	        for($i=0; $i < $num_participants; $i+= $mod){
	        	$game_no++;
	        	
	        	$x = $i + 1;
	        	
	        	if( $x < $num_participants){	        		
	        		echo $game_no.'. '.$school[$i] .' vs ' . $school[$x].'<br>';
	        		
	        		$events = array(
	        					'school1' => $school[$i],
	        					'school2' => $school[$x],
		        				'event_num' => $game_no,
	        					'event_class' => $eventclass,
		        				'division' => $division,
		        				'category' => $category,
		        				'type' => 'Sports',
// 		        				'location' => $location,
	        					'event_code' => $event_code,
	        					'round_counter' => $no_of_games,
	        					'participants' => $num_participants
        					);
	        		
	        	
	        		$save_events =    $this->Events_model->saveEvents($events);
	        		

	        		array_push($event_ids,$this->db->insert_id());
	        		
	        		$response += $save_events;
	        	}
	        	
	        	 if($mod == '1'){
	        		$i = $x;
	        		
	        	}
	        	
	        	
	        }
	        
	        if($mod == '1'){
	        	
	        	$school1 = $school[$num_participants - 1];
	        	$events = array(
	        			'school1' => $school1,
	        			'school2' => '',
	        			'event_num' => $game_no,
	        			'event_class' => $eventclass,
	        			'division' => $division,
	        			'category' => $category,
	        			'type' => 'Sports',
// 	        			'location' => $location,
	        			'event_code' => $event_code,
	        			'round_counter' => $no_of_games
	        	);
	        	 
	        	$save_events =    $this->Events_model->saveEvents($events);
	        	
	        	array_push($event_ids,$this->db->insert_id());
	        	
	        	$response += $save_events;
	        }
	      
	        $set_schedule = $this->setSchedule($event_ids, $startdate, $starttime, $gametime, $gamesperday, $no_of_games, $event_code);
            
	        
            if($response + $set_schedule > 0)
            {
                $data['message'] = 'New event was successfully Scheduled';
                $data['success'] = true;
            }
            else{
                $data['message'] = 'New event was successfully Scheduled';
                $data['success'] = false;
            }
          
	    }
	    

	    $data['games'] = $this->Main_model->games();
	    $data['schools'] = $this->Main_model->schools();
	    $this->render('events/event_sched', $data);
       
	   
	}

	public function setSchedule($event_ids, $startdate, $starttime, $gametime, $gamesperday, $no_of_games, $event_code){
	    
	    $key = 0;
	    $response = 0;
	    for($i = 1; $i <= $no_of_games; $i++ ){
	       
	    	$endTime = date("H:i", strtotime('+'.$gametime.' minutes', strtotime($starttime)));
	        $schedule = array(
	        				'event_num' => $i,
            				'date' => $startdate,
                       		'time' => $starttime,
	        				'end_time' => $endTime,
	        				'game_limit' => $gametime,
	        				'event_code' => $event_code
	                   );
	        if(array_key_exists($key,$event_ids)){
	            $event_id = $event_ids[$key];
	             
	            $schedule['event_id'] = $event_id;
	             
	        }else{
	            $schedule['event_id'] = '';
	        }
	        
	        $set_schedule = $this->Events_model->setSchedule($schedule);
	        
            $response += $set_schedule;
            
            $starttime = date("H:i", strtotime('+ 5 minutes', strtotime($endTime)));
	        $key++;
	    }
	    
	    return $response;
		
	}

	
	public function testTime(){

		$original_time = '08:00 AM';;
		$time = '08:00 AM';
		$timepergames = 120;
		$games = (9 - 1) * 2 ;
		
			$x = 1;
			$gamesperday = 1;
			$z = 0;
			$fruit = array(1,2,3,4,5,6,7,8,9,0);
			for($i= 1; $i <= $games; $i++){
				if($x > $gamesperday){
					$gamesperday = $gamesperday + 5;
					$z++;
					
					$time = date("h:i A",  strtotime('+ 1440 minutes', strtotime($original_time)));
				}
				
				$endTime = date("h:i A", strtotime('+ '.$timepergames.' minutes', strtotime($time)));
				
				echo $time .' - '.$endTime.'<br>';
				
				$time = date("h:i A",strtotime($endTime));
				if(date('H:i A',strtotime($time)) < date('H:i A', strtotime('08:00 PM')) && date('H:i A',strtotime($time)) >=   date('H:i A', strtotime('08:00 AM'))){
					
				}else{
					$time = $original_time;
				}
				

				$x++;

			}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */