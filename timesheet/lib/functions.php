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

    print "<table class='table'>";

    $firstTime = true;

    /* since it is associative array display the field names */
    foreach ($results as $row) {
        $id = $row[0];
        if ($firstTime) {
            print "<thead><tr>";
            $keys = array_keys($row);
            foreach ($keys as $key) {
                if (!is_int($key)) {
                    $key = preg_replace(' /(?<! )(?<!^)(?<![A-Z])[A-Z]/', ' $0', substr($key, 3));
                    print "<th>" . $key . "</th>";
                }
            }
            print "</tr>";
            $firstTime = false;
        }
        
        /* display the data, the array is both associative and index so we are
         *  skipping the index otherwise records are doubled up */
        print "<tr>";
        foreach ($row as $field => $value) {
            if (!is_int($field)) {
                print "<td>" . $value . "</td>";
            }
        }
        print '<td>
                <a href="lib/deleteUser.php?id=' . $id . '" id="btnDelete" name="btnDelete" type="submit" class="btn btn-danger" style="float:right">Delete</a>
                <a href="user.php?action=edit&id=' . $id .'" class="btn btn-default edit glyphicon glyphicon-edit" style="float:right"></a>
                </td>';
        print "</tr>";
    }
    print "</table>";
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