<?php
include("top.php");
//include("header.php"); 
include("lib/functions.php");
?>

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12 text-center">
                <form class="form-horizontal" method="post" action="/cs148/assignment10/timesheet/check_login.php" id="login_form">
                    <div class="control-group">
                        <label class="control-label" for="username">Username</label>
                        <div class="controls">
                            <input type="text" id="username" name="user_name" placeholder="Username">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <label class="checkbox">
                            <input type="checkbox"> Remember me
                            </label>
                            <input name="Submit" type="submit" id="submit" value="Login" class="btn btn-success"/>
                            <input type="reset" name="Reset" value="Reset" class="btn"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>   
    </div>
</div> <!-- /container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>