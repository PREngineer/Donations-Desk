<!-- The Actual List Section -->
<section class="nfp-list-section">
  <!-- Has one giant container -->
  <div class="w-container">

<!-- Drop down menu for sorting -->
	FB Api Admins: 
  	<form method="POST" enctype="form-data" action="">
		<select name="choose">
			<option value="">-SELECT-</option>
		    <option value="Add">Add</option>
		    <option value="Remove">Remove</option>
		</select>

		<input type="text" name="string" maxlength="200" size="15" placeholder="Facebook ID">
		<!-- GO! button -->
		<input type="submit" value="Go!">
	</form>

	<hr>
	<br>

<?php

$error = '';

if( !empty($_POST) )
{
	if($_POST['choose'] == '')
	{
		$error .= 'Choose what to do.<br>';
	}
	else
	{
		if($_POST['string'] == '')
		{
			$error .= 'Add/Remove value is empty.<br>';
		}
		else
		{
			if( $_POST['choose'] == 'Remove' && mysql_result(mysql_query("SELECT COUNT(`admin`) 
																	FROM `FBAdmins` 
																WHERE `admin` = '".$_POST['string']."'"), 0) < 1 )
			{
				$error .= 'Such entry does not exist.<br>';
			}

			if( $_POST['choose'] == 'Add' && mysql_result(mysql_query("SELECT COUNT(`admin`) 
																	FROM `FBAdmins` 
																WHERE `admin` = '".$_POST['string']."'"), 0) > 0 )
			{
				$error .= 'Such entry already exists.<br>';
			}
		}
	}
}

if( !empty($_POST) && empty($error) )
{
	if($_POST['choose'] == 'Add')
	{
		echo 'Successfully inserted: '.$_POST['string'].'<br>';
		mysql_query("INSERT INTO `FBAdmins` (`admin`) VALUES ('".$_POST['string']."')");
	}
	if($_POST['choose'] == 'Remove')
	{
		echo 'Successfully removed: '.$_POST['string'].'<br>';
		mysql_query("DELETE FROM `FBAdmins` WHERE `admin` = '".$_POST['string']."'");
	}
}

if($error != '')
{
	echo '
	<font color="red">
	ERROR!:<br>'.$error.'
	</font><br>
	';
}


$i = 0;

$all = mysql_query("SELECT * FROM `FBAdmins`");

echo '
<table>';

while ($i < mysql_num_rows($all))
{
	$result = mysql_result($all, $i);
	echo '
	<tr>
		<td>
			#'.($i+1).'
		</td>
		<td>
			'.$result.'
		</td>
	</tr>';
	$i++;
}
	
echo '
</table>
';

?>

  </div>
</section>