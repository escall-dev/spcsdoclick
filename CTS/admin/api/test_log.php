<?php
$logFile = 'c:\\xampp\\apache\\logs\\error.log';
if (file_exists($logFile)) {
    $lines = file($logFile);
    $last_lines = array_slice($lines, -50);
    echo implode("", $last_lines);
} else {
    echo "Log file not found.";
}
