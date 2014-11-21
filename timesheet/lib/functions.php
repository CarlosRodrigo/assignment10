<?php
function build_select_from_database($thisDatabase, $query) {
    $results = $thisDatabase->select($query);

    foreach ($results as $row) {
        $id = $row[0];
        $data = $row[1];
        print '<option value="' . $id . '">' . $data . '</option>';
    }
}

function build_list_from_database($thisDatabase, $query) {
    $results = $thisDatabase->select($query);

    foreach ($results as $row) {
        $id = $row[0];
        $data = $row[1];
        print '<li class="list-group-item">' . $data . '
        <a href="lib/deleteUser.php?id=' . $id . '" id="btnDelete" name="btnDelete" type="submit" class="btn btn-danger" style="float:right">Delete</a>
        <a href="modalEdit.php?id=' . $id .'" class="btn edit glyphicon glyphicon-edit" style="float:right"></a>
        </li>';
    }
}

function alert_success($message) {
    print "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>"
        . $message . "
        </div>";
}

function alert_danger($message) {
    print "<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>"
        . $message . "
        </div>";
}

?>