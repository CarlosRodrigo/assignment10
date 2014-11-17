<?php
include("top.php");
//include("header.php"); 
include("nav.php");

if (isset($_POST["btnSubmit"])) {
    print '<p>submit</p>';
}
?>
    
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Add Project</h2>
                    <hr>
                    <form role="form" action="<?php print $phpSelf; ?>">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Project Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Budget</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Expected Hours</label>
                                <input type="email" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Description</label>
                                <textarea class="form-control" rows="6"></textarea>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-12">
                                <button type="submit" id="btnSubmit" class="btn btn-default">Add</button>
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
