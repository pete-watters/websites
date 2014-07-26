<?php
if ($_GET['randomId'] != "3MNfZl2mCfRVYb_wQNEcevEvzKEP1l_rgHl22fE9Q8pqyhKi5_ZXE9m9lJIUalUd") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
