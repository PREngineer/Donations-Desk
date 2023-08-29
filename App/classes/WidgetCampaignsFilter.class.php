<?php

class WidgetCampaignsFilter
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
        '1' => 'Filtrar por:',
        '2' => 'TODAS LAS CATEGORIAS',
        '3' => 'Agricultura',
        '4' => 'Animal',
        '5' => 'Arte y Cultura',
        '6' => 'Niños',
        '7' => 'Cambio Climático',
        '8' => 'Alivio de Desastres',
        '9' => 'Desarrollo Económico',
        '10' => 'Educación',
        '11' => 'Medio Ambiente',
        '12' => 'Federal',
        '13' => 'Salud',
        '14' => 'Derechos Humanos',
        '15' => 'Labor Humanitaria',
        '16' => 'Literación',
        '17' => 'Labor',
        '18' => 'Político',
        '19' => 'Religioso',
        '20' => 'Científico',
        '21' => 'Social y Recreacional',
        '22' => 'Deportes',
        '23' => 'Tecnología',
        '24' => 'Veteranos',
        '25' => 'Mujeres y Niñas',
        '26' => 'O búsqueda detallada:',
        '27' => 'Buscar términos...',
        '28' => 'Search!',
      );
    }
    // If we are using English
    else{
      $translation = array(
        '1' => 'Filter by:',
        '2' => 'ALL CATEGORIES',
        '3' => 'Agriculture',
        '4' => 'Animal',
        '5' => 'Arts & Culture',
        '6' => 'Children',
        '7' => 'Climate Change',
        '8' => 'Disaster Relief',
        '9' => 'Economic Development',
        '10' => 'Education',
        '11' => 'Environment',
        '12' => 'Federal',
        '13' => 'Health',
        '14' => 'Human Rights',
        '15' => 'Humanitarian Aid',
        '16' => 'Labor',
        '17' => 'Literacy',
        '18' => 'Political',
        '19' => 'Religious',
        '20' => 'Scientific',
        '21' => 'Social & Recreational',
        '22' => 'Sports',
        '23' => 'Technology',
        '24' => 'Veterans',
        '25' => 'Women & Children',
        '26' => 'OR detailed search:',
        '27' => 'Buscar términos...',
        '28' => 'Buscar!',
      );
    }

    $this->content .= '
          <!-- Drop down menu for sorting -->
          ' . $translation[1] . '
            <form method="POST" enctype="form-data">
            <select name="update">
              <option value="ALL">' . $translation[2] . '</option>
              <option value="Agricultural">' . $translation[3] . '</option>
              <option value="Animal">' . $translation[4] . '</option>
              <option value="Arts & Culture">' . $translation[5] . '</option>
              <option value="Children">' . $translation[6] . '</option>
              <option value="Climate Change">' . $translation[7] . '</option>
              <option value="Disaster Relief">' . $translation[8] . '</option>
              <option value="Economic Development">' . $translation[9] . '</option>
              <option value="Education">' . $translation[10] . '</option>
              <option value="Environment">' . $translation[11] . '</option>
              <option value="Federal">' . $translation[12] . '</option>
              <option value="Health">' . $translation[13] . '</option>
              <option value="Human Rights">' . $translation[14] . '</option>
              <option value="Humanitarian Help">' . $translation[15] . '</option>
              <option value="Labor">' . $translation[16] . '</option>
              <option value="Literacy">' . $translation[17] . '</option>
              <option value="Political">' . $translation[18] . '</option>
              <option value="Religious">' . $translation[19] . '</option>
              <option value="Scientific">' . $translation[20] . '</option>
              <option value="Social & Recreational">' . $translation[21] . '</option>
              <option value="Sports">' . $translation[22] . '</option>
              <option value="Technology">' . $translation[23] . '</option>
              <option value="Veteran">' . $translation[24] . '</option>
              <option value="Women & Girls">' . $translation[25] . '</option>
            </select>
            <!-- Search box -->
            ' . $translation[26] . '
            <input type="text" placeholder="' . $translation[27] . '" name="string" value="">
            <!-- GO! button -->
            <input type="submit" value="' . $translation[28] . '">
          </form>
    ';

    return $this->content;
  }
}

?>

