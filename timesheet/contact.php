<?php
include("top.php");
//include("header.php"); 
include("nav.php");
<<<<<<< HEAD

if (!isset($_SESSION['userID'])) {
    header('location: login.php');
    exit();
}
=======
include("lib/functions.php");

if(!isset($_SESSION['userID'])) {
    header('location: login.php');
    exit();
}

$email = "";
$address = "";
$phone = "";
$state = "";
$zipCode = "";
$country = "";
$orderBy = 'ORDER BY fldEmail';

$hiddenId = $_GET["id"];
$userId = $_SESSION['userID'];

if(isset($_GET['orderBy'])) {
    $orderBy = "ORDER BY ";
    $orderBy .= htmlentities($_GET["orderBy"], ENT_QUOTES, "UTF-8");
}

if (isset($_POST["btnResetPassword"])) {
    $dataRecord = array();

    $password = htmlentities($_POST["txtPreviousPassword"], ENT_QUOTES, "UTF-8");

    $newPassword = htmlentities($_POST["txtPassword"], ENT_QUOTES, "UTF-8");

    $confirmPassword = htmlentities($_POST["txtConfirmPassword"], ENT_QUOTES, "UTF-8");

    $password = sha1($password);
    $newPassword = sha1($newPassword);
    $confirmPassword = sha1($confirmPassword);

    $query = "SELECT fldPassword FROM tblUser WHERE pmkUserId = '".$userId."'";
    $results = $thisDatabase->select($query);
    $db_password = $results[0][0];

    if($password == $db_password) {
        if($newPassword == $confirmPassword) {
            $dataRecord[] = $newPassword;
            $dataRecord[] = $userId;

            $query = "UPDATE tblUser SET fldPassword = ? WHERE pmkUserId = ?";

            $results = $thisDatabase->update($query, $dataRecord);

            if($results == true) {
                alert_success("You've successfully changed your password.");
            } else {
                alert_danger("You were not able to change your password.");
            }
        } else {
            alert_danger("New password does not match confirm password.");
        }
    } else {
        alert_danger("Wrong password.");
    }

}

