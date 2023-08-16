<?php
  // Need to know if the s goes or not
  $nfpo = nfpo_count();
  $camp = campaign_count();
  // If more than 2, put the s at the end
  $suffix1 = ($nfpo != 1) ? 's' : '';
  $suffix2 = ($camp != 1) ? 's' : '';
?>

<center>
  We currently have:
  <?php echo $nfpo; ?> active NFPO<?php echo $suffix1; ?>  & 
  <?php echo $camp; ?> Running Campaign<?php echo $suffix2; ?>!
</center>