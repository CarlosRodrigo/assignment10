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

if (isset($_GET["id"]) && isset($_GET["action"]) == "showBarChart") {
	$id = $_GET["id"];

	$query = 'SELECT fldName, fldExpectedHours, SEC_TO_TIME(SUM(TIME_TO_SEC(fldHours))) AS fldSpentHours, SEC_TO_TIME(SUM(TIME_TO_SEC(fldHours))/COUNT(*)) AS fldDailyAverageHours, COUNT(DISTINCT fnkUserId) AS fldPeople FROM tblWorksOn LEFT JOIN tblProject ON fnkProjectId = pmkProjectId WHERE fnkProjectId = ?';
	$results = $thisDatabase->select($query, array($id));

	$spentHours = (int) $results[0]['fldSpentHours'];
	$dailyAVGHours = (int) $results[0]['fldDailyAverageHours'];
	$people = (int) $results[0]['fldPeople'];
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
                            $query = 'SELECT fnkProjectId, fldName, fldExpectedHours, SEC_TO_TIME(SUM(TIME_TO_SEC(fldHours))) AS fldSpentHours, SEC_TO_TIME(SUM(TIME_TO_SEC(fldHours))/COUNT(*)) AS fldDailyAverageHours, COUNT(DISTINCT fnkUserId) AS fldPeople FROM tblWorksOn LEFT JOIN tblProject ON fnkProjectId = pmkProjectId GROUP BY fnkProjectId '.$orderBy;
                            build_statistics_list_from_database($thisDatabase, 'statistics', $query);
                            ?>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Bar Chart</h4>
                                </div>
                                <canvas id="canvas"></canvas>
                            </div>
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

<script src="js/chart.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    var action = getUrlVars()["action"];
    if(action == "showBarChart") {
        $('#myModal').modal('show');
    }
    var barChartData = {
		labels : ["Spent Hours","Daily Average Hours","People"],
		datasets : [
			{
				fillColor : "rgba(220,220,220,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [<?php print $spentHours ?>,<?php print $dailyAVGHours ?>,<?php print $people ?>]
			}
		]
	}
	$('#myModal').on('shown.bs.modal', function (e) {
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
	});
});
</script>