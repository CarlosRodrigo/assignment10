<?php
include("top.php");
//include("header.php"); 
include("nav.php");
include("lib/functions.php");

if(!isset($_SESSION['userID']) || $_SESSION['userRole'] != 'admin') {
    header('location: login.php');
    exit();
}

$companyName = "";

$hiddenId = $_GET["id"];

if (isset($_POST["btnSubmit"])) {

    $dataRecord = array();

    $companyName = htmlentities($_POST["txtCompanyName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $companyName;

    if ($companyName == "") {
        alert_danger("You were not able to add a project.");
    } else {
        if(!empty($_POST["id"])) {
            $id = $_POST["id"];
            $dataRecord[] = $id;
            $query = 'UPDATE tblCompany SET fldCompanyName = ? WHERE pmkCompanyId = ?';

            $results = $thisDatabase->update($query, $dataRecord);

            if($results == true) {
                alert_success("You've successfully updated a company.");
            } else {
                alert_danger("You were not able to update a company.");
            }
        } else {
            $query = 'INSERT INTO tblCompany SET fldCompanyName = ?';

            $results = $thisDatabase->insert($query, $dataRecord);

            if($results == true) {
                alert_success("You've successfully add a company.");
            } else {
                alert_danger("You were not able to add a company.");
            }
        }
    }
} else if (isset($_GET["id"]) && isset($_GET["action"]) == "edit") {
   
    $id = $_GET["id"];
    $dataRecord = array($id);

    $query = "SELECT fldCompanyName FROM tblCompany WHERE pmkCompanyId = ?";
    $results = $thisDatabase->select($query, $dataRecord);

    foreach ($results as $row) {
        $companyName = $row["fldCompanyName"];
    }
} else if (isset($_POST["btnDelete"])) {
    $id = $_POST["id"];
    $dataRecord = array($id);
    $query = 'DELETE FROM tblCompany WHERE pmkCompanyId = ?';

    $results = $thisDatabase->delete($query, $dataRecord);

    if($results == true) {
        alert_success("You've successfully deleted a company.");
    } else {
        alert_danger("You were not able to delete a company.");
    }
}

?>
    
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center"><strong>Company</strong></h2>
                    <hr>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <!-- Button trigger modal -->
                            <!--<a href="company.php?action=edit&id=1" class="btn btn-default edit">Edit info</a>-->
                            <?php 
                            $query = 'SELECT pmkCompanyId, fldCompanyName FROM tblCompany';
                            $results = $thisDatabase->select($query);
                            if(count($results) == 0) {
                            ?>
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                Add Company
                            </button>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Company info</div>
                        <?php build_list_from_database($thisDatabase, 'company', 'SELECT pmkCompanyId, fldCompanyName FROM tblCompany');?>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Company</h4>
                                </div>
                                <form role="form" method="post" action="<?php print $phpSelf; ?>">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="<?php print $hiddenId ?>"></input>
                                        <label>Company Name*</label>
                                        <input type="text" name="txtCompanyName" value="<?php print $companyName; ?>" class="form-control" required>
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