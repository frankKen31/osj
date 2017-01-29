<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'events.php';
class Scoring extends Events {
    
    function __construct(){
        parent::__construct();
        $this->load->model('Events_model');
        $this->load->model('Main_model');
        $this->load->model('Score_model');
    }
    
	public function scorer()
	{
		$event_id = $this->uri->segment('3'); 
		
		$event_details = $this->Score_model->event_details($event_id);
		$getLastRecord =  $this->Score_model->getLastRecord($event_details->row()->event_code);
		$getScore = $this->Score_model->getScore($event_id);
		
		$last_gameno = $getLastRecord->row()->event_num;
	
		$data['last_gameno'] = $last_gameno;
		
		$event_code = $event_details->row()->event_code;
		$participants = $this->Events_model->eventByCode($event_code);
				
		if(isset($_POST['saveScore'])){
			
			$school1 =  $this->input->post('school1');
			$school2=  $this->input->post('school2');
		
			$school = array(
					$school1,
					$school2
			);
							
			$score1 = $this->input->post('score1');
			$score2 = $this->input->post('score2');
			
			$score_input = array(
							$score1,
							$score2
							);
			
			$event_id = $this->input->post('event_id');
			
			$response = 0;
				
			for($i=0; $i < 2; $i++ ){
				
				$score = array(
						'final_score' => $score_input[$i],
						'event_id' => $event_id,
				        'event_num' => $event_details->row()->event_num,
						'school' => $school[$i],
						'event_code' => $event_details->row()->event_code,
						'status' => 'waiting'
				);
				
				if( $score_input[0] >  $score_input[1]){
					if( $score_input[$i] ==  $score_input[0]){
						$score['result'] = 'winner';
						
// 						$this->nextSched($school[$i], $last_gameno, $last_game, $event_code, $event_id);
					}else{
						$score['result'] = 'loose';
					}
				}else{
					if( $score_input[$i] ==  $score_input[1]){
						$score['result'] = 'winner';
						
// 						$this->nextSched($school[$i], $last_gameno, $last_game, $event_code, $event_id);
					}else{
						$score['result'] = 'loose';
					}
				}
				$updateScore = $this->Score_model->insertScore($score);
				
				$response += $updateScore;
				
				
			}
			
			
			if($response > 0){
				$data['success'] = true;
				$message = 'Event score was updated.';
				
				$createSched = $this->checkMatch($event_code, $participants, $last_gameno , $event_details);
				
				if($last_gameno == $event_details->row()->round_counter){
					$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
					$message .= 'Game event is ended';
				}else{
					if($createSched > 0){
						$message .= ' New Events has been created.';
					}
				}
				$data['message'] = $message;
			}else{
				$data['success'] = false;
				$data['message'] = 'Something went wrong';
			}
			
		}
		
			$data['event_details'] = $event_details;
	
			if(count($getScore) > 0 ){
				$data['game_score1'] = $getScore[0]->final_score;
				$data['game_score2'] = $getScore[1]->final_score;
			}
			
			$this->render('score/scorer.php' ,$data);
		
	}
	

	
	public function checkMatch($event_code, $participants, $last_gameno , $event_details){

		$response = 0;
		$checkFinishedGame = $this->Events_model->checkFinishedGame($event_code, 'waiting');
		
		if($participants == 3){
			if($checkFinishedGame == $participants - 2 )
			{
				$response = $this->threepar_quater($event_code, $participants, $last_gameno, $event_details);
			}
			else if($checkFinishedGame == $participants - 1)
			{
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->threepar_elimination($event_code, $participants, $last_gameno, $event_details);
			}
			else if ($checkFinishedGame == $participants )
			{
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->threepar_final($event_code, $participants, $last_gameno, $event_details);
			}
			else if($checkFinishedGame == $participants + 1)
			{
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->finals($event_code, $participants, $last_gameno, $event_details);
			}
		}
		else if($participants == 4)
		{
			if($checkFinishedGame == $participants/2){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->quarterFinals($event_code, $participants, $last_gameno, $event_details);
			}
			else if($checkFinishedGame  == $participants){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->elimination($event_code, $participants, $last_gameno , $event_details);
			}
			else if($checkFinishedGame  == $participants + 1){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->four_semiFinals($event_code, $participants, $last_gameno , $event_details);
			}
			else if($checkFinishedGame == ($participants - 1) * 2)
			{
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->finals($event_code, $participants, $last_gameno, $event_details);
			}
			
		}
		else if($participants == 5){
			if($checkFinishedGame == 2 ){
				
				$response = $this->five_firstRound($event_code, $participants, $last_gameno, $event_details);
			}
			else if($checkFinishedGame == 3 ){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->five_quarterFinals($event_code, $participants, $last_gameno, $event_details); 
				
			}
			else if($checkFinishedGame == 4 ){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->five_matchups($event_code, $participants, $last_gameno, $event_details);
			}
			else if($checkFinishedGame == 5 ){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->five_elimination($event_code, $participants, $last_gameno, $event_details);
			}
			else if($checkFinishedGame == 6){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->five_elimination($event_code, $participants, $last_gameno, $event_details);
			}
			else if($checkFinishedGame  == $participants + 2){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->five_semiFinals($event_code, $participants, $last_gameno , $event_details);
			}
			else if($checkFinishedGame == ($participants-1) * 2)
			{
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->finals($event_code, $participants, $last_gameno, $event_details);
			}
		}
		else if($participants == 6){
			
		}
		else if($participants == 7){
			if($checkFinishedGame == 1){
				$response = $this->seven_firstRound($event_code, $participants, $last_gameno, $event_details);
			}
			else if($checkFinishedGame == 3){
				$response = $this->seven_quarter($event_code, $participants, $last_gameno, $event_details);
				
			}else if($checkFinishedGame == 4){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response =  $this->seven_matchups($event_code, $participants, $last_gameno, $event_details);
			}
			else if($checkFinishedGame == 5){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				
				echo $last_gameno;
				$response =  $this->seven_elimination($event_code, $participants, $last_gameno, $event_details);
			}
		}
		else if($participants == 8){
				
			if($checkFinishedGame == $participants/2){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->quarterFinals($event_code, $participants, $last_gameno, $event_details);
			}
			else if($checkFinishedGame  == $participants){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->elimination($event_code, $participants, $last_gameno , $event_details);
			}
			else if($checkFinishedGame  == $participants + 2){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->secondElimination($event_code, $participants, $last_gameno , $event_details);
				
			}
			else if($checkFinishedGame  == $participants + 3){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->thirdElimination($event_code, $participants, $last_gameno , $event_details);
			}
			else if($checkFinishedGame  == $participants + 4){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->fourthElimination($event_code, $participants, $last_gameno , $event_details);
			}
			else if($checkFinishedGame  == $participants + 6){
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->semiFinals($event_code, $participants, $last_gameno , $event_details);
			}
			else if($checkFinishedGame == (($participants - 1) * 2)+ 1)
			{
				$updateStatus = $this->Score_model->updateStatus($event_code,'waiting');
				$response = $this->finals($event_code, $participants, $last_gameno, $event_details);
			}
		}
		
		return $response;
	}
	
