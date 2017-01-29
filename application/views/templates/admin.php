<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo base_url(); ?>bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>bootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>bootstrap/css/css.css" rel="stylesheet" type="text/css">

  

</head>


<body>
    <div id="wrapper">

       <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0; ">
		
            <div class="navbar-header" >
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
                <a class="navbar-brand" href="dashboard.php"><b></b></a>
            </div>
            <!-- /.navbar-header -->
				<ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a href="login.php"><i class="fa fa-user fa-fw"></i> Log In</a>
                 </li>
				 <li>
					<a href="signup.php"><i class="fa fa-sign-in fa-fw"></i> Sign Up</a>
				 </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div style="padding-left:20px; color: #347AB6">
                               <b><i class="fa fa-calendar-o"></i>&nbsp;<?php echo date("D, M. d, Y ");?><br><i class="fa fa-clock-o"></i>&nbsp;<span id='time'></span></b	>
                            </div>
                        </li>
                        <li>
                            <a href="home_guest.php"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>									
						
						<li>
                            <a href="single.php"><i class="fa fa-trophy fa-fw"></i>Event Management<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li>
										<a href="listing">Event List</a>
									</li>
									
									<li>
										<a href="eventlist_menu_guest.php">Scheduling</a>
									</li>
									<li>
										<a href="ranking_guest.php">Ranking</a>
									</li>
									<li>
										<a href="prog_guest.php">Programs</a>
									</li>
								</ul>
                        </li>
						<li>
                            <a href="about_guest.php"><i class="fa fa-info-circle"></i> About Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper" >
           
			<?php echo $content; ?>
			
			
        </div>
	</div>

    <script src="<?php echo base_url(); ?>bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <script src="<?php echo base_url(); ?>bootstrap//bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>bootstrap//bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <script src="<?php echo base_url(); ?>bootstrap/dist/js/sb-admin-2.js"></script>
	
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

