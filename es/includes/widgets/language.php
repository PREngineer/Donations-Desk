<center>

<?php
// Get the current page
$URL = curPageURL();

// Replace Spanish for English
$URL = str_replace('/es/', '/en/', $URL);

?>

<a href="<?php echo $URL; ?>">
	<img src="/donationsdesk/images/en.png" alt="Cambiar a Inglés" height="50" width="50">
</a>
</center>