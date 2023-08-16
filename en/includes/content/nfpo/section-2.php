<!-- The Actual List Section -->
<section class="nfp-list-section">
  <!-- Has one giant container -->
  <div class="w-container">

<!-- Drop down menu for sorting -->
	Sort by: 
  	<form method="POST" enctype="form-data" action="non-for-profit-organizations.php">
		<select name="sort-by">
		    <option value="organization-name">Organization Name</option>
		    <option value="municipality">Municipality</option>
		    <option value="category">Category</option>
		    <option value="inc-date">Incorporation Date</option>
		    <option value="target">Target Population</option>
		    <option value="impact">Population Impact</option>
		    <option value="foundations">Foundations</option>
		    <option value="rating">Rating</option>
		</select>
		<!-- Search box -->
		OR Search by Organization Name:
		<input type="text" placeholder="Search for..." name="string" value="">
	<!-- GO! button -->
	<input type="submit" value="Go!">
	</form>

	<br>

  	<!-- Table Displaying all NFPOs-->
  	<table>
	  <tbody>
		<center>
	
		  	<tr>
				<td width="300">
				<b>Org. Name</b>
				</td>
				<td width="100">
				<b>Logo</b>
				</td>
				<td width="100">
				<b>Municipality</b>
				</td>
				<td width="100">
				<b>Category</b>
				</td>
				<td width="100">
				<b>Inc. Date</b>
				</td>
				<td width="100">
				<b>Target Population</b>
				</td>
				<td width="100">
				<b>Population Impact</b>
				</td>
				<td width="100">
				<b>Supporters</b>
				</td>
				<td width="100">
				<b>Rating</b>
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

<?php
	// If page was just loaded (nothing was posted)
	if(empty($_POST) === true)
	{	// Display by name
		$result = nfpo_display_all('organization-name');
		$num = nfpo_count();
	}
	// If page has posted
	else
	{
		// And a Search string was passed
		if(empty($_POST) === false && empty($_POST['string']) === false)
		{
			// Display the results of the search
			$string = mysql_real_escape_string($_POST['string']);
			$result = nfpo_search($string);
			$num = nfpo_search_count($string);
			// Show the results message
			echo $num . " result(s) for your search: '" . $string ."'";
		}
		// If nothing was searched but sorting was applied
		else
			{
				// Sort accordingly
				$result = nfpo_display_all($_POST['sort-by']);
				$num = nfpo_count();
			}
	}

	$i = 0;
	// Go over every result and display on the table.
	while ($i < $num) 
	{
		$id = mysql_result($result,$i,"id");
		$field1 = mysql_result($result,$i,"organization-name");
		$field2 = mysql_result($result,$i,"logo");
		$field3 = mysql_result($result,$i,"municipality");
		$field4 = mysql_result($result,$i,"category");
		$field5 = mysql_result($result,$i,"inc-date");
		$field6 = mysql_result($result,$i,"target");
		$field7 = mysql_result($result,$i,"impact");
		$field8 = mysql_result($result,$i,"foundations");
		$field9 = mysql_result($result,$i,"rating");
		// Make the Name a link to the details page
		echo '
		<tr class="nfpoblock">
			<td width="250">
				<a href="nfpo-details.php?id=';
				echo $id;
		echo '">
				<b>
				';
				echo $field1;
		// Show the LOGO
		echo '	</b></a>
			</td>
			<td width="100">
				<img src="';
				echo $field2; 
		echo '" height="75" width="75">
			</td>
			<td width="100">
			';
				echo $field3;
		echo '
			</td>
			<td width="100">
			';
				echo $field4;
		echo '
			</td>
			<td width="100">
			';
				echo $field5;
		echo '
			</td>
			<td width="100">
			';
				echo $field6;
		echo '
			</td>
			<td width="100">
			';
				echo $field7;
		echo '
			</td>
			<td width="100">
			';
				echo $field8;
		echo '
			</td>
			<td width="100">
			';
				echo $field9;
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
</section>