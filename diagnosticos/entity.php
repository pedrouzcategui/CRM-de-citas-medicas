<?php
require_once '../utils.php';
require_once '../middleware.php';
require_once '../csv_functions.php';

function find_diagnostic(string $diagnostic_id): array
{
    $diagnostic = find_record_by(DIAGNOSTICS_CSV_FILE, 'id', $diagnostic_id, DIAGNOSTIC_OBJECT_KEYS);
    if (!$diagnostic) throw new Exception("No diagnostic with ID: $diagnostic_id was found");
    return $diagnostic;
}

function create_diagnostic(array $diagnostic_fields): array
{
    $diagnostic = add_row_to_csv(DIAGNOSTICS_CSV_FILE, $diagnostic_fields, DIAGNOSTIC_OBJECT_KEYS);
    return $diagnostic;
}

function update_diagnostic(string $diagnostic_id, array $new_diagnostic_fields): array
{
    $diagnostic = find_diagnostic($diagnostic_id);
    $updated_diagnostic = edit_row_from_csv(DIAGNOSTICS_CSV_FILE, 'id', $diagnostic['id'], $new_diagnostic_fields, DIAGNOSTIC_OBJECT_KEYS);
    return $updated_diagnostic;
}

function delete_diagnostic(string $diagnostic_id)
{
    $diagnostic = find_diagnostic($diagnostic_id);
    return delete_row_from_csv(DIAGNOSTICS_CSV_FILE, 'id', $diagnostic['id'], DIAGNOSTIC_OBJECT_KEYS);
}
