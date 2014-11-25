<?php
include("top.php");
//include("header.php"); 
include("nav.php");
include("lib/functions.php");

if(!isset($_SESSION['userID']) || $_SESSION['userRole'] != 'admin') {
    header('location: login.php');
    exit();
}

if(isset($_GET['orderBy'])) {
	$order = htmlentities($_GET["orderBy"], ENT_QUOTES, "UTF-8");
    $orderBy = "ORDER BY ";
    $orderBy .= $order;

    if($order == "fldName") {
    	$orderBy .= " ASC";
    } else {
    	$orderBy .= " DESC";
    }
}

?>
    
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center"><strong>Statistics</strong></h2>
                    <hr>
                    <div class="row">
                        <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Projects</div>
                            <?php
                            $query = 'SELECT fldName, fldExpectedHours, SEC_TO_TIME(SUM(TIME_TO_SEC(fldHours))) AS fldSpentHours, COUNT(DISTINCT fnkUserId) AS fldPeople FROM tblWorksOn LEFT JOIN tblProject ON fnkProjectId = pmkProjectId GROUP BY fnkProjectId '.$orderBy;
                            build_statistics_list_from_database($thisDatabase, 'statistics', $query);
                            ?>
                        </div>
                    </div>                   
	            </div>
	        </div>
	    </div>
	</div>
    <!-- /.container -->
<?php 
    include('footer.php');
?>