<?php 
    //Include database connection details
	require_once('config.php');
	
	//$group = $_POST["csi"];	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	//$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	$q=$_GET["q"];
?>
 <table border="0" width="929" class="admin_tbl" cellspacing="0" cellpadding="0">

<tr>
<th width="285" style="text-align:center">Programs</th>
<th width="478" style="text-align:center">Arrival Date</th>
<th width="166" class="brn_n" style="text-align:center">EDIT </th>

</tr>
 <?php
 $quer_sql=mysql_query("SELECT * FROM isac_arrival_table WHERE program_id = '$q'"); 
	while($arrival = mysql_fetch_array($quer_sql)) 
	{
		$program_id = $arrival['program_id'];
		$arrival_date = $arrival['arrival_date'];
		$arrival_month = $arrival['arrival_month'];
		$arrival_year = $arrival['arrival_year'];
		$sno = $arrival['sno'];
// start select value of program name from program table	
$quer_sql1=mysql_query("SELECT * FROM category WHERE cat_id = '$program_id'"); 	
	while($arrival_pr = mysql_fetch_array($quer_sql1)) 
	{
	?>
 <form method="post" action="edit_arrival_action.php" name="form_prog">   
<tr> 
<td><?php echo $arrival_pr['category'];   ?></td>


 <td><?php  echo $arrival_date.'-'; echo $arrival_month.'-'; echo $arrival_year; ?>
 <input type="hidden" value="<?php echo $arrival_date  ?>" name="ar_day" />
  <input type="hidden" value="<?php echo $arrival_month  ?>" name="ar_mo" />
   <input type="hidden" value="<?php echo $arrival_year  ?>" name="ar_yr" />
    <input type="hidden" value="<?php echo $program_id  ?>" name="ar_id" />
 <table align="right" border="0" style="margin:-5px 30px 0 0;">
 <tr>
 <td width="49" class="brn_n1"> <select name="day1" id="day1">
   <option value="<?php echo $arrival_date; ?>"> <?php echo $arrival_date; ?> </option>
<option value="1">1</option> 
<option value="2">2</option> 
<option value="3">3</option> 
<option value="4">4</option> 
<option value="5">5</option> 
<option value="6">6</option> 
<option value="7">7</option> 
<option value="8">8</option> 
<option value="9">9</option> 
<option value="10">10</option> 
<option value="11">11</option> 
<option value="12">12</option> 
<option value="13">13</option> 
<option value="14">14</option> 
<option value="15">15</option> 
<option value="16">16</option> 
<option value="17">17</option> 
<option value="18">18</option> 
<option value="19">19</option> 
<option value="20">20</option> 
<option value="21">21</option> 
<option value="22">22</option> 
<option value="23">23</option> 
<option value="24">24</option> 
<option value="25">25</option> 
<option value="26">26</option> 
<option value="27">27</option> 
<option value="28">28</option> 
<option value="29">29</option> 
<option value="30">30</option> 
<option value="31">31</option> 
</select></td>
<td width="96" class="brn_n1">  <select name="month1" id="month1" >
      <option value="<?php echo $arrival_month; ?>"> <?php echo $arrival_month; ?> </option>
<option value="January">January</option> 
<option value="February">February</option> 
<option value="March">March</option> 
<option value="April">April</option>
<option value="May">May</option> 
<option value="June">June</option> 
<option value="July">July</option> 
<option value="August">August</option> 
<option value="September">September</option> 
<option value="October">October</option> 
<option value="November">November</option> 
<option value="December">December</option> 
</select></td>
 <td width="62" class="brn_n1"> <select name="year1" id="year1">
      <option value="<?php echo $arrival_year; ?>"> <?php echo $arrival_year; ?> </option>
<option value="2012">2012</option> 
<option value="2013">2013</option>
<option value="2014">2014</option> 
<option value="2015">2015</option> 
<option value="2016">2016</option> 
<option value="2017">2017</option> 
</select></td>
 </tr>
 </table>
</td>
 <td  align="center" class="brn_n"><input type="hidden" name="sno1" value="<?php echo $sno; ?>" />
 <input type="image" src="images/btn_update.jpg" name="UPDATE" id="UPDATE" value="UPDATE" height="24px" /><input type="image" src="images/btn_delete.png" name="DELETE" value="DELETE" id="DELETE" />
</tr>
</form>
<?php
	}
	} // end arrival
?>



</table>