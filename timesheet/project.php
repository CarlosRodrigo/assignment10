<?php
include("top.php");
//include("header.php"); 
include("nav.php");
include("lib/functions.php");

if(!isset($_SESSION['userID']) || $_SESSION['userRole'] != 'admin') {
    header('location: login.php');
    exit();
}

if (isset($_POST["btnSubmit"])) {

    $dataRecord = array();

    $projectName = htmlentities($_POST["txtProjectName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $projectName;

    $budget = htmlentities($_POST["txtBudget"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $budget;

    $expectedHours = htmlentities($_POST["txtExpectedHours"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $expectedHours;

    $description = htmlentities($_POST["txtDescription"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $description;

    if ($projectName == "") {
        $emailERROR = true;
        alert_danger("You were not able to add a project.");
    } else {
        $query = 'INSERT INTO tblProject SET fldName = ?, fldBudget = ?, fldExpectedHours = ?, fldDescription = ?';

        $results = $thisDatabase->insert($query, $dataRecord);

        if($results == true) {
            alert_success("You've successfully add a project.");
        } else {
            alert_danger("You were not able to add a project.");
        }
    }
}

?>
    
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center"><strong>Project</strong></h2>
                    <hr>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                Add Project
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Projects</div>
                            <?php build_list_from_database($thisDatabase, 'project', 'SELECT pmkProjectId, fldName, fldBudget, fldExpectedHours FROM tblProject ORDER BY fldName');?>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Add Project</h4>
                                </div>
                                <form role="form" method="post" action="<?php print $phpSelf; ?>">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Project Name*</label>
                                        <input type="text" name="txtProjectName" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Budget*</label>
                                        <input type="text" name="txtBudget" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Expected Hours*</label>
                                        <input type="text" name="txtExpectedHours" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Description*</label>
                                        <textarea name="txtDescription" class="form-control" rows="6" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btnSubmit">Add</button>
                                </div>
                                </form>
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