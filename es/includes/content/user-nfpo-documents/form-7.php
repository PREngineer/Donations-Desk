<?php

// DISPLAY THE ERROR MESSAGES IF APPROPRIATE

echo 'Por favor espere en lo que se sube el archivo.  Aunque no parezca responder, está trabajando.<br>';
// If an error while Uploading happened
if($_GET['e1'] == '1')
{
  echo '<font color="red">Ocurrió un error al subir el archivo.  Por favore, inténtelo denuevo.
        <br> Posibles errores:
        <br> Archivo excede tamaño máximo (1MB Logo, 2MB Foto, 5MB PDF)
        <br> Se interrumpió la subida.</font>';
}

// If Invalid Logo Size
if($_GET['e2'] == '1')
{
  echo '<font color="red">Tamaño máximo de Logo 1 MB.  Por favor, reduzca el tamaño.</font>';
}

// If Invalid Logo/Picture Extension
if($_GET['e3'] == '1')
{
  echo '<font color="red">Formato Invalido de Logo/Foto.  Se permiten: JPG, GIF, PNG & BMP</font>';
}

// If Not Successful
if($_GET['e4'] == '1')
{
  echo '<font color="red">¡No se pudo subir el archivo!  Por favor, inténtelo denuevo.</font>';
}

// If Invalid Picture Size
if($_GET['e5'] == '1')
{
  echo '<font color="red">Tamaño máximo para Foto 2 MB.  Por favor, reduzca el tamaño.</font>';
}

// If Invalid PDF Size
if($_GET['e6'] == '1')
{
  echo '<font color="red">Tamaño máximo para Documento 5 MB.  Por favor, reduzca el tamaño.</font>';
}

// If Invalid Document Extension
if($_GET['e7'] == '1')
{
  echo '<font color="red">El Documento no es un PDF.  Por favor, conviértalo a PDF.</font>';
}

// DISPLAY THE SUCCESS MESSAGES IF APPROPRIATE

// If Logo Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '1')
{
  echo '<center><font color="green"><p>¡Logo subido exitosamente!</p><p>Go to the </font> 
        <a href="user-nfpo-documents.php?doc=2">PRÓXIMO</a></p></center>';
}

// If Pic1 Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '2')
{
  echo '<center><font color="green"><p>¡Foto subida exitosamente!</p><p>Go to the </font> 
        <a href="user-nfpo-documents.php?doc=3">PRÓXIMO</a></p></center>';
}

// If Pic2 Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '3')
{
  echo '<center><font color="green"><p>¡Foto subida exitosamente!</p><p>Go to the </font> 
        <a href="user-nfpo-documents.php?doc=4">PRÓXIMO</a></p></center>';
}

// If Pic3 Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '4')
{
  echo '<center><font color="green"><p>¡Foto subida exitosamente!</p><p>Go to the </font> 
        <a href="user-nfpo-documents.php?doc=5">PRÓXIMO</a></p></center>';
}

// If Good Standing Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '5')
{
  echo '<center><font color="green"><p>Good Standing Document Uploaded Successfully!</p><p>Go to the </font> 
        <a href="user-nfpo-documents.php?doc=6">PRÓXIMO</a></p></center>';
}

// If State Inscription Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '6')
{
  echo '<center><font color="green"><p>¡Documento subido exitosamente!</p><p>Go to the </font> 
        <a href="user-nfpo-documents.php?doc=7">PRÓXIMO</a></p></center>';
}

// If 990 Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '7')
{
  echo '<center><font color="green"><p>¡Documento subido exitosamente!</p><p>Go to the </font> 
        <a href="user-nfpo-documents.php?doc=8">PRÓXIMO</a></p></center>';
}

// If Audit Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '8')
{
  echo '<center><font color="green"><p>¡Documento subido exitosamente!</p><p>Go to the </font> 
        <a href="user-nfpo-documents.php?doc=9">PRÓXIMO</a></p></center>';
}

// If State Exemption Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '9')
{
  echo '<center><font color="green"><p>¡Documento subido exitosamente!</p><p>Go to the </font> 
        <a href="user-nfpo-documents.php?doc=10">PRÓXIMO</a></p></center>';
}