	//threepar = 3 participants 
	public function threepar_quater($event_code, $participants, $last_gameno, $event_details){
		$getEventResult = $this->Events_model->getEventResult($last_gameno - 1, $event_code, 'winner');
		
		$data = array('school2' => $getEventResult);
		
		$sendToNextRound = $this->Score_model->sendToNextRound($data, $event_code, $last_gameno);
		
		return $sendToNextRound;
	}

	
	public function threepar_elimination($event_code, $participants, $last_gameno, $event_details){
		$loosers = array();
		for($i = 1; $i <= $last_gameno; $i++){
			$getEventResult = $this->Events_model->getEventResult($i, $event_code, 'loose');
			array_push($loosers, $getEventResult);
		}
		
		$response = $this->saveEvents($loosers, $event_code, $participants, $last_gameno, $event_details);
		
		return $response;
	}
	
	public function threepar_final($event_code, $participants, $last_gameno, $event_details){
		$finalist = array();
		for($i = $participants - 1; $i <= $last_gameno; $i++){
			$getEventResult = $this->Events_model->getEventResult($i, $event_code, 'winner');
			array_push($finalist, $getEventResult);
		}
		$response = $this->saveEvents($finalist, $event_code, $participants, $last_gameno, $event_details);
		return $response;
	}
	
	
	//three particiants
	
	
	//four_paticipants
	
