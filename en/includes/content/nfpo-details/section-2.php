<?php

// Get the id for the Organization from the link
$id = (int)$_GET['id'];

// Get the Details for the requested NFPO
$nfpodetails = nfpo_details($id);

$values = mysql_fetch_assoc( mysql_query("SELECT COUNT(`r1`) as total, SUM(`r1`) as r1, SUM(`r2`) as r2, SUM(`r3`) as r3, 
                                          SUM(`r4`) as r4, SUM(`r5`) as r5, SUM(`r6`) as r6, SUM(`r7`) as r7 
                                          FROM `ratings` WHERE `id` = ".$id) );
$total = $values['total'] * 5;
$r1 = round( ( ($values['r1'] / $total) * 5), 0);
$r2 = round( ( ($values['r2'] / $total) * 5), 0);
$r3 = round( ( ($values['r3'] / $total) * 5), 0);
$r4 = round( ( ($values['r4'] / $total) * 5), 0);
$r5 = round( ( ($values['r5'] / $total) * 5), 0);
$r6 = round( ( ($values['r6'] / $total) * 5), 0);
$r7 = round( ( ($values['r7'] / $total) * 5), 0);

?>

<section>
<!-- Has one giant container -->

<!-- Table Displaying all NFPO Info-->
<div class="w-container">

<table align="center" style="width:100%">
<form class="login-form">
<tbody>

	<tr><!-- Logo, Name & Incorporation Date -->
      <td colspan="2" align="center" class="block">
        <!-- Logo Image -->
        <img src="<?php echo $nfpodetails['logo'];?>" height="250"><br>
        <!-- Organization Name -->
        <?php echo $nfpodetails['organization-name'];?><br>
        <!-- Incorporation Date -->
        Founded: <?php echo $nfpodetails['inc-date'];?><br>
        
        <table class="block" style="width:200px">
          <th colspan="2">
            Visitor Ratings | <a href="rate.php?id=<?php echo $_GET['id'];?>">Rate!</a>
          </th>

          <tr>
            <td>
              Atmosphere
            </td>
            <td>
              <?php
                $i=0;
                while($i < $r1)
                {
                  echo '<img src="../images/star.ico" width="15" height="15">';
                  $i++;
                }
              ?>
            </td>
          </tr>

          <tr>
            <td>
              Attention
            </td>
            <td>
              <?php
                $i=0;
                while($i < $r2)
                {
                  echo '<img src="../images/star.ico" width="15" height="15">';
                  $i++;
                }
              ?>
            </td>
          </tr>
          
          <tr>
            <td>
              Cost
            </td>
            <td>
              <?php
                $i=0;
                while($i < $r3)
                {
                  echo '<img src="../images/star.ico" width="15" height="15">';
                  $i++;
                }
              ?>
            </td>
          </tr>
          
          <tr>
            <td>
              Location
            </td>
            <td>
              <?php
                $i=0;
                while($i < $r4)
                {
                  echo '<img src="../images/star.ico" width="15" height="15">';
                  $i++;
                }
              ?>
            </td>
          </tr>
          
          <tr>
            <td>
              Organization
            </td>
            <td>
              <?php
                $i=0;
                while($i < $r5)
                {
                  echo '<img src="../images/star.ico" width="15" height="15">';
                  $i++;
                }
              ?>
            </td>
          </tr>
          
          <tr>
            <td>
              Quality of Service
            </td>
            <td>
              <?php
                $i=0;
                while($i < $r6)
                {
                  echo '<img src="../images/star.ico" width="15" height="15">';
                  $i++;
                }
              ?>
            </td>
          </tr>
          
          <tr>
            <td>
              Quickness
            </td>
            <td>
              <?php
                $i=0;
                while($i < $r7)
                {
                  echo '<img src="../images/star.ico" width="15" height="15">';
                  $i++;
                }
              ?>
            </td>
          </tr>
        </table>
        
      </td>
	</tr>

  <tr><!-- SOCIAL MEDIA BUTTONS - Show them if provided-->
      <td align="center" class="block">
        Share this page:
        <!-- FB Like Page -->
        <div class="fb-like" data-href="<?php echo curPageURL(); ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>&nbsp;&nbsp;&nbsp;&nbsp;
        <!-- Twitter API connection and widget -->
        <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo curPageURL(); ?>" data-text="Check out this Organization">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <!-- G+ API connection and widget -->
        <div class="g-plusone" data-href="<?php echo curPageURL(); ?>" data-size="tall" data-annotation="none" data-width="120" data-recommendations="false" id="___plusone_34" style="width: 50px; height: 24px; text-indent: 0px; margin: 0px; padding: 0px; background-color: transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; background-position: initial initial; background-repeat: initial initial;"></div>
      </td>
        
      <td align="center" class="block">
        Share ours:
        <!-- FB Like Page -->
        <div class="fb-like" data-href="<?php echo $nfpodetails['facebook']; ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>&nbsp;&nbsp;&nbsp;&nbsp;
        <!-- Twitter API connection and widget -->
        <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $nfpodetails['twitter']; ?>" data-text="Check out this Organization">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <!-- G+ API connection and widget -->
        <div class="g-plusone" data-href="<?php echo $nfpodetails['google']; ?>" data-size="tall" data-annotation="none" data-width="120" data-recommendations="false" id="___plusone_34" style="width: 50px; height: 24px; text-indent: 0px; margin: 0px; padding: 0px; background-color: transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; background-position: initial initial; background-repeat: initial initial;"></div>

        <br>
        
        <!-- Youtube and Website links -->
        <a href="<?php echo $nfpodetails['youtube'];?>"><img src="../images/youtube.png" width="100" height="50"></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <!-- Website Link -->
        <a href="<?php echo $nfpodetails['website'];?>"><img src="../images/website.png" width="50" height="50"></a>
      </td>
  </tr>

	<tr> <!-- DONATION INFORMATION -->
      <td colspan="2" align="center" class="block">
        <h2><center>Where to Donate</h2>
        <p>You can donate using PayPal or at the Bank Specified.</center></p>
      </td>
  	</tr>

    <tr>    	
      <td class="block" align="center">
      	<!-- PayPal Button -->
      	<?php
      	if($nfpodetails['paypal'] == NULL)
      	{ 
      		echo '<img src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">';
          echo '<br>Not available for this Organization yet.';
    		}
    		else
    		{
          echo '
          <a href="pp-processing/paypal.php?email=' . $nfpodetails['paypal'] . '&type=NFPO&item_number=NFPO.' . $_GET['id'] . '">
            <img src="../images/paypal-donate.png" alt="PayPal - The safer, easier way to pay online!">
          </a>
          ';
    		}
		?>
	   </td>

	  <td class="block" align="center">
	  	
	  	Bank Account:<br>
        
        <?php 
        if($nfpodetails['bank-account'] == NULL)
        {
        	echo 'Not Available for this Organization.';
	    }
	    else
	    {
	    	echo $nfpodetails['bank-account'];
		}
        ?>
    	
      </td>
  	</tr>

	<tr>
      <td colspan="2" align="center" class="block">
        <h2><center>Contact Person</h2>
        <p>You can contact this person to answer any questions regarding the Organization.</center></p>
      </td>
    </tr>

    <tr>
      <td class="block" align="center">
        Name: <?php echo $nfpodetails['contact-first'];?> <?php echo $nfpodetails['contact-last'];?><br>
        Telephone: <?php echo $nfpodetails['phone'];?><br>
        E-mail: <a href="mailto:<?php echo $nfpodetails['contact-email'];?>"><?php echo $nfpodetails['contact-email'];?></a>
      </td>
      
      <td class="block" align="center">
      	Write to us at:<br>
      	<?php echo $nfpodetails['postal-address'];?><br>
      	<?php echo $nfpodetails['municipality'];?>, PR <?php echo $nfpodetails['zip'];?>
      </td>
  	</tr>
	
	<tr>
      <td colspan="2" align="center" class="block">
        <h2><center>About Our Organization</center></h2>
      </td>
    </tr>

    <tr>
      <td class="block" align="center">
      	We are Categorized as a/an: <br>
        <?php echo $nfpodetails['category'];?> Organization
      </td>

      <td class="block" align="center">

      	We provide the following services:<br>
      	<?php echo $nfpodetails['services'];?><br>
      	And we serve <?php echo $nfpodetails['impact'];?> <?php echo $nfpodetails['target'];?><br>
      </td>
  	</tr>

    <tr>
      <td colspan="2" align="center" class="block">
        We comply with the standards and receive support from the following Foundations:<br>
        
        <?php 
        
        // Display Foundation logos
        $fundaciones = explode(",", $nfpodetails['foundations']);
        // If has Popular
        if(in_array('Fundación Banco Popular', $fundaciones))
        {
          echo '<img src="../badges/BP.png">&nbsp;&nbsp;';
        }
        // If has Fondos Unidos
        if(in_array('Fondos Unidos', $fundaciones))
        {
          echo '<img src="../badges/FU.png">&nbsp;&nbsp;';
        }
        // If has Angel Ramos
        if(in_array('Fundación Angel Ramos', $fundaciones))
        {
          echo '<img src="../badges/AR.png">&nbsp;&nbsp;';
        }
        if( strlen($nfpodetails['foundations']) < 0 )
        {
          echo 'None registered.';
        }
        
        ?>

      </td>
    </tr>

	<tr>
      <td colspan="2" align="center" class="block">
        <h2><center>Our Purpose</center></h2>
      </td>
    </tr>

    <tr>
      <td class="block" align="center">
        Our Mission:<br>
        <?php echo $nfpodetails['mission'];?><br>
      </td>

	  <td class="block" align="center">
        Our Vision:<br>
        <?php echo $nfpodetails['vision'];?><br>
      </td>
    </tr>

    <tr>
      <td colspan="2" class="block" align="center">
        Our Long Term Projections:<br>
        <?php echo $nfpodetails['projections'];?><br>
      </td>

      <td>
      	<p>  </p>
      </td>
  	</tr>

	<tr>
      <td colspan="2" align="center" class="block">
        <h2>Official Documentation</h2>
        <p>This documentation proves that the organization is legally well established.  
        	Also, this provides public record of its finances and management.</p>
      </td>
    </tr>

    <tr>
      <td class="block" align="center">
        Employee Social Security Number: <?php echo $nfpodetails['essn'];?><br>
        <br>
        <a href="<?php echo $nfpodetails['good-standing'];?>">Good Standing Document</a><br>

        <br>
        <a href="<?php echo $nfpodetails['state-inscription'];?>">Dpt. Of State Inscription</a><br>

        <br>
        <a href="<?php echo $nfpodetails['990'];?>">990 Federal Financial Statement</a><br>
      </td>

      <td class="block" align="center">
        <a href="<?php echo $nfpodetails['audit'];?>">Audit</a><br>

        <br>
        <a href="<?php echo $nfpodetails['state-exemption'];?>">State Exemption</a><br>

        <br>
        <a href="<?php echo $nfpodetails['federal-exemption'];?>">Federal Exemption</a>
      </td>
  	</tr>

	<tr>
      <td colspan="2" align="center" class="block">
        <h2>Our Location and Facilities</h2>
      </td>
    </tr>

    <tr>
      <td colspan="2" class="block" align="center">
        Our Physical Address:<br>
        <?php echo $nfpodetails['physical-address'];?><br>
        <?php echo $nfpodetails['municipality'];?>, PR <?php echo $nfpodetails['zip'];?>
      </td>

      <td>
      	<p>  </p>
      </td>
    </tr>

	<tr>
      <td colspan="2" class="block" align="center">
      	<!-- IMAGE SLIDER -->
        <div class="banner">
        <div id="sliderFrame">
                <div id="slider">
                  <img src="<?php echo $nfpodetails['pic1'];?>" width="600" height="400" alt="Our Facilities" />
                  <img src="<?php echo $nfpodetails['pic2'];?>" width="600" height="400" alt="Our Facilities" />
                  <img src="<?php echo $nfpodetails['pic3'];?>" width="600" height="400" alt="Our Facilities" />
                </div>
                <div id="htmlcaption" style="display: none;">
                    <em>Our facilities</em>
                </div>
            </div>
        </div>
        <!-- IMAGE SLIDER -->
      </td>
	</tr>

  <tr>
    <td colspan="2" class="block" align="center">
      <!-- Google Maps Addon -->
      <?php
        if($nfpodetails['gps'] == NULL)
        {
        }
        else
        {
          echo '
          <center>Google Maps:<br>
              <iframe height="400" width="700" style="border: 0px solid #000000"
               src="http://maps.google.com/?q=';
               echo $nfpodetails["gps"];
               echo '&z=16&output=embed&hl=en&t=h"></iframe>
            </center>
            ';
          }
      ?>
    </td>
  </tr>  

</tbody>
</form>
</table>
</div>

<br>

<!-- FACEBOOK COMMENTS -->
<?php $URL = curPageURL(); ?>
<center>
<div class="fb-comments" align="center" data-href="<?php echo $URL;?>" data-numposts="10" data-colorscheme="light"></div>
</center>


</section>