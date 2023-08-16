<!-- Include connection to DB and other services for every page-->
<?php include 'core/init.php'; ?>

<head>

  <!-- DEVELOPER INFORMATION 
  
  Website Design & Implementation by Jorge Pabon from WebJMPS (Joined Multi-Portability Solutions)
  Contact Us at: webjmps@outlook.com or pianistapr@hotmail.com

  -->

  <!-- Site METADATA -->

  <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
  <title>Donations Desk</title>
  <meta name="description" content="This website helps participating Non-For Profit Organizations to get funding.">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="Webflow">

  <!-- FACEBOOK METADATA -->
  <div id="fb-root"></div>

  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  
  <!-- ESTABLISH WHOSE FACEBOOK ACCOUNT IS GOING TO BE AN ADMIN (WHO CAN MODERATE COMMENTS) Make multiple entries for multiple admins.-->
  <?php

  $admins = mysql_query("SELECT * FROM FBAdmins");

  $i = 0;

  while( $i < mysql_num_rows($admins) )
  {
    $name = mysql_result($admins, $i);
    echo '
    <meta property="fb:admins" content="'.$name.'"/>
    ';
    $i++;
  }

  ?>
  <!-- END OF FACEBOOK METADATA -->


  <!-- Site CSS Stylesheets -->

  <link rel="stylesheet" type="text/css" href="css/normalize.css">
  <link rel="stylesheet" type="text/css" href="css/webflow.css">
  <link rel="stylesheet" type="text/css" href="css/donations-desk.webflow.css">

  <!-- Site Scripts used -->

  <script type-"text/javascript" src="js/webfont.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Great Vibes:400","Droid Sans:400,700"]
      }
    });
  </script>
  <script type="text/javascript" src="js/modernizr.js"></script>

  <!-- Site FAV Icon (if any)

  <link rel="shortcut icon" type="image/x-icon" href="https://daks2k3a4ib2z.cloudfront.net/placeholder/favicon.ico">

  -->

  <!-- IMAGE SLIDER STUFF -->
  <link href="/donationsdesk/image-slider/js-image-slider.css" rel="stylesheet" type="text/css" />
  <script src="/donationsdesk/image-slider/js-image-slider.js" type="text/javascript"></script>
  <!-- IMAGE SLIDER STUFF -->

</head>