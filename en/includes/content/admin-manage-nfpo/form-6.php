<?php

// DISPLAY THE ERROR MESSAGES IF APPROPRIATE

echo 'Please wait for the upload to complete once you click SUBMIT.  It may seem unresponsive but it is actually working.<br>';
// If an error while Uploading happened
if($_GET['e1'] == '1')
{
  echo '<font color="red">An error occurred while uploading the file.  Please try again.
        <br> Possible errors:
        <br> File exceeds Maximum Size (1MB Logo, 2MB Picture, 5MB PDF)
        <br> The upload was interrupted.</font>';
}

// If Invalid Logo Size
if($_GET['e2'] == '1')
{
  echo '<font color="red">Maximum Logo size is 1 MB.  Please reduce the size.</font>';
}

// If Invalid Logo/Picture Extension
if($_GET['e3'] == '1')
{
  echo '<font color="red">Invalid Logo/Picture Extension.  Allowed file types: JPG, GIF, PNG & BMP</font>';
}

// If Not Successful
if($_GET['e4'] == '1')
{
  echo '<font color="red">The upload was not Successful!  Please try again.</font>';
}

// If Invalid Picture Size
if($_GET['e5'] == '1')
{
  echo '<font color="red">Maximum Picture size is 2 MB.  Please reduce the size.</font>';
}

// If Invalid PDF Size
if($_GET['e6'] == '1')
{
  echo '<font color="red">Maximum Document size is 5 MB.  Please reduce the size.</font>';
}

// If Invalid Document Extension
if($_GET['e7'] == '1')
{
  echo '<font color="red">The Document is not a PDF.  Please convert to PDF.</font>';
}

// DISPLAY THE SUCCESS MESSAGES IF APPROPRIATE

// If Logo Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '1')
{
  echo '<center><font color="green"><p>Logo Uploaded Successfully!</p></font></center>';
}

// If Pic1 Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '2')
{
  echo '<center><font color="green"><p>Picture Uploaded Successfully!</p></font></center>';
}

// If Pic2 Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '3')
{
  echo '<center><font color="green"><p>Picture Uploaded Successfully!</p></font></center>';
}

// If Pic3 Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '4')
{
  echo '<center><font color="green"><p>Picture Uploaded Successfully!</p></font></center>';
}

// If Good Standing Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '5')
{
  echo '<center><font color="green"><p>Good Standing Document Uploaded Successfully!</p></font> </center>';
}

// If State Inscription Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '6')
{
  echo '<center><font color="green"><p>State Inscription Document Uploaded Successfully!</p></font> </center>';
}

// If 990 Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '7')
{
  echo '<center><font color="green"><p>990 Document Uploaded Successfully!</p></font> </center>';
}

// If Audit Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '8')
{
  echo '<center><font color="green"><p>Audit Document Uploaded Successfully!</p></font></center>';
}

// If State Exemption Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '9')
{
  echo '<center><font color="green"><p>State Exemption Document Uploaded Successfully!</p></font></center>';
}

// If Federal Exemption Upload was OK
if($_GET['success'] == true && $_GET['doc'] == '10')
{
  echo '<center><font color="green"><p>Federal Exemption Document Uploaded Successfully!</p></font></center>';
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
        <a href="admin-manage-nfpo.php?edit=1&id=<?php echo $_GET['id']?>">Basic</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=2&id=<?php echo $_GET['id']?>">Representative</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=3&id=<?php echo $_GET['id']?>">Donations</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=4&id=<?php echo $_GET['id']?>">Purpose</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=5&id=<?php echo $_GET['id']?>">Social Media</a>
      </td>
      <td width="150">
        <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']?>">Documents</a>
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
      <h2>Official Documents, Logo & Pictures</h2>            
      <p> Select which of the documents you want to upload to the System from the list below.
    </td>
  </tr>
    
  <tr class="block">
    <td class="campaignblock">
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=1">Organization Logo</a>
    </td>
    <td class="campaignblock">
      The Logo will be displayed in the page that contains all the details for your Organization.
    </td>
  </tr>

  <tr class="block">
    <td class="campaignblock">
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=2">Picture of your Facilities (#1)</a><br><br>
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=3">Picture of your Facilities (#2)</a><br><br>
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=4">Picture of your Facilities (#3)</a>
    </td>
    <td class="campaignblock">
      The Pictures will be displayed in the page that contains all the details for your Organization.
      These will be your 'presentation card.'
    </td>
  </tr>

  <tr class="block">
    <td class="campaignblock">
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=5">Good Standing Document</a><br><br>
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=6">Department of State Inscription</a>
    </td>
    <td class="campaignblock">
      These documents are <font color="red">REQUIRED</font> and serves to show the donor that you are a trustworthy Organization.
      Your Organization will <font color="red">NOT</font> appear in our list until you provide these documents.
    </td>
  </tr>
  
  <tr class="block">
    <td class="campaignblock">
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=7">990 - Federal Financial Statement</a><br><br>
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=8">Audit Statement</a>
    </td>
    <td class="campaignblock">
      These documents are not required but improve your chances of getting donations as it will provide a background of your funds management.
    </td>
  </tr>

  <tr class="block">
    <td class="campaignblock">
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=9">State Exemption</a><br><br>
      <a href="admin-manage-nfpo.php?edit=6&id=<?php echo $_GET['id']; ?>&doc=10">Federal Exemption</a>
    </td>
    <td class="campaignblock">
      These documents are not required but serve as evidence that you are a reliable and legally registered Organization.
    </td>
  </tr>

</tbody>
</table>