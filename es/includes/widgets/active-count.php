<?php
  // Need to know if the s goes or not
  $nfpo = nfpo_count();
  $camp = campaign_count();
  // If more than 2, put the s at the end
  $suffix1 = ($nfpo != 1) ? 's' : '';
  $suffix2 = ($camp != 1) ? 's' : '';
?>

<center>
  Al momento tenemos:
  <?php echo $nfpo; ?> OSFL activa<?php echo $suffix1; ?>  y 
  <?php echo $camp; ?> Campaña<?php echo $suffix2; ?> corriendo!
</center>