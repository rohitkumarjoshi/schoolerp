<?php 
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="exam.csv"');
echo $tables; exit();
 ?>