<?php

// Get the organization names
$organizations = mysql_query("SELECT DISTINCT `org-id` 
								FROM `osfl-donations` 
								WHERE `date` LIKE '".$_POST['year']."-".$_POST['month']."%'");

$output .= '
<b><u>Detalles de Transacciones de OSFL</u></b><br>
<b>Fecha Cubierta: </b>' . $_POST['month'] . '/' . $_POST['year'] . '<br>
<b>Reporte Generado: </b>' . date("D, F d Y") . '<br><br>';

$i = 0;

// Go over every Organization
while ( $i < mysql_num_rows($organizations) ) 
{
	$id = mysql_result($organizations, $i, "org-id");

	// Get the Organization Name
	$name = mysql_result( mysql_query("SELECT `organization-name` FROM `OSFL` WHERE `id` = ".$id), 0 );

	// Get the Totals
	$details = mysql_query("SELECT *
							FROM `osfl-donations` 
							WHERE `org-id` = ".$id." 
							AND `date` LIKE '".$_POST['year']."-".$_POST['month']."%'");

//echo "SELECT * FROM `osfl-donations` WHERE `org-id` = ".$id." AND `date` LIKE '".$_POST['year']."-".$_POST['month']."%'<br>";

	// Table Displaying all NFPOs (for Export to excel)
		$output .= '
		<table align="left" border="1">
		  <tbody>
			<center>
				<th colspan="7">'.$name.'</th>
				
			  	<tr bgcolor="#000000">
					<td width="100">
					<font color="#FFFFFF"><b>#</b></font>
					</td>
					<td width="100">
					<font color="#FFFFFF"><b>Número de Transacción</b></font>
					</td>			
					<td width="100">
					<font color="#FFFFFF"><b>Fecha de Transacción</b></font>
					</td>
					<td width="100">
					<font color="#FFFFFF"><b>Cantidad</b></font>
					</td>
					<td width="200">
					<font color="#FFFFFF"><b>Nombre de Donante</b></font>
					</td>
					<td width="200">
					<font color="#FFFFFF"><b>E-mail de Donante</b></font>
					</td>
					<td width="200">
					<font color="#FFFFFF"><b>E-mail que recibe</b></font>
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
			    <input type = "submit" name = "Excel" Value = "Exportar a Excel">
			</form>

		</td>
	</tr>
</table>