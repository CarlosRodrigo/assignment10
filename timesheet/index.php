<?php
    include("top.php");
    //include("header.php"); 
    include("nav.php");
    include("lib/functions.php");
?>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Report
                        <strong>Time Log</strong>
                    </h2>
                    <hr>
                </div>
                <ul id="notes">
                        <li class="note">
                            <select class="form-control">
                                <?php build_select_from_database($thisDatabase, 'SELECT fldName FROM tblProject ORDER BY fldName'); ?>
                            </select>
                            <label>Hours</label>
                            <input type="text" class="form-control">
                            <label>Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </li>
                        <li class="note">
                            <select class="form-control">
                                <?php build_select_from_database($thisDatabase, 'SELECT fldName FROM tblProject ORDER BY fldName'); ?>
                            </select>
                            <label>Hours</label>
                            <input type="text" class="form-control">
                            <label>Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </li>
                        <li class="note">
                            <select class="form-control">
                                <?php build_select_from_database($thisDatabase, 'SELECT fldName FROM tblProject ORDER BY fldName'); ?>
                            </select>
                            <label>Hours</label>
                            <input type="text" class="form-control">
                            <label>Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </li>
                        <li class="note">
                            <select class="form-control">
                                <?php build_select_from_database($thisDatabase, 'SELECT fldName FROM tblProject ORDER BY fldName'); ?>
                            </select>
                            <label>Hours</label>
                            <input type="text" class="form-control">
                            <label>Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </li>
                        <li class="note">
                            <select class="form-control">
                                <?php build_select_from_database($thisDatabase, 'SELECT fldName FROM tblProject ORDER BY fldName'); ?>
                            </select>
                            <label>Hours</label>
                            <input type="text" class="form-control">
                            <label>Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </li>
                    </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- /.container -->

<?php 
    include('footer.php');
?>