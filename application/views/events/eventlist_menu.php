
			<br><br><br><br>
            <div class="row row-large">			
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
                        <div class="panel-body text-center">
                            <div class="row">                              
                              				
									<div class="col-lg-12">
										<div class="row text-center">
											
											<div class="col-lg-4"style="padding-top:15px">
												<a href="<?php echo base_url(); ?>events/listing?eventtype=sports">
												<button name="sports" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#myModal1" style="-moz-border-radius: 2px;-webkit-border-radius: 2px; box-shadow: 8px 8px 8px -5px rgba(0,0,0,0.54);">Sports</button>
												</a>
											</div>
											
											<div class="col-lg-4"style="padding-top:15px">
												<a href="<?php echo base_url(); ?>events/listing?eventtype=cultural">
												<button name="cultural" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#myModal2" style="-moz-border-radius: 2px;-webkit-border-radius: 2px; box-shadow: 8px 8px 8px -5px rgba(0,0,0,0.54);">Cultural</button>
												</a>
											</div>
											
										</div>
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

