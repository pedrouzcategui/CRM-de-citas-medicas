<?php

require_once '../utils.php';

function render_table(array $keys, array $values, array $extra_action_values = [], bool $edit_disabled = false, bool $delete_disabled = false, array $hidden_fields = [])
{
    $table = " <table>
            <thead>" . generate_table_header($keys, $edit_disabled, $delete_disabled, $hidden_fields) . "</thead>
            <tbody>" . generate_table_rows($values, $extra_action_values, $edit_disabled, $delete_disabled, $hidden_fields) . "</tbody>
        </table>";
    echo $table;
}

function generate_table_header(array $keys, bool $edit_disabled, bool $delete_disabled, array $hidden_fields = [])
{
    $header_cells_string = "<tr>";
    foreach ($keys as $key) {
        $header_cells_string .= "<td>$key</td>";
    }
    if (!$edit_disabled || !$delete_disabled) {
        $header_cells_string .= "<td>Acciones</td>";
    }
    $header_cells_string .= "</tr>";
    return $header_cells_string;
}

function generate_table_rows(array $rows, array $extra_action_values = [], bool $edit_disabled, bool $delete_disabled, array $hidden_fields = [])
{
    $table_rows = "";
    foreach ($rows as $row) {
        $fields = explode(',', $row);
        $table_rows .= "<tr>";
        foreach ($fields as $field) {
            $table_rows .= "<td>$field</td>";
        }
        if (!$edit_disabled || !$delete_disabled || !empty($extra_action_values)) {
            $table_rows .= "<td>";
            if (!$edit_disabled) {
                $table_rows .= "<a class='table-action table-action-edit' href='editar.php?id=$fields[0]'>Editar </a>";
            }
            if (!$delete_disabled) {
                $table_rows .= "<a class='table-action table-action-delete' href='eliminar.php?id=$fields[0]'>Eliminar </a>";
            };
            if (!empty($extra_action_values)) {
                $filename = $extra_action_values['filename'];
                $label = $extra_action_values['label'];
                $table_rows .= "<a class='table-action table-action-extra' href='$filename?id=$fields[0]'>$label </a>";
            }
            $table_rows .= "</td>";
        }

        $table_rows .= "</tr>";
    }
    return $table_rows;
}


function render_table_2(array $records, array $extra_action_values = [], bool $edit_disabled = false, bool $delete_disabled = false, array $hidden_fields = [])
{
    $table = " <table>
            <thead>" . generate_table_header_2($records, $edit_disabled, $delete_disabled, $hidden_fields) . "</thead>
            <tbody>" . generate_table_rows_2($records, $extra_action_values, $edit_disabled, $delete_disabled, $hidden_fields) . "</tbody>
        </table>";
    echo $table;
}

function generate_table_header_2(array $records, bool $edit_disabled, bool $delete_disabled, array $hidden_fields = [])
{
    $header_cells_string = "<tr>";
    foreach ($records as $row) {
        $keys = array_keys($row);
        foreach ($keys as $key) {
            $header_cells_string .= "<td>$key</td>";
        }
        break;
    }
    if (!$edit_disabled || !$delete_disabled) {
        $header_cells_string .= "<td>Acciones</td>";
    }
    $header_cells_string .= "</tr>";
    return $header_cells_string;
}

function generate_table_rows_2(array $records, array $extra_action_values = [], bool $edit_disabled, bool $delete_disabled, array $hidden_fields = [])
{
    $table_rows = "";
    foreach ($records as $row) {
        $table_rows .= "<tr>";
        foreach ($row as $key => $value) {
            $table_rows .= "<td>$value</td>";
        }
        if (!$edit_disabled || !$delete_disabled || !empty($extra_action_values)) {
            $id = $row['id'];
            $table_rows .= "<td>";
            if (!$edit_disabled) {
                $table_rows .= "<a class='table-action table-action-edit' href='editar.php?id=$id'>Editar </a>";
            }
            if (!$delete_disabled) {
                $table_rows .= "<a class='table-action table-action-delete' href='eliminar.php?id=$id'>Eliminar </a>";
            };
            if (!empty($extra_action_values)) {
                $filename = $extra_action_values['filename'];
                $label = $extra_action_values['label'];
                $table_rows .= "<a class='table-action table-action-extra' href='$filename?id=$id'>$label</a>";
            }
            $table_rows .= "</td>";
        }

        $table_rows .= "</tr>";
    }
    return $table_rows;
}
