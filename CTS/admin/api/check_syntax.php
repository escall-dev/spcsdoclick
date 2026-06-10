<?php
$file = 'c:/xampp/htdocs/sdoclick/CTS/admin/api/update-status.php';
exec("php -l " . escapeshellarg($file), $output, $return_var);
echo "Return var: $return_var\n";
echo "Output: \n" . implode("\n", $output);
