<?php
    include("top.php");
    //include("header.php"); 
    include("nav.php");
?>
    
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Add User</h2>
                    <hr>
                    <form role="form">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>First Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Last Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email Address</label>
                                <input type="email" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Type</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Position</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Admission Date</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Adress</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>State</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Zip Code</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Country</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="save" value="contact">
                                <button type="submit" class="btn btn-default">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->
<?php 
    include('footer.php');
?>
