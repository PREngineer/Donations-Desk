<?php

class NFPOs extends Page
{
  
  //------------------------- Attributes -------------------------
  private $db = null;

  public $content = '';
  public $pageTitle = "Non For Profit Organizations";
  public $title = "Donations Desk - Non For Profit Organizations";
  public $keywords = "Donations Desk, Non For Profit Organizations";
  
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
      $this->pageTitle = "Organizaciones Sin Fines de Lucro";
    }
    else{
      $this->pageTitle = "Non For Profit Organizations";
    }

    parent::__construct();
  }

  /**
   * nfpo_display_all - Returns the information of all active NFPOs in the system.
   */
  public function nfpo_display_all( $sortby ){
    return $this->db->query_DB("SELECT `id`, `organization-name`, `logo`, `municipality`, `category`, `inc-date`, `target`, `impact`, `foundations`, `rating` 
                                FROM `OSFL` 
                                WHERE `active` = 1 
                                ORDER BY `$sortby` ASC, `organization-name` ASC");
  }

  /**
   * nfpo_count - Returns the amount of NFPOs in the system.
   */
  public function nfpo_count(){
    return $this->db->query_DB("SELECT COUNT(`id`) AS count
                                FROM `OSFL` 
                                WHERE `active` = 1")[0]['count'];
  }

  /**
   * nfpo_search - Returns all of the active NFPOs whose name match a search term.
   */
  public function nfpo_search( $string ){
    return $this->db->query_DB("SELECT `id`, `organization-name`, `logo`, `municipality`, `category`, `inc-date`, `target`, `impact`, `foundations`, `rating` 
                                FROM `OSFL` 
                                WHERE `organization-name` LIKE '%" . $string . "%' AND `active` = 1");
  }

  /**
   * nfpo_search_count - Returns the count of all the active NFPOs that match the search criteria.
   */
  public function nfpo_search_count( $search ){
    return $this->db->query_DB("SELECT count(`id`) AS count
                                FROM `OSFL` 
                                WHERE `organization-name` 
                                LIKE '%" . $search . "%' AND `active` = 1")[0]['count'];
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
    // If page was just loaded (nothing was posted)
    if( empty($_POST) )
    {	
      // Display by name
      $result = $this->nfpo_display_all( 'organization-name' );
      $num = $this->nfpo_count();
    }
    // If page has posted
    else
    {
      // And a search string was passed
      if(empty($_POST) === false && empty($_POST['string']) === false)
      {
        // Display the results of the search
        $result = $this->nfpo_search( $_POST['string'] );
        $num = $this->nfpo_search_count( $_POST['string'] );
        
        // Show the results message
        if( $_SESSION['language'] == 'es' )
        {
          $this->content .=  "<div class='w-container'>" . $num . " resultado(s) para su busqueda: '" . $_POST['string'] . "'</div><br>";
        }
        else{
          $this->content .=  "<div class='w-container'>" . $num . " result(s) for your search: '" . $_POST['string'] . "'</div><br>";
        }
      }
      // If nothing was searched but sorting was applied
      else
        {
          // Sort accordingly
          $result = $this->nfpo_display_all($_POST['sort-by']);
          $num = $this->nfpo_count();
        }
    }

    // Translations
    // If we are using Spanish
    if( $_SESSION['language'] == 'es' ) {
      $translation = array(
        '1' => 'Nombre',
        '2' => 'Logo',
        '3' => 'Pueblo',
        '4' => 'Categoría',
        '5' => 'Incorporación',
        '6' => 'Población',
        '7' => 'Impacto',
        '8' => 'Auspiciadores',
        '9' => 'Puntuación',
      );
    }
    // If we are using English
    else{
      $translation = array(
        '1' => 'Name',
        '2' => 'Logo',
        '3' => 'Municipality',
        '4' => 'Category',
        '5' => 'Incorporation',
        '6' => 'Population',
        '7' => 'Impact',
        '8' => 'Sponsors',
        '9' => 'Rating',
      );
    }

    // Set the NFPOs
    $this->content .= '
      <!-- The NFPOs Section -->
      <section>
        <!-- Is inside a container -->
        <div class="w-container">
          <!-- That has 1 row and 3 equally spaced columns (1/3 of page width each) -->
          <div class="w-row">
    ';

    $wcf = new WidgetNFPOsFilter();
    $this->content .= $wcf->Display() . '
        </div>
        <div class="w-row">

          <!-- Table Displaying all NFPOs-->
          <table>
            <tbody>
            <center>
          
                <tr>
                <td width="300">
                <b>' . $translation[1] . '</b>
                </td>
                <td width="100">
                <b>' . $translation[2] . '</b>
                </td>
                <td width="100">
                <b>' . $translation[3] . '</b>
                </td>
                <td width="100">
                <b>' . $translation[4] . '</b>
                </td>
                <td width="100">
                <b>' . $translation[5] . '</b>
                </td>
                <td width="100">
                <b>' . $translation[6] . '</b>
                </td>
                <td width="100">
                <b>' . $translation[7] . '</b>
                </td>
                <td width="100">
                <b>' . $translation[8] . '</b>
                </td>
                <td width="100">
                <b>' . $translation[9] . '</b>
                </td>
              </tr>
            </center>
            </tbody>
          </table>

            <hr>
            <br>

          <table>
            <center>
            <tbody>
        ';            

	$i = 0;
	// Go over every result and display on the table.
	while ($i < $num) 
	{
		$id = $result[$i]['id'];
		$field1 = $result[$i]['organization-name'];
		$field2 = $result[$i]['logo'];
		$field3 = $result[$i]['municipality'];
		$field4 = $result[$i]['category'];
		$field5 = $result[$i]['inc-date'];
		$field6 = $result[$i]['target'];
		$field7 = $result[$i]['impact'];
		$field8 = $result[$i]['foundations'];
		$field9 = $result[$i]['rating'];
		// Make the Name a link to the details page
		$this->content .=  '
		<tr class="nfpoblock">
			<td width="250">
				<a href="index.php?display=NFPODetails&id=';
				$this->content .=  $id;
		$this->content .=  '">
				<b>
				';
				$this->content .=  $field1;
		// Show the LOGO
		$this->content .=  '	</b></a>
			</td>
			<td width="100">
				<img src="';
				$this->content .=  $field2; 
		$this->content .=  '" height="75" width="75">
			</td>
			<td width="100">
			';
				$this->content .=  $field3;
		$this->content .=  '
			</td>
			<td width="100">
			';
				$this->content .=  $field4;
		$this->content .=  '
			</td>
			<td width="100">
			';
				$this->content .=  $field5;
		$this->content .=  '
			</td>
			<td width="100">
			';
				$this->content .=  $field6;
		$this->content .=  '
			</td>
			<td width="100">
			';
				$this->content .=  $field7;
		$this->content .=  '
			</td>
			<td width="100">
			';
				$this->content .=  $field8;
		$this->content .=  '
			</td>
			<td width="100">
			';
				$this->content .=  $field9;
		$this->content .=  '
			</td>
		</tr>
		';

		$i++;
	}

    $this->content .= '
            </tbody>
            </center>
          </table>
        </div>

      </div>

    </section>';

    parent::Display();
  }

}

?>