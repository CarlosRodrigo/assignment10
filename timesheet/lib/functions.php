<?php
function build_select_from_database($thisDatabase, $query) {
    $results = $thisDatabase->select($query);

    foreach ($results as $row) {
        $data = $row[0];
        print '<option value="' . $data . '">' . $data . '</option>';
    }
}
?>