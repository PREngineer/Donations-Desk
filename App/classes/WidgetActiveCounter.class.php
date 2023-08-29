<?php

class WidgetActiveCounter
{
  
  //------------------------- Attributes -------------------------
  public $content = "";
  private $db = null;
  
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {
    $this->db = new Database();
  }

  /**
   * campaign_count - Retrieve the amount of live Campaigns in the system
   * 
   * @param none
   * 
   * @return array
  */
  public function campaign_count(){
    return $this->db->query_DB("SELECT COUNT(`id`) AS count FROM `Campaigns` WHERE `end` > CURRENT_DATE")[0]['count'];
  }
  
  /**
   * nfpo_count - Retrieve the amount of live NFPOs in the system
   * 
   * @param none
   * 
   * @return array
  */
  public function nfpo_count(){
    return $this->db->query_DB("SELECT COUNT(`id`) AS count FROM `OSFL` WHERE `active` = 1")[0]['count'];
  }

  /**
   * Display - Shows the actual widget
   *
   * @return void
   */
  public function Display()
  {
    // Need to know if the s goes or not
    $nfpo = $this->nfpo_count();
    $camp = $this->campaign_count();

    // If more than 2, put the s at the end
    $suffix1 = ($nfpo != 1) ? 's' : '';
    $suffix2 = ($camp != 1) ? 's' : '';

    // Get the appropriate language
    if( $_SESSION['language'] == 'es' ) {
      $this->content = '
      <center>
        Actualmente tenemos ' . $nfpo . ' OSFL y ' . $camp . ' Campaña' . $suffix2 . ' activa' . $suffix2 . '!
      </center>
      ';
    }
    else{
      $this->content = '
      <center>
        We currently have ' . $nfpo . ' active NFPO & ' . $camp . ' running Campaign' . $suffix2 . '!
      </center>
      ';
    }

    return $this->content;
  }
}

?>