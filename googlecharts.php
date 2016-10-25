<?php
error_reporting (0);
		require ('conn.php');
	$unos = implode(',', $_POST['unos']);
	$dos = implode("','", $_POST['unos']);
	
	$query = "SELECT".$dos." FROM enrolment";
	if(isset($_POST['year'])){
	$start_year = $_POST['year'][0];
	$end_year = $_POST['year'][1];
	}else{
	$start_year = 1963;
	$end_year = 1977;
	}

	$result = mysql_query($query);
	?>
<DOCTYPE html>
<html>
  <head>
    <title>Google Charts</title>	
		
		<script type="text/javascript"
			  src="https://www.google.com/jsapi?autoload={
				'modules':[{
				  'name':'visualization',
				  'version':'1',
				  'packages':['corechart']
				}]
			  }">
		</script>
		  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/scroll.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
	<style type="text/css">
	div.inline { float:left; }
	.clearBoth { clear:both; }
	</style>
	</head>

<body>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Google Charts</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>                
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
				<br><br><br>
				<div class="col-lg-4" >
				<form id="demograph" name="demograph" method="POST" >
				  <p>Please, choose the year to proceed result:</p>
				  <p>
				
					<label for="years">Year:</label>
					<?php
					
					  $query = "SELECT year FROM enrolment";
					  $lastquery = "SELECT year FROM enrolment ORDER BY enrolment_id DESC ";
					  $result = mysql_query($query);
					  $new_result = mysql_query($lastquery);
					  if ($result) {
					?>
					From
					<select id="year" name="year[0]" onchange="wait();">
					<option value="<?php if(isset($_POST['year'][0])) {echo $_POST['year'][0]; }else{echo "1963";}?> "><?php if(isset($_POST['year'][0])) {echo $_POST['year'][0]; }else{echo "--Start Year--";}?></option>
					  <?php
						while ($row = mysql_fetch_assoc($result)) {
						  echo '<option value="', $row['year'], '">', $row['year'], '</option>';  
						}
					  ?>
					</select>
					&nbsp to &nbsp
					<select id="endyear" name="year[1]" onchange="wait();" ;>
					<option value="<?php if(isset($_POST['year'][1])) {echo $_POST['year'][1]; }else{echo "1977";}?>" ><?php if(isset($_POST['year'][1])) {echo $_POST['year'][1]; }else{echo "--End Year--";}?></option>
					  <?php
						while ($row = mysql_fetch_assoc($new_result)) {
						
						  echo '<option value="', $row['year'], '">', $row['year'], '</option>';  
						}
					  ?>
					</select>
					  <?php } ?>
				  </p>
					  
						

										<div class="checkbox">
										  <label><input type="checkbox" id="unos" name="unos[0]" value="female" <?php if(isset($_POST['unos'][0])) {echo "checked"; }?> onchange="wait();">Girls</label>
										</div>
										<div class="checkbox ">
										  <label><input type="checkbox" id="unos1" name="unos[1]" value="male" <?php if(isset($_POST['unos'][1])){ echo "checked";} ?> onchange="wait();">Boys</label>
										</div>
										<div class="checkbox ">
										  <label><input type="checkbox" id="unos2" name="unos[2]" value="total_enrolment" <?php if(isset($_POST['unos'][2])){ echo "checked";} ?> onchange="wait();">Total</label>
										</div>
						</form>	
					</div>
		<div class="col-lg-8">	
		<div id="curve_chart" class="inline" style="width: 800px; height: 500px" ></div>
		</div>
		<div id="columnchart_material" class="inline" style="width: 800px; height: 500px;"></div>
		
		</div>
	</div>
