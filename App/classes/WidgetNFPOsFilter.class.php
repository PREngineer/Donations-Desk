<?php

class WidgetNFPOsFilter
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
  {}

  /**
   * Display - Shows the actual widget
   *
   * @return void
   */
  public function Display()
  {
    // If we are using Spanish
    if( $_SESSION['language'] == 'es' ) {
      $translation = array(
        '1' => 'Ordernar por:',
        '2' => 'Nombre',
        '3' => 'Pueblo',
        '4' => 'Categoría',
        '5' => 'Fecha de Incorporación',
        '6' => 'Población',
        '7' => 'Impacto Poblacional',
        '8' => 'Auspiciadores',
        '9' => 'Puntuación',
        '10' => 'O buscar por Nombre:',
        '11' => 'Nombre de organización',
        '12' => 'Buscar!',
      );
    }
    // If we are using English
    else{
      $translation = array(
        '1' => 'Order by:',
        '2' => 'Name',
        '3' => 'Municipality',
        '4' => 'Category',
        '5' => 'Incorporation Date',
        '6' => 'Population',
        '7' => 'Population Impact',
        '8' => 'Sponsors',
        '9' => 'Rating',
        '10' => 'Or search by Name:',
        '11' => 'Name of organization',
        '12' => 'Search!',
      );
    }

    $this->content .= '
          <!-- Drop down menu for sorting -->
          ' . $translation[1] . ' 
          <form method="POST" enctype="form-data">
            <select name="sort-by">
                <option value="organization-name">' . $translation[2] . '</option>
                <option value="municipality">' . $translation[3] . '</option>
                <option value="category">' . $translation[4] . '</option>
                <option value="inc-date">' . $translation[5] . '</option>
                <option value="target">' . $translation[6] . '</option>
                <option value="impact">' . $translation[7] . '</option>
                <option value="foundations">' . $translation[8] . '</option>
                <option value="rating">' . $translation[9] . '</option>
            </select>
            <!-- Search box -->
            ' . $translation[10] . '
            <input type="text" placeholder="' . $translation[11] . '" name="string" value="">
          <!-- GO! button -->
          <input type="submit" value="' . $translation[12] . '">
          </form><br>
    ';

    return $this->content;
  }
}

?>