	public function four_semiFinals($event_code, $participants, $last_gameno, $event_details){
	
		$next_game = $last_gameno;
		$event_nums = array();
		for($x = 0; $x <= 2; $x+=2 ){
			$last_gameno = $last_gameno - $x;
			array_push($event_nums, $last_gameno);
		}
	
		$school = array();
		foreach ($event_nums as $event_num){
			$winner = $this->Events_model->getEventResult($event_num, $event_code, 'winner');
			array_push($school, $winner);
		}
		
		$response = $this->saveEvents($school, $event_code, $participants, $next_game, $event_details);
		return $response;
	}
	
	//fourparticipants
	
	//five participants
	public function five_firstRound($event_code, $participants, $last_gameno, $event_details){
		$getEventResult = $this->Events_model->getEventResult($last_gameno - 2, $event_code, 'winner');
	
		$data = array('school2' => $getEventResult);
	
		$sendToNextRound = $this->Score_model->sendToNextRound($data, $event_code, $last_gameno);
	
		return $sendToNextRound;
	}	
	
	
	public function five_quarterFinals($event_code, $participants, $last_gameno, $event_details){
		$next_game = $last_gameno;
		$event_nums = array();
		for($x = 0; $x <= 1; $x++ ){
			$last_gameno = $last_gameno - $x;
			array_push($event_nums, $last_gameno);
		}
		
		$school = array();
		foreach ($event_nums as $event_num){
			$winner = $this->Events_model->getEventResult($event_num, $event_code, 'winner');
			array_push($school, $winner);
		}
		
		echo json_encode($school);
		
		$response = $this->saveEvents($school, $event_code, $participants, $next_game, $event_details);
		return $response;
	}
	
	public function five_matchups($event_code, $participants, $last_gameno, $event_details){
		$loosers = array();
		
		for($x=1; $x <= ($last_gameno - 2); $x++){
			$losser_result = $this->Events_model->getEventResult($x, $event_code,'loose');
			array_push($loosers, $losser_result);
		}
		
		$response = $this->saveEvents($loosers, $event_code, $participants, $last_gameno , $event_details);
		 
		return $response;
	}
	
	public function five_elimination($event_code, $participants, $last_gameno, $event_details){
		
		$looser_num = $last_gameno - 2;
		
		$school = array();
		$losser_result = $this->Events_model->getEventResult($looser_num, $event_code, 'loose');
		array_push($school, $losser_result);
		
		
		$winner_num = $last_gameno;
		$winner_result = $this->Events_model->getEventResult($winner_num, $event_code, 'winner');
		array_push($school, $winner_result);
		
		$response = $this->saveEvents($school, $event_code, $participants, $last_gameno , $event_details);
		 
		return $response;
		
		
	}
	
	public function five_semiFinals($event_code, $participants, $last_gameno, $event_details){
	
		$next_game = $last_gameno;
		$event_nums = array();
		for($x = 0; $x <= 3; $x+=3 ){
			$last_gameno = $last_gameno - $x;
			array_push($event_nums, $last_gameno);
		}
	
		$school = array();
		foreach ($event_nums as $event_num){
			$winner = $this->Events_model->getEventResult($event_num, $event_code, 'winner');
			array_push($school, $winner);
		}
	
		$response = $this->saveEvents($school, $event_code, $participants, $next_game, $event_details);
		return $response;
	}
	//five participants
	
	//Seven Participants
	