</div>	


	<script language="javascript" type="text/javascript">

	var timeoutID = 0;
		function wait() {
		clearTimeout(timeoutID);
		timeoutID = setTimeout("document.demograph.submit();", 1000);
		}
	
	</script>	
	 <script type="text/javascript">
      google.setOnLoadCallback(drawChart);
      function drawChart() {
			var data = google.visualization.arrayToDataTable([
					   <?php
			if (isset($_POST['unos'])&&($_POST['year'])){
			#$query = "SELECT year,".$unos." FROM enrolment";
			$query = "SELECT year,".$unos." FROM enrolment WHERE year BETWEEN ". $start_year." AND ".$end_year." ";
			$result = mysql_query($query);
			?> 
			['Year','<?php echo $dos;?>'],
			<?php while ($row = mysql_fetch_assoc($result)) { ?>
				
				['<?php echo $row['year'];?>'
				<?php $count_m = count( $row['female']);
						if ($count_m>0){echo ",".$row['female'];}?>
				<?php $count_f = count( $row['male']);
						if ($count_f>0){echo ",".$row['male'];}?>
				<?php $count_t = count( $row['total_enrolment']);
						if ($count_t>0){echo ",".$row['total_enrolment'];}?>],
			<?php } ?>
				]); <?php				
			}elseif (isset($_POST['year'])){
			#$query = "SELECT year,".$unos." FROM enrolment";
			$query = "SELECT * FROM enrolment WHERE year >= ". $start_year." AND year <= ".$end_year." ";
			$result = mysql_query($query);
			?> 
			['Year', 'Female', 'Male','Total Enrolment'],
			<?php while ($row = mysql_fetch_assoc($result)) { ?>
				
				['<?php echo $row['year'];?>'
				<?php $count_m = count( $row['female']);
						if ($count_m>0){echo ",".$row['female'];}?>
				<?php $count_f = count( $row['male']);
						if ($count_f>0){echo ",".$row['male'];}?>
				<?php $count_t = count( $row['total_enrolment']);
						if ($count_t>0){echo ",".$row['total_enrolment'];}?>],
			<?php } ?>
				]); <?php				
			}else{
				$query = "SELECT * FROM enrolment"; 	
			
			$result = mysql_query($query);
			?> 
			['Year', 'Male', 'Female','Total Enrolment'],
			<?php while ($row = mysql_fetch_assoc($result)) { ?>	
				['<?php echo $row['year'];?>',<?php echo $row['male'];?>,<?php echo $row['female'];?>,<?php echo $row['total_enrolment'];?>],
			<?php } ?>
				]);
			<?php }?>
			 /*
			['Year', 'Male', 'Female'],
			<?php while ($row = mysql_fetch_assoc($result)) { ?>	
				['<?php echo $row['year'];?>', <?php echo $row['male'];?>,<?php echo $row['female'];?>],
			<?php } ?>
				]); */
				var options = {
				  title: 'Primary Enrolment',
				  curveType: 'function',
				  legend: { position: 'bottom' }
				};
				var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
				chart.draw(data, options);		
      }
    </script>
	<script type="text/javascript">
      google.load("visualization", "1.1", {packages:["bar"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
           <?php
			if (isset($_POST['unos'])){
			#$query = "SELECT * FROM enrolment WHERE year >= ". $_POST['year']." AND year <= 1977 "; 
			$query = "SELECT year,".$unos." FROM enrolment WHERE year >= ". $start_year." AND year <= ".$end_year." ";
			$result = mysql_query($query);
			?> 
			['Year','<?php echo $dos;?>'],
			<?php while ($row = mysql_fetch_assoc($result)) { ?>
				
				['<?php echo $row['year'];?>'
				<?php $count_m = count( $row['female']);
						if ($count_m>0){echo ",".$row['female'];}?>
				<?php $count_f = count( $row['male']);
						if ($count_f>0){echo ",".$row['male'];}?>
				<?php $count_t = count( $row['total_enrolment']);
						if ($count_t>0){echo ",".$row['total_enrolment'];}?>],
			<?php } ?>
				]); <?php				
			}elseif (isset($_POST['year'])){
			#$query = "SELECT year,".$unos." FROM enrolment";
			$query = "SELECT * FROM enrolment WHERE year >= ". $start_year." AND year <= ".$end_year." ";
			$result = mysql_query($query);
			?> 
			['Year', 'Female', 'Male','Total Enrolment'],
			<?php while ($row = mysql_fetch_assoc($result)) { ?>
				
				['<?php echo $row['year'];?>'
				<?php $count_m = count( $row['female']);
						if ($count_m>0){echo ",".$row['female'];}?>
				<?php $count_f = count( $row['male']);
						if ($count_f>0){echo ",".$row['male'];}?>
				<?php $count_t = count( $row['total_enrolment']);
						if ($count_t>0){echo ",".$row['total_enrolment'];}?>],
			<?php } ?>
				]); <?php				
			}else{
				$query = "SELECT * FROM enrolment"; 	
			
			$result = mysql_query($query);
			?> 
			['Year', 'Male', 'Female','Total Enrolment'],
			<?php while ($row = mysql_fetch_assoc($result)) { ?>	
				['<?php echo $row['year'];?>',<?php echo $row['male'];?>,<?php echo $row['female'];?>,<?php echo $row['total_enrolment'];?>],
			<?php } ?>
				]);
			<?php }?>
        var options = {
          chart: {
            title: 'Primary Enrolment',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>
                </div>
            </div>

</body>
</html>