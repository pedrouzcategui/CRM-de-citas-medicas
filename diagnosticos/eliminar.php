<?php

require_once '../utils.php';

$id = $_GET['id'];

if (isset($id)) {
    delete_row_from_csv(DIAGNOSTICS_CSV_FILE, 'id', $id, array_keys(DIAGNOSTIC_OBJECT));
    echo "Record Deleted";
    echo "<a href='/crmmedico/citas/index.php'>Volver a diagnosticos</a>";
    return;
}

echo "No record found with ID $id";
