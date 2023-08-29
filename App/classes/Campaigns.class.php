<?php

class Campaigns extends Page
{
  
  //------------------------- Attributes -------------------------
  private $db = null;

  public $content = '';
  public $pageTitle = "Campaigns";
  public $title = "Donations Desk - Campaigns";
  public $keywords = "Donations Desk, campaigns";
  
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    $this->db = new Database();
    
    // Get the appropriate language
    if( $_SESSION['language'] == 'es' ) {
      $this->pageTitle = "Campañas";
    }
    else{
      $this->pageTitle = "Campaigns";
    }

    parent::__construct();
  }

  /**
   * campaign_count - Retrieve the amount of live campaigns
   * 
   * @param none
   * 
   * @return array
  */
  public function campaign_count(){
    return $this->db->query_DB("SELECT COUNT(`id`) AS count from `Campaigns` WHERE `end` > CURRENT_DATE")[0]['count'];
  }

  /**
   * campaign_count_by_category - Retrieve the amount of live campaigns in a specific category
   * 
   * @param none
   * 
   * @return array
  */
  public function campaign_count_search($string){
    return $this->db->query_DB("SELECT COUNT(`id`) AS count FROM `Campaigns` WHERE `info` LIKE '%" . $string . "%' AND `end` > CURRENT_DATE")[0]['count'];
  }

  /**
   * campaign_count_search - Retrieve the amount of live campaigns with a specific word in its info
   * 
   * @param none
   * 
   * @return array
  */
  public function campaign_count_by_category($category){
    return $this->db->query_DB("SELECT COUNT(`id`) AS count FROM `Campaigns` WHERE `category` = '$category' AND `end` > CURRENT_DATE")[0]['count'];
  }

  /**
   * campaign_display_all - Displays all of the campaigns that have not ended
   * 
   * @param none
   * 
   * @return array
  */
  public function campaign_display_all(){
    return $this->db->query_DB("SELECT `id`, `campaign-logo`,  `username`, `goal`, `donated`, `end`, `info`, `category`, `paypal` 
                                FROM `Campaigns` 
                                WHERE `end` > CURRENT_DATE 
                                ORDER BY `end` ASC");
  }

  /**
   * campaign_display_by_category - Displays all of the campaigns in a specific category that have not ended
   * 
   * @param none
   * 
   * @return array
  */
  public function campaign_display_by_category($category){
    return $this->db->query_DB("SELECT `id`, `campaign-logo`, `username`, `goal`, `donated`, `end`, `info`, `category`, `paypal` 
                                FROM `Campaigns` 
                                WHERE `category` = '$category' 
                                AND `end` > CURRENT_DATE 
                                ORDER BY `end` ASC");
  }

  /**
   * campaign_search - Retrieve the live campaigns with a specific word in its info
   * 
   * @param none
   * 
   * @return array
  */
  public function campaign_search($string){
    return $this->db->query_DB("SELECT `id`, `campaign-logo`,  `username`, `goal`, `donated`, `end`, `info`, `category`, `paypal` 
                                FROM `Campaigns` 
                                WHERE `info` LIKE '%" . $string . "%' 
                                AND `end` > CURRENT_DATE 
                                ORDER BY `end` ASC");
  }

  /**
   * Display - Displays the full page
   *
   * @param  mixed $filter
   *
   * @return void
   */
  public function Display()
  {
    // Set the Campaigns
    $this->content .= '
    <!-- The Campaigns Section -->
    <section>
      <!-- Is inside a container -->
      <div class="w-container">
        <!-- That has 1 row and 3 equally spaced columns (1/3 of page width each) -->
        <div class="w-row">
    ';

    $wcf = new WidgetCampaignsFilter();
    $this->content .= $wcf->Display() . '
        </div>
        <div class="w-row">
        ';
        
    // If page was just loaded (nothing was posted) OR SHOW ALL was selected AND nothing was searched
    if( empty($_POST) === true || ($_POST['update'] == "ALL" && empty($_POST['string']) ) )
      { // Display by name
        $result = $this->campaign_display_all();
        $num = $this->campaign_count();
      }
    // If page has posted
    else
    {
      // And a Search string was passed
      if(empty($_POST) === false && empty($_POST['string']) === false)
      {
        // Display the results of the search
        $string = $_POST['string'];
        $result = $this->campaign_search($string);
        $num = $this->campaign_count_search($string);
        // Show the results message
        $this->content .= $num . " result(s) for your search: '" . $string ."' <br>";
      }
      // If nothing was searched but sorting was applied
      else
      {
        // Sort accordingly
        $result = $this->campaign_display_by_category($_POST['update']);
        $num = $this->campaign_count_by_category($_POST['update']);
      }
    }

    $i = 0;
    // Go over every result and display on the table.
    while ($i < $num) 
    {
      // Get everything for the Campaign
      $id       = $result[$i]['id'];
      $logo     = $result[$i]['campaign-logo'];
      $username = $result[$i]['username'];
      $goal     = $result[$i]['goal'];
      $donated  = $result[$i]['donated'];
      $info     = $result[$i]['info'];
      // If info is too long, shorten it
      if( strlen($info) > 130){
        $info   = substr( $result[$i]['info'], 0, 130 ) . '...';
      }
      $end      = $result[$i]['end'];
      $category = $result[$i]['category'];
      $paypal   = $result[$i]['paypal'];

      $percent = (int) ( ($donated/$goal) * 100 );
      // Max percent is 100
      if($percent > 100)
      {
        $percent = 100;
      }
      // Scale multiplier
      $scale = 2;
      
      // If we are using Spanish
      if( $_SESSION['language'] == 'es' ) {
        $translation = array(
          '1' => 'Detalles:',
          '2' => 'Termina:',
          '3' => 'Categoría:',
        );
      }
      else{
        $translation = array(
          '1' => 'Details:',
          '2' => 'Ends:',
          '3' => 'Category:',
        );
      }

      // Insert a Campaign Block
      $this->content .= '<div class="w-col w-col-4 campaignblock" width="200" height="400" overflow="hidden"><center>';
      $this->content .= '<div class="w-row" style="height: 100px; margin-top: 5px;"><img src="' . $logo . '" width="100" height="100"></div>';
      $this->content .= '<div class="w-row" style="height: 80px; margin-top: 10px;"><b>' . $translation[1] . '</b><br>' . $info . '</div>';
      $this->content .= '<div class="w-row" style="height: 20px; margin-top: 5px;"><b>' . $translation[2] . '</b> ' . $end . '</div>';
      $this->content .= '<div class="w-row" style="height: 20px; margin-top: 5px;"><b>' . $translation[3] . '</b></div><div class="w-row">' . $category . '</div>';
      // The progress bar inside every block
      $this->content .= '
        <div class="w-row" style="height: 20px; margin-top: 10px;">  
          <div class="percentbar" align="left" style="width:200px;">
            <div class="percentage" align="left" style="width:
            ';
            $this->content .= $percent * $scale;
            $this->content .= 'px;">';
            $this->content .= '
            </div>
          </div>
        </div>
      ';
      // Display Amount
      $this->content .= '$' . $donated . '    /    $' . $goal . '     =    ' . $percent . '%<br>';
            
      $this->content .= '<br>
        <a href="donate.php?action=process&email=' . $paypal . '&type=Campaign&item_number=Campaign.' . $id . '">
          <img src="images/paypal-donate.png" alt="PayPal - The safer, easier way to pay online!"></a>
        ';
      $this->content .= '</center></div>';

      $i++;
    }

    $this->content .= '
      </div>

    </div>

    </section>';

    parent::Display();
  }

}

?>