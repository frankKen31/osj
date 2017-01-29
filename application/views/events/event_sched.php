
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
        <div class="col-md-12">
            <h1 class="page-header">&nbsp;</h1>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary" style="-webkit-box-shadow: 20px 19px 20px -5px rgba(0,0,0,0.54);-moz-box-shadow: 20px 19px 20px -5px rgba(0,0,0,0.54);box-shadow: 20px 19px 20px -5px rgba(0,0,0,0.54); -moz-border-radius: 80px;-webkit-border-radius:10px; border-radius: 1px">
                <div class="panel-heading" style="border-radius: 0px">
					<h4><center><b> Create Schedule </b></center></h4>
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
	                            <form role="form" action="<?php echo base_url(); ?>events/scheduling" method="POST">
<!--                             		<div class="col-md-12 row-large	"> -->
<!--                             			<div class="col-md-2"></div> -->
<!--                             	 		<div class="form-group col-md-8" > -->
<!--                         					<label>Event Type</label> -->
<!--                         					<select class="form-control" name="event_type" required="required">   -->
<!-- 	                        					<option value="" selected disabled>Please Select...</option> -->
<!-- 	                        					<option value="Sports">Sports</option> -->
<!-- 	                        					<option value="Cultural">Cultural</option>												 -->
<!-- 	                        				</select> -->
<!-- 	                        		 	</div>	 -->
<!-- 	                        		 	<div class="col-md-2"></div> -->
	                        		 	                    		 		
<!-- 	                        	 	</div> -->
	                        	 	
	                        	 	<div class="col-md-12 row-large	">
                            			<div class="col-md-2"></div>
                            	 		<div class="form-group col-md-8" >
                        					<label>Event</label>
                                				<select class="form-control" name="event">
                                					<option value="" selected disabled>Please select Event...</option>
                                					<?php foreach($games as $game): ?>
                                					<option value="<?php echo $game->id ?>"><?php echo $game->name ?></option>
                                					<?php endforeach; ?>
                                				</select>
	                        		 	</div>	
	                        		 	<div class="col-md-2"></div>
	                        		 	                    		 		
	                        	 	</div>

	                        	 	<div class="col-md-12 row-large	">
                            			<div class="col-md-2"></div>
                            	 		<div class="form-group col-md-4" >
                        					<label>Division</label>
                                				<select class="form-control" name="division">
                                					<option value="" selected disabled>Please select Event...</option>
                                					<option>Elementary</option>
													<option>Highschool</option>
                                				</select>
	                        		 	</div>	
	                        		 	<div class="form-group col-md-4" >
                        					<label>Category</label>
                                				<select class="form-control" name="category">
                                					<option value="" selected disabled>Please select Event...</option>
                                					<option value='1'>Boys</option>
													<option value='2'>Girls</option>	
                                				</select>
	                        		 	</div>	
	                        		 	<div class="col-md-2"></div>
	                        		 	                    		 		
	                        	 	</div>	                        	 	
	                        	 	<!-- <div class="col-md-12 row-large	">
                            			<div class="col-md-2"></div> 
                            	 		<div class="form-group col-md-8" >
                        					<label>Number of Participants</label>
                        					<select class="form-control" name="num_participants" onchange="$('#num').text($(this).val())" >  
	                        					<option value="" selected disabled>Please Select...</option>
	                        					<?php for($i=1; $i <= count($schools); $i++):?>
	                        						<?php  if($i > 1): ?>
	                        							<option value="<?php echo $i ?>"><?php echo $i ?></option>
	                        						<?php endif; ?>
	                        					<?php endfor;?>
	                        															
	                        				</select>
	                        		 	</div>	
	                        		 	<div class="col-md-2"></div>
	                        		 	                    		 		
	                        	 	</div>-->
	                        	 	<div class="col-md-12">
	                        	 		<div class="col-md-2"></div>
                            	 		<div class="form-group  col-md-8" >
                            	 			<label>Select <span id="num"></span> Participants</label>
                            	 			<div class="form-group">
                            	 			<?php foreach($schools as $school): ?>	
                            	 				<div class="col-md-6">
                            	 				<input type="checkbox" class="" value="<?php echo $school->display_name?>" name="school[]" checked="checked"> <?php echo $school->display_name?>
                            	 				</div>
                            	 			<?php endforeach; ?>
                            	 			</div>
                            	 		</div>
                            	 		<div class="col-md-2"></div>
	                        	 	</div>
	                        	 	<div class="col-md-12">
	                        	 		<div class="col-md-2"></div>
                            	 		 
                                		
<!--                                 		<div class="col-md-4"> -->
<!-- 											<div class="form-group"> -->
<!-- 												<div class="form-group"> -->
<!-- 													<label>Location</label> -->
<!-- 													<select class="form-control" name="location"> -->
<!-- 														<option value="" selected disabled>Please select Location...</option> -->
<!-- 														<option>Court No.1</option> -->
<!-- 														<option>Court No.2</option> -->
<!-- 														<option>Court No.3</option> -->
<!-- 														<option>Court No.4</option> -->
<!-- 														<option>Court No.5</option> -->
<!-- 													</select> -->
<!-- 												</div>                                      -->
<!-- 											</div>							 -->
<!-- 										</div> -->
										
													
                            	 		<div class="col-md-2"></div>
	                        	 	</div>
 	                            	<div class="col-md-12">
                                   		<div class="col-md-2"></div>
                                		
                                		<div class="col-md-4">
                                			<div class="form-group">
                                				<label>Date</label>
                                				<input type="date"  name="startdate" class="form-control">                                     
                                			</div>							
                                		</div>
                                		<div class="col-md-4">
                                			<div class="form-group">
                                				<label>Start Time</label>
                                				<input type="time" class="form-control" name="starttime">                                     
                                			</div>							
                                		</div>
                                		
                                		<div class="col-md-2"></div>
                            		</div>
									
									<div class="col-md-12">
	                        	 		<div class="col-md-2"></div>
	                        	 		<div class="col-md-4">
                                			<div class="form-group">
                                				<label>Games per Day</label>
                                				<input type="number"  max="8" min="1" name="games_per_day" class="form-control">                                     
                                			</div>							
                    					</div>
                    					
	                        	 		<div class="col-md-4">
											<div class="form-group">
												<div class="form-group">
													<label>Time per Game</label>
													<select class="form-control" name="gametime">
														<option value="" selected disabled>Please select Game Time Limit...</option>
														<option value="15">15 mins</option>
														<option value="30">30 mins</option>
														<option value="60">1 hour</option>
														<option value="90">1 hour and 30 mins</option>
														<option value="120">2 hours</option>
														<option value="150">2 hours and 30 mins</option>
														
													</select>
	 												                      
												</div>                                   
											</div>							
										</div>
										
										<div class="col-md-2"></div>
									</div>	
										
	                        	 	<div class="col-md-12 text-center">
	                        	 		<button class="btn btn-danger " name="save">Save</button>
	                        	 		
	                        	 	</div>
	                            </form>
	                        </div>
	                        
                    </div>	
                </div>
            </div>
    	</div>
    </div>
   
   
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <script src="../dist/js/sb-admin-2.js"></script>	
    
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