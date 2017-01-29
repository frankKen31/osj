
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
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                                                              
                        <form role="form" action="<?php echo base_url(); ?>events/scheduling" method="POST">
                        	 <div class="col-lg-12">
                        	 	<div class="col-lg-4">
                            	 	<div class="form-group">
                        				<label>Event Type</label>
                        				<select class="form-control" name="event_type" required="required">  
                        					<option value="" selected disabled>Please Select...</option>
                        					<option value="Sports">Sports</option>
                        					<option value="Cultural">Cultural</option>
                        																	
                        				</select>
                        		 	</div>
                    		 	</div>	
                                <div class="col-lg-2">
                        			<div class="form-group">
                        				<label>Game No.</label>
                        				<select class="form-control" name="game_no"> 
                        					<option value="" selected disabled>Please select Game No...</option>
                        					<option>1st</option>
                        					<option>2nd</option>
                        					<option>3rd</option>
                        					<option>4th</option>
                        					<option>5th</option>													
                        				</select>
                        			</div>									
                                </div> 
                                                    		 		
                        	 </div>
                        	<div class="col-lg-12">
                            	
                           
    							<div class="col-md-3">
    								<div class="form-group">
                            			<label>School</label>
                            				<select class="form-control" name="school1">
                            					<option value="" selected disabled>Please select School...</option>
                                                <?php foreach($schools as $school): ?>
                            						<option value="<?php echo $school->display_name ?>"><?php echo $school->display_name ?></option>
                            					<?php endforeach; ?>
                            				</select>
                            		</div>
                            		
    							</div>	
    							 <div class="col-lg-1">
                                	<div class="form-group">
                                		<h2>vs</h2>
                                	</div>
                                </div> 
    							<div class="col-lg-3">
                        			<div class="form-group">
                        				<label>School</label>
                        				<select class="form-control" name="school2">
                        					<option value="" selected disabled>Please select School...</option>
                        					<?php foreach($schools as $school): ?>
                        					<option value="<?php echo $school->display_name ?>"><?php echo $school->display_name ?></option>
                        					<?php endforeach; ?>
                        				</select>
                        			</div>									
           						 </div>
           						 <div class="col-lg-2">
                            			<div class="form-group">
                            				<label>Division</label>
                            				<select class="form-control" name="division"> 
                            					<option value="" selected disabled>Please select Game No...</option>
                            					<option>Elementary</option>
                            					<option>Highschool</option>
                            																		
                            				</select>
                            			</div>									
                                    </div> 
                                
                                <div class="col-lg-2"style="padding-top:15px">
                        			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><button class="btn btn-primary btn-lg btn-block" style="-moz-border-radius: 2px;-webkit-border-radius: 2px; box-shadow: 8px 8px 8px -5px rgba(0,0,0,0.54);">Next</button></a>
                                </div>
                        	</div>
                            <div class="col-lg-12">
                            <div id="collapseOne" class="panel-collapse collapse">
                                <div class="col-lg-12">
                                	<div class="row">
                                		<div class="col-lg-2">
                                			<div class="form-group">
                                				<label>Event</label>
                                				<select class="form-control" name="eventclass">
                                					<option value="" selected disabled>Please select Event...</option>
                                					<?php foreach($games as $game): ?>
                                					<option value="<?php echo $game->id ?>"><?php echo $game->name ?></option>
                                					<?php endforeach; ?>
                                				</select>
                                			</div>
                                		</div>
                                		<div class="col-lg-2">
                                			<div class="form-group">
                                				<label>Category</label>
                                				<select class="form-control" name="player">
                                					<option value="" selected disabled>Please select Category...</option>
                                					<option value="1">Boys</option>
                                					<option value="2">Girls</option>															
                                				</select>
                                			</div>
                                		</div>
                                		<div class="col-lg-2">
                                			<div class="form-group">
                                				<label>Date</label>
                                				<input type="date"  name="date" class="form-control">                                     
                                			</div>							
                                		</div>
                                		<div class="col-lg-2">
                                			<div class="form-group">
                                				<label>Time</label>
                                				<input type="time" class="form-control" name="game_time">                                     
                                			</div>							
                                		</div>
                                		<div class="col-lg-2">
                                			<div class="form-group">
                                				<div class="form-group">
                                				<label>Location</label>
                                				<select class="form-control" name="loc">
                                					<option value="" selected disabled>Please select Location...</option>
                                					<option>Court No.1</option>
                                					<option>Court No.2</option>
                                					<option>Court No.3</option>
                                					<option>Court No.4</option>
                                					<option>Court No.5</option>
                                				</select>
                                			</div>                                     
                                			</div>							
                                		</div>
                            			<div class="col-lg-2"style="padding-top:15px">
                            				<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><button class="btn btn-primary btn-lg btn-block" style="-moz-border-radius: 2px;-webkit-border-radius: 2px; box-shadow: 8px 8px 8px -5px rgba(0,0,0,0.54);">Next</button></a>						
                            			</div>
                            		</div>
                            	</div>
                            </div>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                    			<div class="col-lg-12">
                    				<div class="row">
                    					<div class="col-lg-4"style="padding-top:15px">
                    						<button class="btn btn-success btn-lg btn-block" data-toggle="modal" name="save" >Save</button>
                    					</div>
                    					<div class="col-lg-4"style="padding-top:15px">
                    						<a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><button class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#myModal2" style="-moz-border-radius: 2px;-webkit-border-radius: 2px; box-shadow: 8px 8px 8px -5px rgba(0,0,0,0.54);">Clear</button></a>		
                    					</div>
                    					<div class="col-lg-4"style="padding-top:15px">
                    						<a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><button class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#myModal3" style="-moz-border-radius: 2px;-webkit-border-radius: 2px; box-shadow: 8px 8px 8px -5px rgba(0,0,0,0.54);">Cancel</button></a>
                    					</div>
                    				</div>
                    			</div>
                    		</div>	         	
                        </form>							
					</div>					
                </div>
            </div>
        </div>
    </div>



    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <script src="../dist/js/sb-admin-2.js"></script>
			<!-- Time -->
			<script>
				function setTime() {
					var d = new Date(),
					el = document.getElementById("time");

					el.innerHTML = formatAMPM(d);

					setTimeout(setTime, 1000);
				}

				function formatAMPM(date) {
					var hours = date.getHours(),
					minutes = date.getMinutes(),
					seconds = date.getSeconds(),
					ampm = hours >= 12 ? 'PM' : 'AM';
					hours = hours % 12;
					hours = hours ? hours : 12; // the hour '0' should be '12'
					minutes = minutes < 10 ? '0'+minutes : minutes;
					var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
					return strTime;
				}
				setTime();
			</script>
							
</body>

</html>

