<?php

// Get the organization names
$organizations = mysql_query("SELECT DISTINCT `camp-id` 
								FROM `campaign-donations` 
								WHERE `date` LIKE '".$_POST['year']."-".$_POST['month']."%'");

$output .= '
<b><u>Campaign Detailed Transactions</u></b><br>
<b>Date Covered: </b>' . $_POST['month'] . '/' . $_POST['year'] . '<br>
<b>Report Generated: </b>' . date("D, F d Y") . '<br><br>';

$i = 0;

// Go over every Organization
while ( $i < mysql_num_rows($organizations) ) 
{
	$id = mysql_result($organizations, $i, "camp-id");

	// Get the Organization Name
	$user = mysql_result( mysql_query("SELECT `username` FROM `Campaigns` WHERE `id` = ".$id), 0 );
	$name = mysql_result( mysql_query("SELECT `organization-name` FROM `OSFL` WHERE `username` = '".$user."'"), 0 );

	// Get the Totals
	$details = mysql_query("SELECT *
							FROM `campaign-donations` 
							WHERE `camp-id` = ".$id." 
							AND `date` LIKE '".$_POST['year']."-".$_POST['month']."%'");

//echo "SELECT * FROM `osfl-donations` WHERE `org-id` = ".$id." AND `date` LIKE '".$_POST['year']."-".$_POST['month']."%'<br>";

	// Table Displaying all NFPOs (for Export to excel)
		$output .= '
		<table align="left" border="1">
		  <tbody>
			<center>
				<th colspan="7">'.$name.' - Campaign #'.$id.'</th>
				
			  	<tr bgcolor="#000000">
					<td width="100">
					<font color="#FFFFFF"><b>#</b></font>
					</td>
					<td width="100">
					<font color="#FFFFFF"><b>Transaction Number</b></font>
					</td>			
					<td width="100">
					<font color="#FFFFFF"><b>Transaction Date</b></font>
					</td>
					<td width="100">
					<font color="#FFFFFF"><b>Amount</b></font>
					</td>
					<td width="200">
					<font color="#FFFFFF"><b>Donor Name</b></font>
					</td>
					<td width="200">
					<font color="#FFFFFF"><b>Donor E-mail</b></font>
					</td>
					<td width="200">
					<font color="#FFFFFF"><b>Receiving E-mail</b></font>
					</td>
				</tr>';

	$j = 0;

	// Go over each transaction
	while( $j < mysql_num_rows($details) )
	{
		$values = mysql_fetch_assoc($details, $j);

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
				($j+1)
				.'</td>
				<td width="100">'.
				$values['transaction-id']
				.'</td>
				<td width="100">'.
				$values['date']
				.'</td>
				<td width="100">$'.
				$values['amount']
				.'</td>
				<td width="200">'.
				$values['donor-name']
				.'</td>
				<td width="200">'.
				$values['donor-email']
				.'</td>
				<td width="200">'.
				$values['receiver']
				.'</td>
			</tr>
		';

		$j++;
	
	}

	$i++;
	$output .= '
				</center>
			  </tbody>
			</table>';
}

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