<?php
include("top.php");
//include("header.php"); 
include("nav.php");
include("lib/functions.php");

if(!isset($_SESSION['userID']) || $_SESSION['userRole'] != 'admin') {
    header('location: login.php');
    exit();
}

$projectName = "";
$budget = "";
$expectedHours = "";
$description = "";
$orderBy = 'ORDER BY fldName';

$hiddenId = $_GET["id"];

if(isset($_GET['orderBy'])) {
    $orderBy = "ORDER BY ";
    $orderBy .= htmlentities($_GET["orderBy"], ENT_QUOTES, "UTF-8");
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
        if(!empty($_POST["id"])) {
            $id = $_POST["id"];
            $dataRecord[] = $id;
            $query = 'UPDATE tblProject SET fldName = ?, fldBudget = ?, fldExpectedHours = ?, fldDescription = ? WHERE pmkProjectId = ?';

            $results = $thisDatabase->update($query, $dataRecord);

            if($results == true) {
                alert_success("You've successfully updated a project.");
            } else {
                alert_danger("You were not able to updated a project.");
            }
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
} else if (isset($_GET["id"]) && isset($_GET["action"]) == "edit") {
   
    $id = $_GET["id"];
    $dataRecord = array($id);

    $query = "SELECT fldName, fldBudget, fldExpectedHours, fldDescription FROM tblProject WHERE pmkProjectId = ?";
    $results = $thisDatabase->select($query, $dataRecord);

    foreach ($results as $row) {
        $projectName = $row["fldName"];
        $budget = $row["fldBudget"];
        $expectedHours = $row["fldExpectedHours"];
        $description = $row["fldDescription"];
    }
} else if (isset($_POST["btnDelete"])) {
    $id = $_POST["id"];
    $dataRecord = array($id);
    $query = 'DELETE FROM tblProject WHERE pmkProjectId = ?';

    $results = $thisDatabase->delete($query, $dataRecord);

    if($results == true) {
        alert_success("You've successfully deleted a project.");
    } else {
        alert_danger("You were not able to delete a project.");
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
                            <?php build_list_from_database($thisDatabase, 'project', 'SELECT pmkProjectId, fldName, fldBudget, fldExpectedHours FROM tblProject '.$orderBy);?>
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
                                        <input type="hidden" name="id" value="<?php print $hiddenId ?>"></input>
                                        <label>Project Name*</label>
                                        <input type="text" name="txtProjectName" value="<?php print $projectName; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Budget*</label>
                                        <input type="text" name="txtBudget" value="<?php print $budget; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Expected Hours*</label>
                                        <input type="text" name="txtExpectedHours" value="<?php print $expectedHours; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Description*</label>
                                        <textarea name="txtDescription" class="form-control" rows="6" required><?php print $description; ?></textarea>
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

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="deleteModalLabel">Delete</h4>
                                </div>
                                <form role="form" method="post" action="<?php print $phpSelf; ?>">
                                    <div class="modal-body">
                                        <label>Are you sure you want to delete this record ?</label>
                                        <input type="hidden" name="id" value="<?php print $hiddenId ?>"></input>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger" name="btnDelete">Delete</button>
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
    if(action == "edit") {
        $('#myModal').modal('show');
    } else if(action == "delete") {
        $('#deleteModal').modal('show');
    }
});
</script>