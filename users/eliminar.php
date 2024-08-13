<?php

require_once '../utils.php';
require_once '../csv_functions.php';

$id = get_param_from_url('id');

delete_row_from_csv(USERS_CSV_FILE, 'id', $id, USER_OBJECT_KEYS);

echo "Records Updated";
echo "<a href='/crmmedico/users/index.php'>Volver a usuarios</a>";
