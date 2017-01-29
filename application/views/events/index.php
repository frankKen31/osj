 
     
<div class="row">			
    <div class="col-lg-12">
        <h1 class="page-header" style="color:#3979B9; font-weight:bold; font-family:trebuchet MS, sans-serif;">Event Management System</h1>				
    </div>			
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary" style="-webkit-box-shadow: 20px 19px 20px -5px rgba(0,0,0,0.54);-moz-box-shadow: 20px 19px 20px -5px rgba(0,0,0,0.54);box-shadow: 20px 19px 20px -5px rgba(0,0,0,0.54); -moz-border-radius: 80px;-webkit-border-radius:10px; border-radius: 1px">
            <div class="panel-heading" style="border-radius: 0px">
				<h4><center><b> Event List </b></center></h4>
            </div>
            <div class="panel-body">
            
             	<div class="row">                              
                    <form action="<?php echo base_url('events/listing?eventtype='.$_GET['eventtype']); ?>" method="post">
                    	<div class="col-lg-12">
                    		<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										<label>Event</label>
											
											<select name="eventClass" class="form-control" >
												<?php if(isset( $_POST['eventClass'])): ?>
													<option value="<?php echo $_POST['eventClass']; ?>" selected disabled><?php echo $_POST['eventClass']?></option>
												<?php else:?>
													<option value=""  selected disabled>Please select Event...</option>
												<?php endif; ?>
												<?php if(isset($_GET['eventtype'])): ?>
    												<?php if($_GET['eventtype'] == 'sports' || $_GET['eventtype'] == 'Sports'): ?>
        												<?php foreach ($games as $game ): ?>
        												<option value="<?php echo $game->name?>"><?php echo $game->name?></option>
        												<?php endforeach;?>
    												
    												<?php elseif($_GET['eventtype'] == 'cultural'): ?>
        												<?php foreach ($culturals as $cultural ): ?>
        												<option value="<?php echo $cultural->name?>"><?php echo $cultural->name?></option>
        												<?php endforeach;?>
        												
    												<?php endif;?>
												<?php endif;?>
											</select>
									</div>
								</div>
								
								<div class="col-lg-2">
    								<div class="form-group">
    									<label>Category</label>
    										<select name="category" class="form-control" >
    											<?php if(isset( $_POST['category'])): ?>
    												<option value="<?php echo $_POST['category']; ?>" selected disabled><?php echo $_POST['category']; ?></option>
    											<?php else:?>
													<option value=""  selected disabled>Please select Event...</option>
												<?php endif; ?>
    											
    											<option value="Boys">Boys</option>
    											<option value="Girls">Girls</option>
    										</select>
    								</div>
    							</div>
    							<div class="col-lg-2">
    								<div class="form-group">
    									<label>Level</label>
    										<select name="division" class="form-control" >
												<?php if(isset( $_POST['division'])): ?>
    												<option value="<?php echo $_POST['division']; ?>" selected disabled><?php echo $_POST['division']; ?></option>
    											<?php else:?>
													<option value=""  selected disabled>Please select Event...</option>
												<?php endif; ?>
    											<option value="Elementary">Elementary</option>
                                                <option value="Secondary">Secondary</option>
    											</select>
    								</div>
    							</div>
    							<div class="col-lg-2">
    								<div class="form-group">
    									<label>Date</label>
    									<input name="date" type="date" class="form-control" >                                     
    								</div>							
								</div>
                    		</div>
                    		<div class="col-lg-12">
    							<div class="row">
    								<div class="col-lg-4"style="padding-top:15px">
    									<button name="btnSearch" class="btn btn-success btn-lg btn-block" style="-moz-border-radius: 2px;-webkit-border-radius: 2px; box-shadow: 8px 8px 8px -5px rgba(0,0,0,0.54);">Search</button>		
    								</div>
    								<div class="col-lg-4"style="padding-top:15px">
    									<input type="reset" class="btn btn-warning btn-lg btn-block" style="-moz-border-radius: 2px;-webkit-border-radius: 2px; box-shadow: 8px 8px 8px -5px rgba(0,0,0,0.54);">		
    								</div>
    								<div class="col-lg-4"style="padding-top:15px">
    									<a href="eventlist_menu.php" class="btn btn-danger btn-lg btn-block" style="-moz-border-radius: 2px;-webkit-border-radius: 2px; box-shadow: 8px 8px 8px -5px rgba(0,0,0,0.54);">Cancel</a>
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

<div class="col-lg-12">
	<div class="panel panel-primary" style="-webkit-box-shadow: 20px 19px 20px -5px rgba(0,0,0,0.54);-moz-box-shadow: 20px 19px 20px -5px rgba(0,0,0,0.54);box-shadow: 20px 19px 20px -5px rgba(0,0,0,0.54); -moz-border-radius: 80px;-webkit-border-radius:10px; border-radius: 1px">
		<div class="panel-heading" style="border-radius: 0px">
    		<button type="button" class="btn btn-md btn-danger btn-block">
    			<h4><center><b><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;&nbsp; Print Event List</b></center></h4>
    		</button>
		</div>
    	<div class="panel-body">
    		<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
    				<thead>
    					<tr>
    						<th>Game no.</th>
    						<th>Player</th>
    						<th>Event</th>
    						<th>Category</th>
    						<th>Level</th>
    						<th>Date</th>
    						<th>Time</th>
    						<th>Location</th>
    						
    					</tr>
    				</thead>
					<tbody style="">
					
					<?php if($events->num_rows() > 0):?>
					<?php  foreach ($events->result() as $event):?>
						<tr>
							<td><?php echo $event->event_num;?></td>
							<td style="vertical-align:middle; align:middle"><?php echo $event->school1; ?> VS <?php echo $event->school2;?></td>
							<td style="vertical-align:middle"><?php echo $event->event_class;?></td>
							<td style="vertical-align:middle"><?php echo $event->category;?></td>
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


<center>
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><center>Warning!!!</center></h4>
				</div>
				<div class="modal-body">
					Are you sure you want to <b>Save</b> this event?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Yes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><center>Warning!!!</center></h4>
				</div>
				<div class="modal-body">
					Are you sure you want to <b>Clear</b> the fields?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" >Yes</button></a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>													
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel"><center>Warning!!!</center></h4>
				</div>
				<div class="modal-body">
					Are you sure you want to <b>Cancel</b>?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Yes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>													
			</div>
		</div>
	</div>
</center>
								