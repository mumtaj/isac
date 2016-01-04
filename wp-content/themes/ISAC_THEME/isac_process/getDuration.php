<?php session_start();

//Include database connection details
require_once('../config/config.php');

if ($_SESSION['SESS_MEMBER_ID'] != '' AND $_POST['programs'] != '')
{
	$programs = $_POST['programs'];
	
	$sql = "SELECT * FROM isac_duration WHERE program_id = '$programs' ORDER BY id ASC";
	$result = mysql_query($sql);
	
	if(!empty($_POST['p']) && $_POST['p'] == 'diff') 
	print "<select name='owner_subcat'  style='width:80%' id='duration' onchange='load_cost()'>"; 
	else print "<select name='duration' id='duration' onchange=\"load_cost();\" class='grad'>"; 
	?>
  		
        
        
         	<option value='000' >Select Duration</option>
            <?php
				while($row = mysql_fetch_array($result))
				{ 

					$start_date = $row['start_week'];
					$end_date = $row['end_week'];
					$pr_id = $row['program_id'];
					$base_amt = $row['base_amount'];
					$diff_amt = $row['difference_amount'];
					// loop for the ittration
					
					$i = $start_date;
					
					
					for($i;$i<=$end_date;$i++)
					{
						if($row['id'] == $programs)
						{
							echo "<option value='$i'>$i weeks</option>";
						}
						else
						{
							echo  "<option value='$i'>$i weeks</option>";
						}
					}
				}
			?>
		 </select>  
    <?php	
}

?>