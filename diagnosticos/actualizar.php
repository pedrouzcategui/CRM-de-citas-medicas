<?php

require_once '../utils.php';
require_once '../csv_functions.php';

$id = get_param_from_url('id');

$diagnostic_description = sanitize_input($_POST['diagnostic_description']);
$diagnostic = find_record_by(DIAGNOSTICS_CSV_FILE, 'id', $id, DIAGNOSTIC_OBJECT_KEYS);
$diagnostic['description'] = $diagnostic_description;

edit_row_from_csv(DIAGNOSTICS_CSV_FILE, 'id', $id, $diagnostic, DIAGNOSTIC_OBJECT_KEYS);
echo "Record with Diagnostic ID: $id - has been updated\n";
echo "<a href='index.php'>Volver a diagnosticos</a>";
