<?php

require_once '../diagnosticos/entity.php';

require_once '../utils.php';
require_once '../csv_functions.php';

$diagnostic_id = get_param_from_url('id');

$diagnostic_description = sanitize_input($_POST['diagnostic_description']);
$diagnostic = find_diagnostic($diagnostic_id);
$diagnostic['description'] = $diagnostic_description;

update_diagnostic($diagnostic_id, $diagnostic);

echo "Record with Diagnostic ID: $diagnostic_id - has been updated\n";
echo "<a href='index.php'>Volver a diagnosticos</a>";
