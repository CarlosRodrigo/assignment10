<?php
include("top.php");
//include("header.php"); 
include("nav.php");
include("lib/functions.php");

if(!isset($_SESSION['userID']) || $_SESSION['userRole'] != 'admin') {
    header('location: login.php');
    exit();
}

$email = "";
$firstName = "";
$lastName = "";
$admissionDate = "";
$position = "";
$workHours = "";
$gender = "male";
$role = "collaborator";
$orderBy = 'ORDER BY fldFirstName';

$hiddenId = $_GET["id"];

if(isset($_GET['orderBy'])) {
    $orderBy = "ORDER BY ";
    $orderBy .= htmlentities($_GET["orderBy"], ENT_QUOTES, "UTF-8");
}

if (isset($_POST["btnSubmit"])) {
    $dataRecord = array();

    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;

    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;

    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lastName;

    $admissionDate = htmlentities($_POST["txtAdmissionDate"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $admissionDate;

    $position = htmlentities($_POST["txtPosition"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $position;

    $workHours = htmlentities($_POST["txtWorkHours"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $workHours;

    $gender = htmlentities($_POST["radGender"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $gender;

    $role = htmlentities($_POST["radRole"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $role; 

    if ($email == "") {
        $emailERROR = true;
        alert_danger("You were not able to add a user.");
    } else {
        $query = 'SELECT * FROM tblUser WHERE fldEmail = ?';
        $results = $thisDatabase->select($query, array($email));
        if(!empty($_POST["id"])) {
            $id = $_POST["id"];
            $dataRecord[] = $id;
            $query = 'UPDATE tblUser SET fldEmail = ?, fldFirstName = ?, fldLastName = ?, fldAdmissionDate = ?, fldPosition = ?, fldWorkHours = ?, fldGender = ?, fldType = ? WHERE pmkUserId = ?';

            $results = $thisDatabase->insert($query, $dataRecord);

            if($results == true) {
                alert_success("You've successfully updated a user.");
            } else {
                alert_danger("You were not able to updated a user.");
            }
            $email = "";
            $firstName = "";
            $lastName = "";
        } else {

            $password = sha1(time());
            $dataRecord[] = $password;

            $query = 'INSERT INTO tblUser SET fldEmail = ?, fldFirstName = ?, fldLastName = ?, fldAdmissionDate = ?, fldPosition = ?, fldWorkHours = ?, fldGender = ?, fldType = ?, fldPassword = ?';

            $results = $thisDatabase->insert($query, $dataRecord);

            if($results == true) {
                alert_success("You've successfully add a user.");
            } else {
                alert_danger("You were not able to add a user.");
            }
        }
    }
} else if (isset($_GET["id"]) && isset($_GET["action"]) == "edit") {
   
    $id = $_GET["id"];
    $dataRecord = array($id);

    $query = "SELECT fldEmail, fldFirstName, fldLastName, fldAdmissionDate, fldPosition, fldWorkHours, fldGender, fldType FROM tblUser WHERE pmkUserId = ?";
    $results = $thisDatabase->select($query, $dataRecord);

    foreach ($results as $row) {
        $email = $row[0];
        $firstName = $row[1];
        $lastName = $row[2];
        $admissionDate = $row[3];
        $position = $row[4];
        $workHours = $row[5];
        $gender = $row[6];
        $role = $row[7];
    }
}
else if (isset($_POST["btnDelete"])) {
    //print_r($_POST);
    $id = $_POST["id"];
    $dataRecord = array($id);
    $query = 'DELETE FROM tblUser WHERE pmkUserId = ?';

    $results = $thisDatabase->delete($query, $dataRecord);

    if($results == true) {
        alert_success("You've successfully deleted a user.");
    } else {
        alert_danger("You were not able to delete a user.");
    }
}
?>
    
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center"><strong>User</strong></h2>
                    <hr>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                Add User
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Users</div>

                        <?php
                        build_list_from_database($thisDatabase, 'user', 'SELECT pmkUserId,fldEmail, fldFirstName, fldLastName, fldPosition, fldWorkHours FROM tblUser '.$orderBy);
                        ?>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Add User</h4>
                                </div>
                                <form role="form" method="post" action="<?php print $phpSelf; ?>">
                                <div class="modal-body">
                                    <div class="form-group col-lg-4">
                                        <input type="hidden" name="id" value="<?php print $hiddenId ?>"></input>
                                        <label>Email*</label>
                                        <input type="email" name="txtEmail" value="<?php print $email; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>First Name*</label>
                                        <input type="text" name="txtFirstName" value="<?php print $firstName; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Last Name*</label>
                                        <input type="text" name="txtLastName" value="<?php print $lastName; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Admission Date*</label>
                                        <input type="text" name="txtAdmissionDate" value="<?php print $admissionDate; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Position*</label>
                                        <input type="text" name="txtPosition" value="<?php print $position; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Work Hours*</label>
                                        <input type="text" name="txtWorkHours" value="<?php print $workHours; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Gender*</label>
                                        <div class="radio">
                                            <label><input type="radio" name="radGender" id="radGenderMale" value="male" <?php if($gender=="male") print 'checked'?>>Male</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="radGender" id="radGenderFemale" value="female" <?php if($gender=="female") print 'checked'?>>Female</label>
                                        </div>
                                        <div class="radio disabled">
                                            <label><input type="radio" name="radGender" id="radGenderNone" value="none" <?php if($gender=="none") print 'checked'?>>None</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Role*</label>
                                        <div class="radio">
                                            <label><input type="radio" name="radRole" value="admin" <?php if($role=="admin") print 'checked'?>>Admin</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="radRole" value="collaborator" <?php if($role=="collaborator") print 'checked'?>>Collaborator</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row"></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" name="btnSubmit">Save</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
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