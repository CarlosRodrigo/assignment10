<?php
include("top.php");
//include("header.php"); 
include("nav.php");

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

    $query = 'INSERT INTO tblProject SET fldName = ?, fldBudget = ?, fldExepctedHours = ?, fldDescription = ?';

    $results = $thisDatabase->insert($query, $dataRecord);
    
    print_r($results);
}

?>
    
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Add <strong>Project</strong></h2>
                    <hr>
                    <form action="<?php print $phpSelf; ?>" method="post">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Project Name</label>
                                <input type="text" name="txtProjectName" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Budget</label>
                                <input type="text" name="txtBudget" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Expected Hours</label>
                                <input type="text" name="txtExpectedHours" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Description</label>
                                <textarea name="txtDescription" class="form-control" rows="6"></textarea>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-12">
                                <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-default">Add</button>
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