	public function seven_firstRound($event_code, $participants, $last_gameno, $event_details){
		$getEventResult = $this->Events_model->getEventResult($last_gameno - 3, $event_code, 'winner');
	
		$data = array('school2' => $getEventResult);
	
		$sendToNextRound = $this->Score_model->sendToNextRound($data, $event_code, $last_gameno);
	
		return $sendToNextRound;
	}
	
	public function seven_quarter($event_code, $participants, $last_gameno, $event_details){
		$next_game = $last_gameno;
		$event_nums = array();
		for($x = 1; $x <= 2; $x++ ){
			$y = $last_gameno - $x;
			array_push($event_nums, $y);
		}
	
		$school = array();
		foreach ($event_nums as $event_num){
			$winner = $this->Events_model->getEventResult($event_num, $event_code, 'winner');
			array_push($school, $winner);
		}
	
		echo json_encode($event_nums);
	
		$response = $this->saveEvents($school, $event_code, $participants, $next_game, $event_details);
		return $response;
	}
	
	public function seven_matchups($event_code, $participants, $last_gameno, $event_details){
		$loosers = array();
	
		for($x=1; $x <= ($last_gameno - 3); $x++){
			$losser_result = $this->Events_model->getEventResult($x, $event_code,'loose');
			array_push($loosers, $losser_result);
		}
	
		echo $last_gameno;
		$response = $this->saveEvents($loosers, $event_code, $participants, $last_gameno , $event_details);
			
		return $response;
	}
	

	public function seven_elimination($event_code, $participants, $last_gameno, $event_details){
		$loosers = array();
		
		for($i = 1; $i <= 3; $i += 2){;
			$y = $last_gameno - $i;
			$getEventResult = $this->Events_model->getEventResult($y, $event_code, 'loose');
			array_push($loosers, $getEventResult);
		}
	
		$response = $this->saveEvents($loosers, $event_code, $participants, $last_gameno, $event_details);
		
		echo json_encode($loosers);
		return $response;
	}
	//Seven Participants
	
	
	
	//eight participants
	function quarterFinals($event_code, $participants, $last_gameno , $event_details){
			
			$winners = array();
	        for($x = 1; $x <= $participants / 2; $x++){
	            $winner_result = $this->Events_model->getEventResult($x, $event_code,'winner');
	            array_push($winners, $winner_result); 
	        }
	        
			$loosers = array();
	        for($x = 1; $x <= $participants / 2; $x++){
	            $losser_result = $this->Events_model->getEventResult($x, $event_code,'loose');
	            array_push($loosers, $losser_result); 
	        }	        
	        
	        $result = array_merge($winners, $loosers);
	        
	       	$response = $this->saveEvents($result, $event_code, $participants, $last_gameno , $event_details);
	       	
	       	return $response;
	}
	
	public function elimination($event_code, $participants, $last_gameno , $event_details){
		
		$response = 0;
		$odd = array();
		$even = array();
		
		for($x = $last_gameno; $x > $participants/ 2; $x--){
			if($x % 2 == 0){
				array_push($even, $x);
			}else{
				array_push($odd, $x);
			}
			
			$odd = array_reverse($odd);
			$reverse_even = array_reverse($even);
			
			$event_num = array_merge($odd, $reverse_even);
		}
		
		$y = 1;
		$school = array();
		foreach ($event_num as $gameno){
			if($y % 2 == 0){
				$res = 'winner';
			}else{
				$res = 'loose';
			}
			
			$game_result = $this->Events_model->getEventResult($gameno, $event_code, $res);
			array_push($school, $game_result);
			
			$y++;
		}
		
		$response = $this->saveEvents($school, $event_code, $participants, $last_gameno, $event_details);
		
		return $response;
	}
	
