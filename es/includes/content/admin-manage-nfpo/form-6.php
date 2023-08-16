<?php

// DISPLAY THE ERROR MESSAGES IF APPROPRIATE

echo 'Por favor espere mientras se carga el archivo una vez presione SOMETER.  Puede parecer que no responde pero no es así.<br>';
// If an error while Uploading happened
if($_GET['e1'] == '1')
{
  echo '<font color="red">Ocurrió un error al subir el archivo.  Por favor intente denuevo.
        <br> Posibles errores:
        <br> Archivo excede tamaño Máximo (1MB Logo, 2MB Foto, 5MB PDF)
        <br> Se interrumpió la carga.</font>';
}

// If Invalid Logo Size
if($_GET['e2'] == '1')
{
  echo '<font color="red">Tamaño máximo de logo es 1 MB.  Por favor reduzca el tamaño.</font>';
}

// If Invalid Logo/Picture Extension
if($_GET['e3'] == '1')
{
  echo '<font color="red">Extensión de Logo/Foto Inválida.  Sólo se permiten: JPG, GIF, PNG y BMP</font>';
}

// If Not Successful
if($_GET['e4'] == '1')
{
  echo '<font color="red">¡No se logró cargar el archivo!  Por favor, intente denuevo.</font>';
}

// If Invalid Picture Size
if($_GET['e5'] == '1')
{
  echo '<font color="red">Tamaño máximo para foto es 2 MB.  Por favor reduzca el tamaño.</font>';
}

// If Invalid PDF Size
if($_GET['e6'] == '1')
{
  echo '<font color="red">Tamaño máximo de documento es 5 MB.  Por favor reduzca el tamaño.</font>';
}

// If Invalid Document Extension
if($_GET['e7'] == '1')
{
  echo '<font color="red">El Documento no es PDF.  Por favor, convierta a PDF.</font>';
}

// DISPLAY THE SUCCESS MESSAGES IF APPROPRIATE

// If Logo Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '1')
{
  echo '<center><font color="green"><p>¡Logo Cargado!</p></font></center>';
}

// If Pic1 Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '2')
{
  echo '<center><font color="green"><p>¡Foto Cargada!</p></font></center>';
}

// If Pic2 Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '3')
{
  echo '<center><font color="green"><p>¡Foto Cargada!</p></font></center>';
}

// If Pic3 Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '4')
{
  echo '<center><font color="green"><p>¡Foto Cargada!</p></font></center>';
}

// If Good Standing Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '5')
{
  echo '<center><font color="green"><p>¡Documento Good Standing Cargado!</p></font> </center>';
}

// If State Inscription Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '6')
{
  echo '<center><font color="green"><p>¡Documento State Inscription Cargado!</p></font> </center>';
}

// If 990 Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '7')
{
  echo '<center><font color="green"><p>¡Documento 990 Document Cargado!</p></font> </center>';
}

// If Audit Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '8')
{
  echo '<center><font color="green"><p>¡Documento Audit Cargado!</p></font></center>';
}

// If State Exemption Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '9')
{
  echo '<center><font color="green"><p>¡Documento State Exemption Cargado!</p></font></center>';
}

// If Federal Exemption Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '10')
{
  echo '<center><font color="green"><p>¡Documento Federal Exemption Cargado!</p></font></center>';
}

  // Add the appropriate Upload field
  
  echo '<hr>';

  if($_GET['doc'] == '1')
  {
    include 'includes/content/admin-manage-nfpo/1.php';
  }

    if($_GET['doc'] == '2')
  {
    include 'includes/content/admin-manage-nfpo/2.php';
  }

    if($_GET['doc'] == '3')
  {
    include 'includes/content/admin-manage-nfpo/3.php';
  }

    if($_GET['doc'] == '4')
  {
    include 'includes/content/admin-manage-nfpo/4.php';
  }

    if($_GET['doc'] == '5')
  {
    include 'includes/content/admin-manage-nfpo/5.php';
  }

    if($_GET['doc'] == '6')
  {
    include 'includes/content/admin-manage-nfpo/6.php';
  }

    if($_GET['doc'] == '7')
  {
    include 'includes/content/admin-manage-nfpo/7.php';
  }

    if($_GET['doc'] == '8')
  {
    include 'includes/content/admin-manage-nfpo/8.php';
  }

    if($_GET['doc'] == '9')
  {
    include 'includes/content/admin-manage-nfpo/9.php';
  }

    if($_GET['doc'] == '10')
  {
    include 'includes/content/admin-manage-nfpo/10.php';
  }

?>

<!-- Browsing menu -->
<table border="1">
  <tbody>
    <th align="left" colspan="6">
      Sections:
    </th>

    <tr>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=1&id=<?php echo $_GET['id']?>">Básico</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=2&id=<?php echo $_GET['id']?>">Representate</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=3&id=<?php echo $_GET['id']?>">Donación</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=4&id=<?php echo $_GET['id']?>">Propósito</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=5&id=<?php echo $_GET['id']?>">Social Media</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']?>">Documentos</a>
      </td>
    </tr>
  </tbody>
</table>
<!-- Browsing menu -->

<!-- Part 7: OFFICIAL DOCUMENTATION -->

<table>
<tbody>
  
  <tr class="block">
    <td colspan="2">
      <h2>Documentos Oficiales, Logo y Fotos</h2>            
      <p> Seleccione cuales documentos quiere cargar al Sistema de la Lista que aparece abajo.
    </td>
  </tr>
    
  <tr class="block">
    <td class="campaignblock">
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=1">Organization Logo</a>
    </td>
    <td class="campaignblock">
      El Logo se mostrará en la página que contiene los detalles de la Organización.
    </td>
  </tr>

  <tr class="block">
    <td class="campaignblock">
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=2">Fotos de las Facilidades (#1)</a><br><br>
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=3">Fotos de las Facilidades (#2)</a><br><br>
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=4">Fotos de las Facilidades (#3)</a>
    </td>
    <td class="campaignblock">
      Las Fotos se mostrarán en la página que contiene todos los detalles para su Organización.
      Éstas serán su carta de 'presentación.'
    </td>
  </tr>

  <tr class="block">
    <td class="campaignblock">
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=5">Documento Good Standing</a><br><br>
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=6">Documento Departmento de Estado</a>
    </td>
    <td class="campaignblock">
      Éstos documentos son <font color="red">REQUIRIDOS</font> y sirven para mostrarle a los donantes que son una Organización confiable.
      Su Organización <font color="red">NO</font> aparecerá en nuestra lista hasta que los provea.
    </td>
  </tr>
  
  <tr class="block">
    <td class="campaignblock">
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=7">Documento 990 - Federal Financial Statement</a><br><br>
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=8">Documento Audit Statement</a>
    </td>
    <td class="campaignblock">
      Éstos documentos no son requeridos pero proveen información sobre el manejos de sus fianzas lo cual le da mayor seguridad a los donantes.
    </td>
  </tr>

  <tr class="block">
    <td class="campaignblock">
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=9">Documento State Exemption</a><br><br>
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=10">Documento Federal Exemption</a>
    </td>
    <td class="campaignblock">
      Éstos documentos no son requeridos pero sirven como evidencia de que son una Organización Legalmente formada.
    </td>
  </tr>

</tbody>
</table>