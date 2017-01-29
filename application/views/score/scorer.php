
<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 50%;
      margin: auto;
  }
  a:link {
    text-decoration: none;
}
  </style>
  

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">&nbsp;</h1>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-12">
    		<div class="panel panel-primary" style="-webkit-box-shadow: 20px 19px 20px -5px rgba(0,0,0,0.54);-moz-box-shadow: 20px 19px 20px -5px rgba(0,0,0,0.54);box-shadow: 20px 19px 20px -5px rgba(0,0,0,0.54); -moz-border-radius: 80px;-webkit-border-radius:10px; border-radius: 1px">
                <div class="panel-heading" style="border-radius: 0px">
					<h4><center><b> Event Scorer </b></center></h4>
                </div>
                <div class="panel-body">
                    <div class="row">
						<?php if (isset($success)) :?>
                    	<div style="margin-left: -3px;" class="span12">
                        	<?php if ($success == FALSE): ?>
                                <div class="alert alert-danger" style='clear: both; overflow: auto; width: 100%;'>
                					<strong> <?php echo $message; ?> </strong>
                				</div>
                            <?php else : ?>
                                <div class="alert alert-success" style='clear: both; overflow: auto; width: 100%;'>
                					<strong><?php echo $message; ?></strong>
                				</div>
                            <?php endif; ?> <?php endif; ?>
                        </div> 
                        
                        <div class="col-md-12" style="padding:1% 5% 1% 5%">
                        	<div class="col-md-6">
                        		<label style="line-height: 30px"><h3><?php echo $event_details->row()->school1; ?></h3>
                        			<p style="font-size:50px" id="p-score1"><?php if(isset($game_score1)): echo $game_score1; endif; ?></p>
                        		</label>
                        		
                        	</div>
                        	<div class="col-md-6 ">
                        		<div class="pull-right">
                        			<label style="line-height: 30px"><h3><?php echo $event_details->row()->school2; ?></h3>
                        				<p style="font-size:50px" id="p-score2"><?php if(isset($game_score2)): echo $game_score2; endif; ?></p>
                        			</label>
                        		</div>
                        	</div>
                        	
                        </div>
                        <div class="col-md-12">
				    		<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
				    				<thead>
				    					<tr>
				    						<th>Game no.</th>
				    						<th>Event</th>
				    						<th>Category</th>
				    						<th>Level</th>
				    						<th>Date</th>
				    						<th>Time</th>
				    						<th>Location</th>
				    						
				    					</tr>
				    				</thead>
									<tbody style="">
									
									<?php if($event_details->num_rows() > 0):?>
									<?php  foreach ($event_details->result() as $event):?>
										<tr>
											<td><?php echo $event->event_num;?></td>
											<td style="vertical-align:middle"><?php echo $event->event_name;?></td>
											<td style="vertical-align:middle"><?php echo $event->player;?></td>
											<td style="vertical-align:middle"><?php echo $event->division;?></td>
											<td style="vertical-align:middle"><?php echo $event->date;?></td>
											<td style="vertical-align:middle"><?php echo $event->time;?></td>
											<td style="vertical-align:middle"><?php echo $event->location;?></td>
											
										</tr>
									<?php endforeach; ?>
									<?php else: ?>	
										<tr>
											<td class="text-center" colspan="8"><h3>No Data Found</h3></td>
										</tr>
									<?php endif;?>
															
									</tbody>
								</table>
							</div>
							
							<form action="<?php echo base_url(); ?>scoring/scorer/<?php echo $this->uri->segment('3'); ?>" method="post">
								<div class="col-md-6">
									<div class="col-md-5">
										<div class="form-group">
										<label for="score1"><span id="player1"><?php echo $event_details->row()->school1; ?></span> 's Score</label>
											<input type="number" class="form-control" name="score1" id="score1" min=0 max=999 value="<?php if(isset($game_score1)): echo $game_score1; endif; ?>" <?php if(isset($game_score1) && $game_score1 > 0): echo 'disabled'; endif; ?>> 
											<input type="hidden" class="form-control" name="school1" id="school1" value="<?php echo $event_details->row()->school1; ?>"> 
										</div>
		                            </div>
	                            </div>
	                            <div class="col-md-6">
									<div class="col-md-5">
										<div class="form-group ">
											<label for=""><span id="player2"><?php echo $event_details->row()->school2; ?></span> 's Score</label>
											<input type="number" class="form-control" name="score2" id="score2" min=0 max=999 value="<?php if(isset($game_score2)): echo $game_score2; endif; ?>" <?php if(isset($game_score2) && $game_score2 > 0): echo 'disabled'; endif; ?>> 
											<input type="hidden" class="form-control" name="school2" id="school2"value="<?php echo $event_details->row()->school2; ?>"> 
										</div>
		                            </div>
		                            
	                            </div>
	                            <input type="hidden" name="winner" id="winner" value="">
	                            <input type="hidden" name="last_gameno" id="last_gameno" value="<?php echo $last_gameno; ?>">
	                           
	                            <input type="hidden" name="event_id" id="event_id" value="<?php echo $this->uri->segment('3'); ?>">
	                            
	                             <div class="col-md-12">
	                             	<div class="col-md-4"></div>
		                            <div class="col-md-4">
		                          	 	<button name="saveScore" class="btn btn-danger btn-lg btn-block"style="-moz-border-radius: 2px;-webkit-border-radius: 2px; box-shadow: 8px 8px 8px -5px rgba(0,0,0,0.54);" id="saveScore">Save</button>
		                            </div>
		                            <div class="col-md-4"></div>
                             	</div>
                             
							</form>
							
                        </div>
                    </div>	
                </div>
            </div>
    	</div>
    </div>
   
   
    <script src="<?php echo base_url(); ?>bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <script src="<?php echo base_url(); ?>bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>
    
     <script src="<?php echo base_url(); ?>bootstrap/js/scorer.js"></script>

    <script src="<?php echo base_url(); ?>bootstrap/dist/js/sb-admin-2.js"></script>	
    
    <script>

		function getDate(){
// 			var today = new Date();
// 			if(Date($('#date').val()) < today )){
// 				alert('Hindi pwede');
// 			}else{
// 				alert('walang error');
// 			}

		}	
		</script>	