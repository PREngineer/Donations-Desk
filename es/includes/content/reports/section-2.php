<!-- The Actual List Section -->
<section class="nfp-list-section">
  <!-- Has one giant container -->
  <div class="w-container">

<!-- Drop down menu for sorting -->
	Escoja el reporte a generar: 
  	<form method="POST" enctype="form-data" action="">
		<select name="report">
			<option value="">-SELECCIONE-</option>
		    <option value="N-Total" <?php if($_POST['report'] == 'N-Total'){echo 'selected="selected"';}?>>Totales de OSFL</option>
		    <option value="C-Total" <?php if($_POST['report'] == 'C-Total'){echo 'selected="selected"';}?>>Totales de Campañas</option>
		    <option value="N-Detail" <?php if($_POST['report'] == 'N-Detail'){echo 'selected="selected"';}?>>Detallado de OSFL</option>
		    <option value="C-Detail" <?php if($_POST['report'] == 'C-Detail'){echo 'selected="selected"';}?>>Detallado de Campañas</option>
		</select>
	Mes:
		<select name="month">
			<option value="01" <?php if($_POST['month'] == '01'){echo 'selected="selected"';}?>>Enero</option>
			<option value="02" <?php if($_POST['month'] == '02'){echo 'selected="selected"';}?>>Febrero</option>
			<option value="03" <?php if($_POST['month'] == '03'){echo 'selected="selected"';}?>>Marzo</option>
			<option value="04" <?php if($_POST['month'] == '04'){echo 'selected="selected"';}?>>Abril</option>
			<option value="05" <?php if($_POST['month'] == '05'){echo 'selected="selected"';}?>>Mayo</option>
			<option value="06" <?php if($_POST['month'] == '06'){echo 'selected="selected"';}?>>Junio</option>
			<option value="07" <?php if($_POST['month'] == '07'){echo 'selected="selected"';}?>>Julio</option>
			<option value="08" <?php if($_POST['month'] == '08'){echo 'selected="selected"';}?>>Agosto</option>
			<option value="09" <?php if($_POST['month'] == '09'){echo 'selected="selected"';}?>>Septiembre</option>
			<option value="10" <?php if($_POST['month'] == '10'){echo 'selected="selected"';}?>>Octubre</option>
			<option value="11" <?php if($_POST['month'] == '11'){echo 'selected="selected"';}?>>Noviembre</option>
			<option value="12" <?php if($_POST['month'] == '12'){echo 'selected="selected"';}?>>Deciembre</option>
		</select>
	Año:
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