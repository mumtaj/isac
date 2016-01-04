<?php session_start();

//Include database connection details
require_once('../config/config.php');

if ($_SESSION['SESS_MEMBER_ID'] != '' AND $_POST['programs'] != '')
{
	$programs = $_POST['programs'];
	
	$sql = "SELECT * FROM isac_arrival_table WHERE program_id = '$programs' ORDER BY sno";
	$result = mysql_query($sql);
	?>
  		<select name='program_start_date' id='program_start_date' onchange="load_start_date();"  class='grad'>
         	<option value='000' >Select Date</option>
            <?php
				while($row = mysql_fetch_array($result))
				{ 

					$program_start_date = $row['arrival_date_full'];
					
					$days = (strtotime("$program_start_date") - strtotime(date("d-m-Y"))) / (60 * 60 * 24);
					
					if($days > 0)
					{
						echo "<option value='$program_start_date'>$program_start_date</option>";
					}
				}
			?>
		 </select>  
    <?php	
}

?>