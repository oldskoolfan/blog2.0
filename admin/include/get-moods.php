<?php
require __dir__ . '/../../include/mysql.php';

$moods = $con->query('select * from moods');