// If Federal Exemption Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '10')
{
  echo '<center><font color="green"><p>¡Documento subido exitosamente!</p></center>';
}

  // Add the appropriate Upload field
  
  echo '<hr>';

  if($_GET['doc'] == '1')
  {
    include 'includes/content/user-nfpo-documents/1.php';
  }

    if($_GET['doc'] == '2')
  {
    include 'includes/content/user-nfpo-documents/2.php';
  }

    if($_GET['doc'] == '3')
  {
    include 'includes/content/user-nfpo-documents/3.php';
  }

    if($_GET['doc'] == '4')
  {
    include 'includes/content/user-nfpo-documents/4.php';
  }

    if($_GET['doc'] == '5')
  {
    include 'includes/content/user-nfpo-documents/5.php';
  }

    if($_GET['doc'] == '6')
  {
    include 'includes/content/user-nfpo-documents/6.php';
  }

    if($_GET['doc'] == '7')
  {
    include 'includes/content/user-nfpo-documents/7.php';
  }

    if($_GET['doc'] == '8')
  {
    include 'includes/content/user-nfpo-documents/8.php';
  }

    if($_GET['doc'] == '9')
  {
    include 'includes/content/user-nfpo-documents/9.php';
  }

    if($_GET['doc'] == '10')
  {
    include 'includes/content/user-nfpo-documents/10.php';
  }

?>

<!-- Part 7: OFFICIAL DOCUMENTATION -->

<table>
<tbody>
  
  <tr class="block">
    <td colspan="2">
      <h2>Documentos Oficiales, Logo y Fotos</h2>            
      <p> Seleccione cual documento quiere subir al sistema de la lista siguiente.
    </td>
  </tr>
    
  <tr class="block">
    <td class="nfpoblock">
      <a href="user-nfpo-documents.php?doc=1">Organization Logo</a>
    </td>
    <td class="nfpoblock">
      El Logo se mostrará en la página con los detalles para su Organización.
    </td>
  </tr>

  <tr class="block">
    <td class="nfpoblock">
      <a href="user-nfpo-documents.php?doc=2">Foto de sus facilidades (#1)</a><br><br>
      <a href="user-nfpo-documents.php?doc=3">Foto de sus facilidades (#2)</a><br><br>
      <a href="user-nfpo-documents.php?doc=4">Foto de sus facilidades (#3)</a>
    </td>
    <td class="nfpoblock">
      Las Fotos se mostrarán en la página que contiene los detalles para su Organización.
      Servirán como su 'tarjeta de presentación.'
    </td>
  </tr>

  <tr class="block">
    <td class="nfpoblock">
      <a href="user-nfpo-documents.php?doc=5">Documento Good Standing</a><br><br>
      <a href="user-nfpo-documents.php?doc=6">Documento de Inscripción al Dpto de Estado</a>
    </td>
    <td class="nfpoblock">
      Estos documentos son <font color="red">REQUERIDOS</font> y sirven para mostrarle a los donantes que son una Organización confiable.
      Su Organización <font color="red">NO APARECERÁ</font> en nuestra lista hasta que provean estos documentos.
    </td>
  </tr>
  
  <tr class="block">
    <td class="nfpoblock">
      <a href="user-nfpo-documents.php?doc=7">Documento 990 - Federal Financial Statement</a><br><br>
      <a href="user-nfpo-documents.php?doc=8">Documento de Auditoría</a>
    </td>
    <td class="nfpoblock">
      Estos documentos no son requeridos pero mejoran sus posibilidades de recibir donaciones ya que proveen una idea del manejos de sus finanzas.
    </td>
  </tr>

  <tr class="block">
    <td class="nfpoblock">
      <a href="user-nfpo-documents.php?doc=9">Documento de Exensión Estatal</a><br><br>
      <a href="user-nfpo-documents.php?doc=10">Documento de Exensión Federal</a>
    </td>
    <td class="nfpoblock">
      Estos documentos no son requeridos pero sirven como evidencia de que su Organización es confiable y está legalmente registrada.
    </td>
  </tr>

</tbody>
</table>