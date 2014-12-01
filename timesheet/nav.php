<?php 
$query = 'SELECT fldCompanyName FROM tblCompany';
$results = $thisDatabase->select($query);
$companyName = $results[0][0];
?>
<div class="brand"><?php print $companyName ?></div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
            <a class="navbar-brand" href="index.php">Company Name</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <?php if($_SESSION['userRole'] == 'admin') { ?>
                <li>
                    <a href="user.php">User</a>
                </li>
                <li>
                    <a href="project.php">Project</a>
                </li>
                <li>
                    <a href="statistics.php">Statistics</a>
                </li>
                <li>
                    <a href="company.php">Company</a>
                </li>
                <?php }
                if($_SESSION['userRole'] == 'collaborator') { ?>
                <li>
                    <a href="contact.php">Contact</a>
                </li>
                <li>
                    <a href="about.php">About</a>
                </li>
                <?php } ?>
                <li>
                    <a href="logout.php">Log out</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>