// round one
for( $i = 0; $i < log( count( $competitors ), 2 ); $i++ )
{
    $seeded = array( );
    foreach( $competitors as $competitor )
    {
        $splice = pow( 2, $i );

        $seeded = array_merge( $seeded, array_splice( $competitors, 0, $splice ) );
        $seeded = array_merge( $seeded, array_splice( $competitors, -$splice ) );
    }
    $competitors = $seeded;
}

$events = array_chunk( $seeded, 2 );

// quarter finals
for( $i = 0; $i < count( $competitors ) / 2; $i++ )
{
    array_push( $events, array(
        array( 'from_event_index' => $i, 'from_event_rank' => 1 ), // rank 1 = winner
        array( 'from_event_index' => ++$i, 'from_event_rank' => 1 )
    ) );
}

$round_matchups = array( );
for( $i = 0; $i < count( $competitors ) / 2; $i++ )
{
    array_push( $round_matchups, array(
        array( 'from_event_index' => $i, 'from_event_rank' => 2 ), // rank 2 = loser
        array( 'from_event_index' => ++$i, 'from_event_rank' => 2 )
    ) );
}
$events = array_merge( $events, $round_matchups );

for( $i = 0; $i < count( $round_matchups ); $i++ )
{
    array_push( $events, array(
        array( 'from_event_index' => $i + count( $competitors ) / 2, 'from_event_rank' => 2 ),
        array( 'from_event_index' => $i + count( $competitors ) / 2 + count( $competitors ) / 2 / 2, 'from_event_rank' => 1 )
    ) );
}

// semi finals
for( $i = 0; $i < count( $competitors ) / 2 / 2; $i++ )
{
    array_push( $events, array(
        array( 'from_event_index' => $i + count( $competitors ) / 2, 'from_event_rank' => 1 ),
        array( 'from_event_index' => ++$i + count( $competitors ) / 2, 'from_event_rank' => 1 )
    ) );
}

$round_matchups = array( );
for( $i = 0; $i < count( $competitors ) / 2 / 2; $i++ )
{
    array_push( $round_matchups, array(
        array( 'from_event_index' => $i + count( $competitors ), 'from_event_rank' => 1 ),
        array( 'from_event_index' => ++$i + count( $competitors ), 'from_event_rank' => 1 )
    ) );
}
$events = array_merge( $events, $round_matchups );

for( $i = 0; $i < count( $round_matchups ); $i++ )
{
    array_push( $events, array(
        array( 'from_event_index' => $i + count( $competitors ) + count( $competitors ) / 2 - 2, 'from_event_rank' => 2 ),
        array( 'from_event_index' => $i + count( $competitors ) + count( $competitors ) / 2 - 1, 'from_event_rank' => 1 )
    ) );
}

// finals
for( $i = 0; $i < count( $competitors ) / 2 / 2 / 2; $i++ )
{
    array_push( $events, array(
        array( 'from_event_index' => $i + count( $competitors ) / 2 * 3 - 2, 'from_event_rank' => 1 ),
        array( 'from_event_index' => ++$i + count( $competitors ) / 2 * 3 - 1, 'from_event_rank' => 1 )
    ) );
}






	
	public function quarterFinals(){
		
	    $event_code = '1701191038-31';
	    $participants = 8;

        
       
        $winners = array();
        for($x = 1; $x <= $participants / 2; $x++){
            $winner_result = $this->Events_model->getRoundOneResult($x, $event_code,'winner');
            array_push($winners, $winner_result);
            
           
        }
        
        
		for($i=0; $i < count($winners); $i += 2){
			$x = $i + 1;
			
			echo $winners[$i] .' VS. '.$winners[$x].'<br>';
		}

       
		
		//loose to loose
		//$loosers = array();
		//for($x = 1; $x <= $participants / 2; $x++){
		//    $loosers_result = $this->Events_model->getRoundOneResult($x, $event_code,'loose');
		//    array_push($loosers, $loosers_result);
		//}
		
		//echo '<br> LOOSERS! <br>';
		//for( $i = 0; $i < $participants / 2; $i++ )
		//{
		//    array_push( $loosers, array(
		//            array( $loosers[$i] ), // rank 1 = winner
		 //           array( $loosers[++$i])
		 //   ) );
		//}
		
		//foreach ($loosers as $loosers){
		  //  echo print_r($loosers).'<br>';
		//}
		
		//$events = array();
		//for( $i = 0; $i < 4; $i++ )
		//{
    	//	array_push( $events, array(
		 //       array( 'from_event_index' => $i + 8 / 2, 'from_event_rank' => 2 ),
		 //       array( 'from_event_index' => $i + 8 / 2 + 8 / 2 / 2, 'from_event_rank' => 1 )
    	//		)	 		
    	//	);
		//}
		//echo json_encode($events);
	}
	
	
	
	
	
		public function nextSched($school, $last_gameno, $last_game,  $event_code, $event_id){
		
		
		$next_gameno = $last_gameno + 1;
		$next_game =  date('Y-m-d', strtotime($last_game. ' + 1 days'));
		
		$event_details = $this->Score_model->event_details($event_id);
		$getLastRecord =  $this->Score_model->getLastRecord($event_details->row()->event_code);
		
		
		$game_limit = $event_details->row()->round_counter;
		
		if($last_gameno <=  $game_limit){
		
			if($getLastRecord->row()->school2 == ''){
				
				
				//update
				
				$sched_id = $getLastRecord->row()->event_id;
				$newSched = array(
								'school2' => $school
							);
				
				$saveEvents = $this->Score_model->updateEvents($sched_id, $newSched);
				
			}
			else{
				//insert new
				$newSched = array(
								'type' => 'Sports',
								'school1' => $school,
								'event_num' => $next_gameno,
								'event_class' => $event_details->row()->event_class,
								'category' => $event_details->row()->category,
								'division' => $event_details->row()->division,
								'date' => $next_game,
								'location' => $event_details->row()->location,
								'event_code' => $event_details->row()->event_code,
							);
				
				$saveEvents = $this->Score_model->saveEvents($newSched);
			}
			
			echo $game_limit;
		}
		
	}
