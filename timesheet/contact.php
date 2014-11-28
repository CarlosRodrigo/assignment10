<?php
include("top.php");
//include("header.php"); 
include("nav.php");
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

if(isset($_GET['orderBy'])) {
    $orderBy = "ORDER BY ";
    $orderBy .= htmlentities($_GET["orderBy"], ENT_QUOTES, "UTF-8");
}

if (isset($_POST["btnResetPassword"])) {
    $dataRecord = array();

    $password = htmlentities($_POST["txtPreviousPassword"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $password;

    $newPassword = htmlentities($_POST["txtPassword"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $newPassword;

    $confirmPassword = htmlentities($_POST["txtConfirmPassword"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $confirmPassword;
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
}
?>

    <div class="container">

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
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                Add Contact
                            </button>
                        </div>
                        <div class="form-group col-lg-4">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#resetPasswordModal">
                                Reset Password
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Contacts</div>

                        <?php
                        build_list_from_database($thisDatabase, 'contact', 'SELECT pmkContactId, fldEmail, fldPhone, fldAddress, fldState, fldZipCode, fldCountry FROM tblContact '.$orderBy);
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
                                        <input type="password" name="txtPreviousPassword" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>New Password*</label>
                                        <input type="password" name="txtPassword" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password*</label>
                                        <input type="password" name="txtConfirmPassword" class="form-control" required>
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