	public function secondElimination($event_code, $participants, $last_gameno , $event_details){
		
		$response = 0;
		$odd = array();
		$even = array();
		
		for($x = $last_gameno; $x > ($participants/ 2) + 2; $x--){
			if($x % 2 == 0){
				array_push($even, $x);
			}else{
				array_push($odd, $x);
			}
			
			$odd = array_reverse($odd);
			$reverse_even = array_reverse($even);
			
			$event_num = array_merge($odd, $reverse_even);
		}
		
		$y = 1;
		$school = array();
		foreach ($event_num as $gameno){
			if($y % 2 == 0){
				$res = 'winner';
			}else{
				$res = 'loose';
			}
			
			$game_result = $this->Events_model->getEventResult($gameno, $event_code, $res);
			array_push($school, $game_result);
			
			$y++;
		}
		
		$response = $this->saveEvents($school, $event_code, $participants, $last_gameno, $event_details);
		
		return $response;		
		
		
	}
	
	public function thirdElimination($event_code, $participants, $last_gameno, $event_details){
		$event_num1= $last_gameno - 7;
		$event_num2 = $last_gameno - 6;
		
		$school = array(); 
		$winner1 = $this->Events_model->getEventResult($event_num1, $event_code, 'winner');
		array_push($school, $winner1);
		
		$winner2 = $this->Events_model->getEventResult($event_num2, $event_code, 'winner');
		array_push($school, $winner2);
		
		$response = $this->saveEvents($school, $event_code, $participants, $last_gameno, $event_details);
		return $response;	
	}
	
	
	public function fourthElimination($event_code, $participants, $last_gameno, $event_details){
		
		$event_nums = array($last_gameno - 2, $last_gameno - 1);
		
		$school = array();
		foreach ($event_nums as $event_num){
			$winner = $this->Events_model->getEventResult($event_num, $event_code, 'winner');
			array_push($school, $winner);
		}
		
		$response = $this->saveEvents($school, $event_code, $participants, $last_gameno, $event_details);
		return $response;
	}
	
	public function semiFinals($event_code, $participants, $last_gameno, $event_details){
		
		$next_game = $last_gameno;
		$event_nums = array();
		for($x = 0; $x <= 1; $x++ ){
			 $last_gameno = $last_gameno - $x;
			 array_push($event_nums, $last_gameno);
		}
		
		$school = array();
		foreach ($event_nums as $event_num){
			$winner = $this->Events_model->getEventResult($event_num, $event_code, 'winner');
			array_push($school, $winner);
		}
		
		echo json_encode($school);
		
		$response = $this->saveEvents($school, $event_code, $participants, $next_game, $event_details);
		return $response;
	}
	//eight participants
	
	public function finals($event_code, $participants, $last_gameno, $event_details){
		if($last_gameno == $event_details->row()->round_counter){
			return true;
		}else{
			return false; 
		}
	}
	
	function saveEvents($result, $event_code, $participants, $last_gameno , $event_details){
		
		$response = 0;
		for($i = 0; $i < count( $result ); $i += 2){
       		$x = $i + 1;
       		$last_gameno = $last_gameno + 1;
       		$newSched =  array(
       						'school1' => $result[$i],
       						'school2' => $result[$x],
       						'type' => 'Sports',
       						'event_num' => $last_gameno,
       						'round_counter' => $event_details->row()->round_counter,
       						'event_class' => $event_details->row()->event_class,
							'category' => $event_details->row()->category,
							'division' => $event_details->row()->division,
							'event_code' => $event_details->row()->event_code
       					); 
       		$saveEvents = $this->Events_model->saveEvents($newSched);
       			
       			
       		$sched = array();
       			
       		if($saveEvents > 0){
       			$response += $saveEvents; 
       			$event_id = $this->db->insert_id();
  				$sched = array('event_id' => $event_id);	
     			$setSched = $this->Events_model->setNewSched($event_code, $sched, $last_gameno);
       			$response += $setSched;
       		}
 
	    }

       	return $response;
	}
	
	
	function delimination(){
		$events= array();
		for( $i = 0; $i < 8 / 2 / 2; $i++ )
		{
		    array_push( $events, array(
		        array( 'from_event_index' => $i + 8 / 2, 'from_event_rank' => 1 ),
		        array( 'from_event_index' => ++$i + 8 / 2, 'from_event_rank' => 1 )
		    ) );
		}
		
		echo json_encode($events);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */