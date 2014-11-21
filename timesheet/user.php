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
$firstName = "";
$lastName = "";

if (isset($_POST["btnSubmit"])) {
    $dataRecord = array();

    $password = sha1(time());
    $dataRecord[] = $password;

    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;

    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;

    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lastName;

    if ($email == "") {
        $emailERROR = true;
        alert_danger("You were not able to add a user.");
    } else {
        $query = 'SELECT * FROM tblUser WHERE fldEmail = ?';
        $results = $thisDatabase->select($query, array($email));
        if(count($results) > 0) {
            $dataRecord[] = $email;
            $query = 'UPDATE tblUser SET fldPassword = ?, fldEmail = ?, fldFirstName = ?, fldLastName = ? WHERE fldEmail = ?';

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
            $query = 'INSERT INTO tblUser SET fldPassword = ?, fldEmail = ?, fldFirstName = ?, fldLastName = ?';

            $results = $thisDatabase->insert($query, $dataRecord);

            if($results == true) {
                alert_success("You've successfully add a user.");
            } else {
                alert_danger("You were not able to add a user.");
            }
        }
    }
} else if (isset($_GET["id"])) {
   
    $id = $_GET["id"];
    $dataRecord = array($id);

    $query = "SELECT fldEmail, fldFirstName, fldLastName FROM tblUser WHERE pmkUserId = ?";
    $results = $thisDatabase->select($query, $dataRecord);

    foreach ($results as $row) {
        $email = $row[0];
        $firstName = $row[1];
        $lastName = $row[2];
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
                        <ul class="list-group">
                            <?php build_list_from_database($thisDatabase, 'SELECT pmkUserId, fldFirstName FROM tblUser ORDER BY fldFirstName');?>
                        </ul>
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
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input type="email" name="txtEmail" value="<?php print $email; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>First Name*</label>
                                        <input type="text" name="txtFirstName" value="<?php print $firstName; ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name*</label>
                                        <input type="text" name="txtLastName" value="<?php print $lastName; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" name="btnSubmit">Save</button>
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
    var id = getUrlVars()["id"];
    if(typeof id !== "undefined") {
        //alert(id);
        $('#myModal').modal('show');
    }
});
</script>