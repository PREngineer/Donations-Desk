<?php

// Get the organization names
$campaigns = mysql_query("SELECT DISTINCT `camp-id` 
								FROM `campaign-donations` 
								WHERE `date` LIKE '".$_POST['year']."-".$_POST['month']."%'");

$output .= '
<b><u>Campaign Totals</u></b><br>
<b>Date Covered: </b>' . $_POST['month'] . '/' . $_POST['year'] . '<br>
<b>Report Generated: </b>' . date("D, F d Y") . '<br><br>';

$i = 0;

// Table Displaying all NFPOs (for Export to excel)
$output .= '
<table align="left" border="1">
  <tbody>
	<center>

	  	<tr bgcolor="#000000">
			<td width="100">
			<font color="#FFFFFF"><b>#</b></font>
			</td>
			<td width="300">
			<font color="#FFFFFF"><b>Org. Name</b></font>
			</td>
			<td width="100">
			<font color="#FFFFFF"><b>Campaign ID</b></font>
			</td>
			<td width="300">
			<font color="#FFFFFF"><b>Campaign Details</b></font>
			</td>
			<td width="100">
			<font color="#FFFFFF"><b>Donations</b></font>
			</td>
			<td width="100">
			<font color="#FFFFFF"><b>Total Donated</b></font>
			</td>
		</tr>';

// Go over every Organization
while ( $i < mysql_num_rows($campaigns) ) 
{
	$id = mysql_result($campaigns, $i, "camp-id");

	// Get the Username of the Campaign Owner
	$name = mysql_result( mysql_query("SELECT `username` FROM `Campaigns` WHERE `id` = ".$id), 0 );

	//  Get the Campaign Info
	$info = mysql_result( mysql_query("SELECT `info` FROM `Campaigns` WHERE `id` = ".$id), 0, "info" );

	// Get the Totals
	$totals = mysql_fetch_assoc( mysql_query("SELECT COUNT(amount) as total, 
												SUM(amount) as donated 
												FROM `campaign-donations` 
												WHERE `camp-id` = ".$id) );

	// Get the Organization Name
	$NFPO = mysql_result(mysql_query("SELECT `organization-name` FROM `OSFL` WHERE `username` = '$name'"), 0, "organization-name");

	$output .= '
		<tr class="block"';
		// Uneven rows are gray
		if($i % 2 != 0)
		{
			$output .= ' bgcolor="#9F9B9B"';
		}
		else
		{
			$output .= ' bgcolor="#FEDD8C"';
		}
	$output .=	'>
			<td width="100">'.
			($i+1)
			.'</td>
			<td width="300">'.
			$NFPO
			.'</td>
			<td width="100">'.
			$id
			.'</td>
			<td width="300">'.
			$info
			.'</td>
			<td width="100">'.
			$totals['total']
			.'</td>
			<td width="100">$'.
			$totals['donated']
			.'</td>
		</tr>
	';

	$i++;
}

$output .= '
	</center>
  </tbody>
</table>';

// Show the actual content
echo $output;

?>

<br><br>

<table>
	<tr>
		<td align='center'>

			<form action = "/donationsdesk/excel/export.php" method = "post">
			    <input type = "hidden" name = "body" value = '<?php echo $output; ?>'>
			    <input type = "submit" name = "Excel" Value = "Export to Excel">
			</form>

		</td>
	</tr>
</table>