if (isset($_POST["btnSubmit"])) {
    $dataRecord = array();

    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;

    $address = htmlentities($_POST["txtAddress"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $address;

    $phone = htmlentities($_POST["txtPhone"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $phone;

    $state = htmlentities($_POST["txtState"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $state;

    $zipCode = htmlentities($_POST["txtZipCode"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $zipCode;

    $country = htmlentities($_POST["txtCountry"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $country;

    $dataRecord[] = $userId;

    if ($email == "") {
        $emailERROR = true;
        alert_danger("You were not able to add a user.");
    } else {
        $query = 'SELECT * FROM tblUser WHERE fldEmail = ?';
        $results = $thisDatabase->select($query, array($email));
        if(!empty($_POST["id"])) {
            $id = $_POST["id"];
            $dataRecord[] = $id;

            $query = "UPDATE tblContact SET fldEmail = ?, fldAddress = ?, fldPhone = ?, fldState = ?, fldZipCode = ?, fldCountry = ?, fnkUserId = ? WHERE pmkContactId = ?";

            $results = $thisDatabase->update($query, $dataRecord);

            if($results == true) {
                alert_success("You've successfully updated a contact.");
            } else {
                alert_danger("You were not able to update a contact.");
            }
            $email = "";
            $address = "";
            $phone = "";
            $state = "";
            $zipCode = "";
            $country = "";
            $orderBy = 'ORDER BY fldEmail';
        } else {

            $query = "INSERT INTO tblContact SET fldEmail = ?, fldAddress = ?, fldPhone = ?, fldState = ?, fldZipCode = ?, fldCountry = ?, fnkUserId = ?";

            $results = $thisDatabase->insert($query, $dataRecord);

            if($results == true) {
                alert_success("You've successfully added a contact.");
            } else {
                alert_danger("You were not able to add a contact.");
            }
            $email = "";
            $address = "";
            $phone = "";
            $state = "";
            $zipCode = "";
            $country = "";
            $orderBy = 'ORDER BY fldEmail';
        }
    }
} else if (isset($_GET["id"]) && isset($_GET["action"]) == "edit") {
   
    $id = $_GET["id"];
    $dataRecord = array($id);

    $query = "SELECT fldEmail, fldAddress, fldPhone, fldState, fldZipCode, fldCountry FROM tblContact WHERE pmkContactId = ?";
    $results = $thisDatabase->select($query, $dataRecord);

    foreach ($results as $row) {
        $email = $row[0];
        $address = $row[1];
        $phone = $row[2];
        $state = $row[3];
        $zipCode = $row[4];
        $country = $row[5];
    }
} else if (isset($_POST["btnDelete"])) {
    $id = $_POST["id"];
    $dataRecord = array($id);
    $query = 'DELETE FROM tblContact WHERE pmkContactId = ?';

    $results = $thisDatabase->delete($query, $dataRecord);

    if($results == true) {
        alert_success("You've successfully deleted a contact.");
    } else {
        alert_danger("You were not able to delete a contact.");
    }
}
>>>>>>> FETCH_HEAD
?>

<div class="container">

<<<<<<< HEAD
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">Contact form</h2>
                <hr>
                <p>Please fill out the form accurately and press submit. We will contact you with any changes to projects you are involved in.</p>
                <form role="form">
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label>Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Email Address</label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Phone Number</label>
                            <input type="tel" class="form-control">
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-lg-12">
                            <label>Message</label>
                            <textarea class="form-control" rows="6"></textarea>
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="hidden" name="save" value="contact">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
=======
        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                        <strong>Contact</strong>
                    </h2>
                    <hr>

                    <div class="row">
                        <div class="form-group col-lg-4">
                            <!-- Button trigger add contact modal -->
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                Add Contact
                            </button>
                            <!-- Button trigger reset password modal -->
                            <button type="button" class="btn btn-default btn-lg pull-right" data-toggle="modal" data-target="#resetPasswordModal">
                                Reset Password
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Contacts</div>

                        <?php
                        build_list_from_database($thisDatabase, 'contact', 'SELECT pmkContactId, fldEmail, fldPhone, fldAddress, fldState, fldZipCode, fldCountry FROM tblContact WHERE fnkUserId = ' . $userId . ' '.$orderBy);
                        ?>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Add Contact</h4>
                                </div>
                                <form role="form" method="post" action="<?php print $phpSelf; ?>">
                                    <div class="form-group col-lg-4">
                                        <input type="hidden" name="id" value="<?php print $hiddenId ?>"></input>
                                        <label>Email*</label>
                                        <input type="email" name="txtEmail" value="<?php print $email; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label>Address*</label>
                                        <input type="text" name="txtAddress" value="<?php print $address; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Phone*</label>
                                        <input type="tel" name="txtPhone" value="<?php print $phone; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>State*</label>
                                        <input type="text" name="txtState" value="<?php print $state; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Zip Code*</label>
                                        <input type="text" name="txtZipCode" value="<?php print $zipCode; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Country*</label>
                                        <input type="text" name="txtCountry" value="<?php print $country; ?>" class="form-control" required>
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

                    <!-- Reset Password Modal -->
                    <div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="resetPasswordModalLabel">Reset Password</h4>
                                </div>
                                <form role="form" method="post" action="<?php print $phpSelf; ?>">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Password*</label>
                                        <input type="password" name="txtPreviousPassword" id="txtPreviousPassword" class="form-control" aria-invalid="false" required>
                                    </div>
                                    <div class="form-group">
                                        <label>New Password*</label>
                                        <input type="password" name="txtPassword" id="txtPassword" class="form-control" aria-invalid="false" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password*</label>
                                        <input type="password" name="txtConfirmPassword" id="txtConfirmPassword" class="form-control" aria-invalid="false" 
                                        data-validation-match-match="txtPassword" data-validation-match-message="New password must match Confirm Password">
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" name="btnResetPassword">Reset</button>
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
>>>>>>> FETCH_HEAD
            </div>
        </div>
    </div>

<<<<<<< HEAD
</div>
<!-- /.container -->

<?php
include('footer.php');
?>
=======
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
>>>>>>> FETCH_HEAD
