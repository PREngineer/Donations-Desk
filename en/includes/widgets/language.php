<center>

<?php
// Get the current page
$URL = curPageURL();

// Replace Spanish for English
$URL = str_replace('/en/', '/es/', $URL);

?>

<a href="<?php echo $URL; ?>">
	<img src="/donationsdesk/images/es.png" alt="Cambiar a Español" height="50" width="50">
</a>
</center>