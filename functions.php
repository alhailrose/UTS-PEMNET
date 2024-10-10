<?php
function showError($message, $type = 'error') {
    $class = '';
    if ($type == 'error') {
        $class = 'error';
    } elseif ($type == 'success') {
        $class = 'success';
    } elseif ($type == 'warning') {
        $class = 'warning';
    }
    echo "<div class='$class'>$message</div>";
}
?>
