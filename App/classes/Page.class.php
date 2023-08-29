<?php

class Page
{
  
  //------------------------- Attributes -------------------------
  public $content = "<h1>This page was not instantiated correctly.</h1>";
  public $pageTitle = "Page";
  public $title = "Donations Desk";
  public $keywords = "Donations Desk";
  public $NavBar = null;
  private $db = null;
  
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    $this->NavBar = new PageNavBar();
    $this->db = new Database();
  }

  /**
   * Set - Used to setup the attributes of this class
   *
   * @param  mixed $name
   * @param  mixed $value
   *
   * @return void
   */
  public function Set($name, $value)
  {
    $this->$name = $value;
  }

  /**
   * Display - Shows the actual page
   *
   * @return void
   */
  public function Display()
  {

    echo '<!DOCTYPE html>
    
    <html lang="en">
    
    <!-- ******************* Header Section ******************* -->
    
    <head>

      <!-- DEVELOPER INFORMATION 
      
      Website Design & Implementation by Jorge Pabón.  A WebJMPS (Joined Multi-Portability Solutions) member.
      Contact at: pianistapr@hotmail.com

      -->

      <!-- Site METADATA -->

      <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
      <title>' . $this->title . '</title>
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
      }(document, \'script\', \'facebook-jssdk\'));</script>
      
      <!-- ESTABLISH WHOSE FACEBOOK ACCOUNT IS GOING TO BE AN ADMIN (WHO CAN MODERATE COMMENTS) Make multiple entries for multiple admins.-->';
      
      $admins = $this->db->query_DB("SELECT * FROM FBAdmins");

      $i = 0;
      while( $i < sizeof($admins) )
      {
        $name = $admins[$i]['name'];
        echo '
        <meta property="fb:admins" content="' . $name . '"/>
        ';
        $i++;
      }

      echo '
      <!-- END OF FACEBOOK METADATA -->


      <!-- Site CSS Stylesheets -->

      <link rel="stylesheet" type="text/css" href="theme/css/normalize.css">
      <link rel="stylesheet" type="text/css" href="theme/css/webflow.css">
      <link rel="stylesheet" type="text/css" href="theme/css/donations-desk.webflow.css">

      <!-- Site Scripts used -->
      <script type-"text/javascript" src="theme/js/jquery.min.js"></script>
      <script type-"text/javascript" src="theme/js/placeholders.min.js"></script>
      <script type-"text/javascript" src="theme/js/webfont.js"></script>
      <script>
        WebFont.load({
          google: {
            families: ["Great Vibes:400","Droid Sans:400,700"]
          }
        });
      </script>
      <script type="text/javascript" src="theme/js/modernizr.js"></script>

      <!-- IMAGE SLIDER -->
      <link href="lib/image-slider/js-image-slider.css" rel="stylesheet" type="text/css" />
      <script src="lib/image-slider/js-image-slider.js" type="text/javascript"></script>
      <!-- IMAGE SLIDER -->

    </head>
    
    <body>';
    
    echo $this->NavBar->Display();
    
    echo '
      <!-- ******************* Content Section ******************* -->
      <div class="container" id="Content">
      <!-- Title Section -->
      
        <!-- Is inside a container -->
        <div class="w-container">
          <!-- That has 1 row with 3 columns-->
          <div class="w-row title-section">
            
            <!-- Column #1 - 1/4 of the page width -->
            <div class="w-col w-col-3">';
      
      $wad = new WidgetAppDownload();
      echo $wad->Display();
      
      echo '
            </div>
      
            <!-- Column #2 - 1/2 of the page width -->
            <div class="w-col w-col-6">
              <!-- Page Title -->
              <h1>' . $this->pageTitle . '</h1>

              <!-- Site Stats -->';
      $wac = new WidgetActiveCounter();
      echo $wac->Display();
      
      echo '
            </div>
      
            <!-- Column #3 - 1/4 of the page width -->
            <div class="w-col w-col-3">
              <!-- Language Selector -->';

      $wlc = new WidgetLanguageChange();
      echo $wlc->Display();

      echo '
            </div>
      
          </div>
      
        </div>
        
      
      ';

    echo $this->content;
    
    echo '
      </div>

      <!-- ******************* Footer Section ******************* -->
      <footer>
        <!-- Is inside a container -->
        <div class="w-container">
          <!-- With 1 row that has 3 columns-->
          <div class="w-row footer-section">

            <!-- COLOR BARS AT THE BOTTOM OF THE HEADER -->
            <!-- wraps each bar -->
            <div id="footer-bar-wrapper"> 
            <!-- bars from left to right -->
            <div id="orange-bar"><br/></div>
            <div id="green-bar"><br/></div>
            <div id="gray-bar"><br/></div>
            <div id="orange-bar"><br/></div>
            </div>
            <!-- END OF COLOR BARS AT THE BOTTOM OF THE HEADER -->

            <!-- Column #1 (1/4 of page width) -->
            <div class="w-col w-col-3">
            </div>
            
            <!-- Column #2 (1/2 of page width) -->
            <div class="w-col w-col-6">
              <!-- Copyright Info -->
              <div class="copyright">Donations Desk<br>&#169; Copyright 2014';
      
    if(date('Y') > 2014)
    {
      echo ' - ' . date('Y');
    }
    
    echo '
                <br><a href="https://afc.pr">Asesores Financieros Comunitarios</a></div>
            </div>

            <!-- Column #3 (1/4 of page width) - Social Media Links -->
            <div class="w-col w-col-3">
              <!-- Has one inner row with 3 columns equally spaced -->
              <div class="w-row">';

    $wsm = new WidgetSocialMedia();
    echo $wsm->Display();

    echo '
              </div>

            </div>

          </div>

        </div>
      </footer>

    </body>
    
    </html>';
  }

}

?>