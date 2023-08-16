<!DOCTYPE html>

<!-- Include the HEAD that is in a separate PHP file-->
<!-- The HEAD includes all the documents related to styling of the webpage -->
<?php include 'includes/head.php'; ?>

<body>

<!-- Protect the page from unauthorized access -->
<?php admin_protect(); ?>

<!-- Include the HEADER -->
<!-- The HEADER includes the menu at the top of every page -->
<?php include 'includes/content/header.php'; ?>

<!-- Include the Title Section -->
<!-- This section includes the Title of the page and a brief description -->

<?php include 'includes/content/admin-manage-accounts/section-1.php'; ?>

<!-- Include the Campaigns Section -->
<!-- This section has the display of all the Campaigns in the DB -->
<?php include 'includes/content/admin-manage-accounts/section-2.php'; ?>

<!-- Include the FOOTER -->
<!-- The FOOTER includes the Copyright at the bottom of every page -->
<?php include 'includes/footer.php'; ?>

<!-- Include the SCRIPTS -->
<!-- The SCRIPTS includes the links to necessary scripts to display the page properly -->
<?php include 'includes/scripts.php'; ?>
</body>
</html>