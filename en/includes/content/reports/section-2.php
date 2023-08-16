<!-- The Actual List Section -->
<section class="nfp-list-section">
  <!-- Has one giant container -->
  <div class="w-container">

<!-- Drop down menu for sorting -->
	Choose report to generate: 
  	<form method="POST" enctype="form-data" action="">
		<select name="report">
			<option value="">-SELECT-</option>
		    <option value="N-Total" <?php if($_POST['report'] == 'N-Total'){echo 'selected="selected"';}?>>NFPO Totals</option>
		    <option value="C-Total" <?php if($_POST['report'] == 'C-Total'){echo 'selected="selected"';}?>>Campaign Totals</option>
		    <option value="N-Detail" <?php if($_POST['report'] == 'N-Detail'){echo 'selected="selected"';}?>>NFPO Detailed</option>
		    <option value="C-Detail" <?php if($_POST['report'] == 'C-Detail'){echo 'selected="selected"';}?>>Campaign Detailed</option>
		</select>
	Month:
		<select name="month">
			<option value="01" <?php if($_POST['month'] == '01'){echo 'selected="selected"';}?>>January</option>
			<option value="02" <?php if($_POST['month'] == '02'){echo 'selected="selected"';}?>>February</option>
			<option value="03" <?php if($_POST['month'] == '03'){echo 'selected="selected"';}?>>March</option>
			<option value="04" <?php if($_POST['month'] == '04'){echo 'selected="selected"';}?>>April</option>
			<option value="05" <?php if($_POST['month'] == '05'){echo 'selected="selected"';}?>>May</option>
			<option value="06" <?php if($_POST['month'] == '06'){echo 'selected="selected"';}?>>June</option>
			<option value="07" <?php if($_POST['month'] == '07'){echo 'selected="selected"';}?>>July</option>
			<option value="08" <?php if($_POST['month'] == '08'){echo 'selected="selected"';}?>>August</option>
			<option value="09" <?php if($_POST['month'] == '09'){echo 'selected="selected"';}?>>September</option>
			<option value="10" <?php if($_POST['month'] == '10'){echo 'selected="selected"';}?>>October</option>
			<option value="11" <?php if($_POST['month'] == '11'){echo 'selected="selected"';}?>>November</option>
			<option value="12" <?php if($_POST['month'] == '12'){echo 'selected="selected"';}?>>December</option>
		</select>
	Year:
		<input type="text" name="year" maxlength="4" size="4" placerholder="YYYY" value="<?php echo $_POST['year'];?>">
	<!-- GO! button -->
	<input type="submit" value="Go!">
	</form>

	<hr>
	<br>

<?php

	if($_POST['report'] == 'N-Total')
	{
		include 'includes/content/reports/n-total.php';
	}
	if($_POST['report'] == 'C-Total')
	{
		include 'includes/content/reports/c-total.php';
	}
	if($_POST['report'] == 'N-Detail')
	{
		include 'includes/content/reports/n-detail.php';
	}
	if($_POST['report'] == 'C-Detail')
	{
		include 'includes/content/reports/c-detail.php';
	}

?>

  </div>
</section>