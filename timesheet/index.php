<?php
    include("top.php");
    //include("header.php"); 
    include("nav.php");
    include("lib/functions.php");

    if(!isset($_SESSION['userID'])) {
        header('location: login.php');
        exit();
    }
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
                            <form name="sentMessage" id="noteFrom" novalidate>
                                <div class="form-group">
                                    <select class="form-control" id="slcProject" name="slcProject" required data-validation-required-message="required.">
                                        <?php build_select_from_database($thisDatabase, 'SELECT pmkProjectId, fldName FROM tblProject ORDER BY fldName'); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Hours*</label>
                                    <input type="text" class="form-control" placeholder="04:00" id="txtHours" name="txtHours" required data-validation-required-message="required.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" id="txtDescription" name="txtDescription"></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
                                        +
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </li>
                        <li class="note">
                            <select class="form-control">
                                <?php build_select_from_database($thisDatabase, 'SELECT pmkProjectId, fldName FROM tblProject ORDER BY fldName'); ?>
                            </select>
                            <label>Hours</label>
                            <input type="text" class="form-control">
                            <label>Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </li>
                        <li class="note">
                            <select class="form-control">
                                <?php build_select_from_database($thisDatabase, 'SELECT pmkProjectId, fldName FROM tblProject ORDER BY fldName'); ?>
                            </select>
                            <label>Hours</label>
                            <input type="text" class="form-control">
                            <label>Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </li>
                        <li class="note">
                            <select class="form-control">
                                <?php build_select_from_database($thisDatabase, 'SELECT pmkProjectId, fldName FROM tblProject ORDER BY fldName'); ?>
                            </select>
                            <label>Hours</label>
                            <input type="text" class="form-control">
                            <label>Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </li>
                        <li class="note">
                            <select class="form-control">
                                <?php build_select_from_database($thisDatabase, 'SELECT pmkProjectId, fldName FROM tblProject ORDER BY fldName'); ?>
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

<!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script type="text/javascript">
    $(function() {

    $("input,textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var hours = $("input#txtHours").val();
            var description = $("textarea#txtDescription").val();
            var project = $("select#slcProject").val();
            
            $.ajax({
                url: "lib/save_note.php",
                type: "POST",
                data: {
                    hours: hours,
                    description: description,
                    project: project
                },
                cache: false,
                success: function() {
                    // Success message
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-success')
                        .append("<strong>Time saved. </strong>");
                    $('#success > .alert-success')
                        .append('</div>');

                    //clear all fields
                    $('#NoteForm').trigger("reset");
                },
                error: function() {
                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append("<strong>Sorry, it seems that the server is not responding. Please try again later!");
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    $('#NoteForm').trigger("reset");
                },
            })
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


/*When clicking on Full hide fail/success boxes */
$('#name').focus(function() {
    $('#success').html('');
});

    </script>

</body>

</html>
