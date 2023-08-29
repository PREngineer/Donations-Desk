<?php

class WidgetSocialMedia
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
    $this->content = '
    <!-- Sub-Column #2 - FB Share -->
    <div class="w-col w-col-4">
      
      <!-- FB share widget -->
      <div class="fb-like" data-href="' . curPageURL() . '" data-layout="button" data-action="like" data-show-faces="true" data-share="true">
      
      
    </div>

    <!-- Sub-Column #2 - Twitter Twit -->
    <div class="w-col">
      
      <!-- Twitter API connection and widget -->
      <div class="w-widget w-widget-twitter">
        <iframe src="https://platform.twitter.com/widgets/tweet_button.html#url=';

    $this->content .= curPageURL();
        
    $this->content .= '&amp;counturl=';

    $this->content .= curPageURL();

    $this->content .= '&amp;text=Check%20out%20this%20site&amp;count=none&amp;size=m&amp;dnt=true" scrolling="no" frameborder="0" allowtransparency="true"
        style="border: none; overflow: hidden; height: 20px;"></iframe>
      </div>

    </div>';

    return $this->content;
  }

}