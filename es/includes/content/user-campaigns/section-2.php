<?php

echo '
	<!-- The Actual List Section -->
	<section class="nfp-list-section">
	
	<!-- Is inside a container -->
  	<div class="w-container">
    
    <!-- With 2 columns -->
    <div class="w-row">

	  <!-- Column #1 (5/6 of page width) - Content -->
      <div class="w-col w-col-10">
';

	// Get all Campaigns info
	$result = user_campaigns_data($user_data['username']);
	// Get how many the user has active
	$num = user_campaign_count($user_data['username']);

echo "<center>Tienes " . $num . " campaña(s) activas.</center><br>";

echo '
	  	<!-- Table Displaying all Active Campaigns-->
	  	<table>
		  <tbody>
			<center>
		
			  	<tr>
					<td width="200">
					<b>Campaña #</b>
					</td>
					<td width="100">
					<b>Logo</b>
					</td>
					<td width="100">
					<b>Categoría</b>
					</td>
					<td width="100">
					<b>Meta</b>
					</td>
					<td width="100">
					<b>Recaudado</b>
					</td>
					<td width="200">
					<b>PayPal</b>
					</td>
					</td>
					<td width="100">
					<b>Finalización</b>
					</td>
				</tr>
			</center>
		  </tbody>
		</table>

			<hr>
			<br>

		<table>
			<center>
		  <tbody>
';

	$i = 0;
	// Go over every result and display on the table.
	while ($i < $num) 
	{
		$id 		= mysql_result($result,$i,"id");
		$logo 		= mysql_result($result,$i,"campaign-logo");
		$category 	= mysql_result($result,$i,"category");
		$goal 		= mysql_result($result,$i,"goal");
		$collected 	= mysql_result($result,$i,"donated");
		$paypal 	= mysql_result($result,$i,"paypal");
		$end 		= mysql_result($result,$i,"end");

		// Make the Logo a link to the edit page
		echo '
		<tr class="nfpoblock">
			<td width="200">
				<a href="user-edit-campaign.php?id=';
				echo $id;
		echo '">
				<b>
				';
				$show = $i + 1;
				echo "Campaña #" . $show;
		// Show the LOGO
		echo '	</b></a>
			</td>
			<td width="100">
				<img src="';
				echo $logo; 
		echo '" height="75" width="75">
			</td>
			<td width="100">
			';
				echo $category;
		echo '
			</td>
			<td width="100">
			';
				echo "$" . $goal;
		echo '
			</td>
			<td width="100">
			';
				echo "$" . $collected;
		echo '
			</td>
			<td width="200">
			';
				echo $paypal;
		echo '
			</td>
			<td width="100">
			';
				echo $end;
		echo '
			</td>
		</tr>
		';

		$i++;
	}

?>

		  </tbody>
		  </center>
	  </table>
	  </div>

	  <!-- Column #2 (1/6 of page width) - Sub-Menu -->
	  <div class="w-col w-col-2">
	    <?php include 'includes/widgets/logged-in-menu.php'; ?>
	  </div>

	</div>
</div>

</section>