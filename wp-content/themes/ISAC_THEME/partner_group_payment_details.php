
<?php

/* Template Name: partner_group_payment_details  */

?>

 <?php get_header();
 
 //Connect to mysql server
$dblink = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$dblink) {
	die('Failed to connect to server: ' . mysql_error());
}

//Select database
$db = mysql_select_db(DB_DATABASE);
if(!$db) {
	die("Unable to select database");
}


/*echo '<pre>';
print_r($_SESSION);
echo '</pre>';*/

if(!isset($_SESSION['SESS_MEMBER_ID'])||(trim($_SESSION['SESS_MEMBER_ID']) == '' || $_SESSION['SESS_MEMBER_PARTNER_TYPE'] != 'PARTNER')) {
	
	?>
 <link href="css/style.css" rel="stylesheet" type="text/css" />
 

<div id="art-page-background-glare">
<div id="art-page-background-glare-image">
<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-body">
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
        <!-- Start form --->
 <div class="left_sect reg lft" style="margin-top:35px; margin-bottom:35px;">
  <div class="top_spacing">
      <table width="450" border="0" cellspacing="0" cellpadding="0"  align="center">
    <tr>
      <td width="540"></td>
    </tr>
  <tr>
    <td height="35" align="center">
      <span style="color:#F00; font-size:18px; text-align:center"><strong>ACCESS DENIED. <br />

Kindly Register/login to continue.</strong></span><br />
<br />

      <div class="btn_cent"><a href="registration-option"><img src="<?php bloginfo('template_url'); ?>/images/btn_register.jpg" border="0"  /></a>&nbsp; &nbsp; <a href="student-login"><img src="<?php bloginfo('template_url'); ?>/images/btn_login.jpg" border="0"  /></a></div>
    </td>
  </tr>
  

  
  </table>
    </div>

    <!-- middle box ends here --> 
  </div>
<!--END FORM-->
			<?php
			get_sidebar('bottom'); 
			?>
          <div class="cleared"></div>
        </div>
    </div>
</div>
<div class="cleared"></div>


<?php

} 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
elseif($_SESSION['SESS_MEMBER_PARTNER_TYPE']=='PARTNER' && $_SESSION['SESS_MEMBER_ID']!='')
{

$isacid = $_SESSION['SESS_MEMBER_ID'];
$username = $_SESSION['SESS_FIRST_NAME'] ;
$partnerid = $_SESSION['SESS_MEMBER_PARTNER_ID'];
$partnername = $_SESSION['SESS_MEMBER_PARTNER_NAME'];

if($_POST['group_id'] != '')
{
	$group_id = $_POST['group_id'];
	$_SESSION['SESS_PARTNER_GROUP_ID'] = $group_id;
}
else
{
	$group_id = $_SESSION['SESS_PARTNER_GROUP_ID'];
}

$partner_sql = "SELECT * FROM partner WHERE isacid = '$isacid' AND group_id = '$group_id' AND partner_id = '$partnerid'";
$partner_result = mysql_query($partner_sql);
$partner_row =  mysql_fetch_array($partner_result);

?>

<br />

<div id="art-page-background-glare">
    <div id="art-page-background-glare-image">
<div id="art-main">
    <div class="art-sheet">
        <div class="art-sheet-body">
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell art-content">
        <!-- Start form --->
 <div class="summary_form reg top_spacing">
  <div class="rht_tab">

 <ul>
  <li><a href="create_partner_group" title="Create a group">Create a group</a></li>
          <li>|</li>
        <li><a href="student_panel_dashboard_partner" title="My Groups">My Groups</a></li>
  </ul>
        </div>
     <h2 class="fonts_h2_headlines" style="width:900px !important">Group Name: <?php echo $partner_row['group_name']; ?></h2> <br />
<h3 style="color:#930">
    	<?php
			if($partner_row['total_members'] == 0)
			{
				echo 'Payment Status: None';
			}
			else
			{
				echo 'Payment Status: '.$partner_row['paid_status'];
			}
			$status_check = $partner_row['paid_status'];
		?>
    </h3> <br /><br />
    <?php
		if($partner_row['total_members'] == 0)
		{
			echo '<h2 style="color:#930; text-align:center"><b>You have no Programs.</b></h2> <br /><br /><br /><br />';
		}
		else
		{
	?>
    <h2>Payment Details</h2>
	<?php 
        $query = "SELECT * FROM application WHERE group_id = '$group_id' AND partner_id = '$partnerid' ORDER BY id desc";
        $result = mysql_query($query);
		
		?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="admin_tbl">
        <tr>
        	<th>First name</th>
            <th>Email</th>
            <th>Program Name</th>
            <th>Program Fee</th>
            <th class="brn_n">Payment</th>
        </tr>
        
		<?php 
        $fee_total = array();
		$i = 0;
        while($row=mysql_fetch_array($result))
        { 
      		$total = $row['fee'];
			$id=$row['id'];
			$fee_total[$i] = $total;
			//$total_fees = $total_fees + $row['fee'];
        ?>
        
        <tr>
           <td width="191"><?php echo $row['firstname']; ?></td>
           <td width="241"><?php echo $row['email']; ?></td>
           <td width="260"><?php echo $row['program']; ?></td>
           <td width="273" >$<?php echo $row['fee']; ?></td>
           <td width="273" class="brn_n">&nbsp;</td>
           
        </tr>
	<?php
		$i++;
      } // Your while loop here			
	//print_r($calcTotal);		
?>
<tr>
           <td width="191">&nbsp;</td>
           <td width="241">&nbsp;</td>
           <td width="260"><strong style="font-size:14px;color:#930">Total Group Program Fee</strong></td>
           <td width="273" style="color:#930;font-size:14px;font-weight:bold">$<?php echo array_sum($fee_total); ?></td>
           <td width="273" class="brn_n">
           <?php
		   if($status_check=='PAID')
		   {
		   ?>
             <img src='<?php bloginfo('template_url'); ?>/images/btn_paid.jpg' alt='PAID' />
           <?php
		   }
		   else
		   {
			
		   ?>
          
           <form name="student" action="<?php echo SERVER_URL; ?>partner_group_payment_summary" method="post">
            <input type="hidden" value="<?php echo $group_id; ?>" name="group_id" />
            <input type="hidden" value="<?php echo array_sum($fee_total); ?>" name="total_fee" />
            <input type="image" src="<?php bloginfo('template_url'); ?>/images/btn_paynow.jpg" name="Pay Now" />
        </form>
        <?php
		   }
		?>
        </td>
        </tr>
	</table>
    <!-- middle box ends here --> 
     <?php
	}//no records else condition closed
	?>
  </div>
<!--END FORM-->
			<?php
			get_sidebar('bottom'); 
			?>
          <div class="cleared"></div>
        </div>
    </div>
</div>
<div class="cleared"></div>
<br />
<?php 
}
get_footer(); 
?>
