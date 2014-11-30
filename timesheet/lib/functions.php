<?php
function build_select_from_database($thisDatabase, $query, $selectedId = 1) {
    $results = $thisDatabase->select($query);

    foreach ($results as $row) {
        $id = $row[0];
        $data = $row[1];
        if($id == $selectedId) {
            print '<option value="' . $id . '" selected>' . $data . '</option>';
        } else {
            print '<option value="' . $id . '">' . $data . '</option>';
        }
    }
}

function build_list_from_database($thisDatabase, $fileName, $query) {
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
                    $keyName = preg_replace(' /(?<! )(?<!^)(?<![A-Z])[A-Z]/', ' $0', substr($key, 3));
                    print "<th><a href='" . $fileName . ".php?orderBy=" . $key . "'>" . $keyName . "</a></th>";
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
                <a href="' . $fileName . '.php?action=delete&id=' . $id . '" id="btnDelete" name="btnDelete" type="submit" class="btn btn-danger pull-right">Delete</a>
                <a href="' . $fileName . '.php?action=edit&id=' . $id .'" class="btn btn-default edit glyphicon glyphicon-edit pull-right"></a>
                </td>';
        print "</tr>";
    }
    print "</table>";
}

function build_statistics_list_from_database($thisDatabase, $fileName, $query) {
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
                    $keyName = preg_replace(' /(?<! )(?<!^)(?<![A-Z])[A-Z]/', ' $0', substr($key, 3));
                    print "<th><a href='" . $fileName . ".php?orderBy=" . $key . "'>" . $keyName . "</a></th>";
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
                <a href="' . $fileName . '.php?action=showBarChart&id=' . $id .'" class="btn btn-default glyphicon glyphicon-stats pull-right"></a>
                </td>';
        print "</tr>";
    }
    print "</table>";
}


function generate_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}

function sendMail($to, $cc, $bcc, $from, $subject, $message){ 
    $MIN_MESSAGE_LENGTH=40;
    
    $blnMail=false;
    
    $to = filter_var($to, FILTER_SANITIZE_EMAIL);
    $cc = filter_var($cc, FILTER_SANITIZE_EMAIL);
    $bcc = filter_var($bcc, FILTER_SANITIZE_EMAIL);
   
    $subject = htmlentities($subject,ENT_QUOTES,"UTF-8");
     
    // just checking to make sure the values passed in are reasonable
    if(empty($to)) return false;
    if(!filter_var($to, FILTER_VALIDATE_EMAIL)) return false;
    
    if($cc!="") if(!filter_var($cc, FILTER_VALIDATE_EMAIL)) return false;
    
    if($bcc!="") if(!filter_var($bcc, FILTER_VALIDATE_EMAIL)) return false;
    
    if(empty($from)) return false;
    
    if(empty($subject)) return false;
    
    if(empty($message)) return false;
    if (strlen($message)<$MIN_MESSAGE_LENGTH) return false;
    
    /* message */
    $messageTop  = '<html><head><title>' . $subject . '</title></head><body>';
    $mailMessage = $messageTop . $message;

    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    $headers .= "From: " . $from . "\r\n";

    if ($cc!="") $headers .= "CC: " . $cc . "\r\n";
    if ($bcc!="") $headers .= "Bcc: " . $bcc . "\r\n";

    /* this line actually sends the email */
    $blnMail=mail($to, $subject, $mailMessage, $headers);
    
    return $blnMail;
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