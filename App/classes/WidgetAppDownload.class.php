<?php

class WidgetAppDownload
{
  
  //------------------------- Attributes -------------------------
  public $content = "";
  
  //------------------------- Operations -------------------------
  
  /**
   * __construct
   *
   * @return void
   */
  public function __construct()
  {

  }

  /**
   * Display - Shows the actual widget
   *
   * @return void
   */
  public function Display()
  {
    $this->content = '<a href="#"><img src="images/android-app.png"></a>';

    return $this->content;
  }
}

?>