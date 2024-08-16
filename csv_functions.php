<?php

require_once 'globals.php';
require_once 'utils.php';

function map_row_values_to_entity(array $entity_keys, array $values): array
{
    $keys_length = count($entity_keys);
    $values_length = count($values);
    if ($keys_length != $values_length) {
        pretty_dump($entity_keys);
        pretty_dump($values);
        die("ERROR: Entity Keys Length does not match Values Length match");
    }
    return array_combine($entity_keys, $values);
}

function get_csv_as_array(string $filename, array $entity_keys)
{
    $file_array = [];
    $lines_array = file($filename);
    for ($i = 0; $i < count($lines_array); $i++) {
        $line = $lines_array[$i];
        $fields = explode(',', $line);
        $record = map_row_values_to_entity($entity_keys, $fields);
        array_push($file_array, $record);
    }
    return $file_array;
}

function find_record_by(string $filename, string $key_of_interest, string $value_to_find, array $entity_keys): array | null
{
    $lines_array = file($filename);
    for ($i = 0; $i < count($lines_array); $i++) {
        $line = $lines_array[$i];
        $fields = explode(',', $line);
        $row_assoc_array = map_row_values_to_entity($entity_keys, $fields);
        $value_of_interest = $row_assoc_array[$key_of_interest];
        $value_to_find = sanitize_input($value_to_find);
        if ($value_of_interest == $value_to_find) {
            return map_row_values_to_entity($entity_keys, $fields);
        }
    }
    return null;
}

function find_records_by_id(string $filename, string $key_of_interest, string $value_to_find, array $entity_keys): array
{
    $records = [];
    $lines_array = file($filename);
    for ($i = 0; $i < count($lines_array); $i++) {
        $line = $lines_array[$i];
        $fields = explode(',', $line);
        $row_assoc_array = map_row_values_to_entity($entity_keys, $fields);
        $value_of_interest = $row_assoc_array[$key_of_interest];
        $value_to_find = sanitize_input($value_to_find);
        if ($value_of_interest == $value_to_find) {
            array_push($records, map_row_values_to_entity($entity_keys, $fields));
        }
    }
    return $records;
}

function add_row_to_csv(string $filename, array $fields, array $entity_keys)
{
    if (!file_exists($filename)) die("File $filename doesn't exist");
    $file = fopen($filename, 'a') or die("File $filename can't be opened.");
    $csv_line = implode(",", $fields) . "\n";
    fwrite($file, $csv_line);
    fclose($file);
    return map_row_values_to_entity($entity_keys, $fields);
}

function edit_row_from_csv(string $filename, string $key_of_interest, string $value_to_find, array $new_fields, array $entity_keys)
{
    $lines_array = file($filename);
    for ($i = 0; $i < count($lines_array); $i++) {
        $line = $lines_array[$i];
        $fields = explode(',', $line);
        $row_assoc_array = map_row_values_to_entity($entity_keys, $fields);
        $value_of_interest = $row_assoc_array[$key_of_interest];
        $value_to_find = sanitize_input($value_to_find);
        if ($value_of_interest == $value_to_find) {
            array_splice($lines_array, $i, 1);
            $csv_line = implode(",", $new_fields);
            array_push($lines_array, $csv_line);
        }
    }
    $new_file = fopen($filename, 'w') or die("Unable to open file '$filename'");
    foreach ($lines_array as $line) {
        $fields = explode(",", $line);
        $csv_line = implode(",", $fields);
        fputs($new_file, $csv_line);
    }
    fclose($new_file);

    return map_row_values_to_entity($entity_keys, $fields);
}

function delete_row_from_csv(string $filename, string $key_of_interest, string $value_to_find, array $entity_keys)
{
    $lines_array = file($filename);
    for ($i = 0; $i < count($lines_array); $i++) {
        $line = $lines_array[$i];
        $fields = explode(',', $line);
        $row_assoc_array = map_row_values_to_entity($entity_keys, $fields);
        $value_of_interest = $row_assoc_array[$key_of_interest];
        $value_to_find = sanitize_input($value_to_find);
        if ($value_of_interest == $value_to_find) {
            array_splice($lines_array, $i, 1);
            break;
        }
        if ($i == count($lines_array) - 1) {
            die("Unable to find value of interest");
            return false;
        }
    }
    $new_file = fopen($filename, 'w') or die("Unable to open file '$filename'");
    foreach ($lines_array as $line) {
        $fields = explode(",", $line);
        $csv_line = implode(",", $fields);
        fputs($new_file, $csv_line);
    }
    fclose($new_file);

    return true;
}

function get_filtered_records(array $fields_of_interest, string $filename, array $entity_keys)
{
    $mapped_records = [];
    $records = get_csv_as_array($filename, $entity_keys);
    foreach ($records as $record) {
        array_push($mapped_records, map_row_values_to_entity($entity_keys, $record));
    }
    $filtered_records = array_map(function ($record) use ($fields_of_interest) {
        $x = [];
        foreach ($fields_of_interest as $key) {
            $x[$key] = $record[$key];
        }
        return $x;
    }, $mapped_records);
    return $filtered_records;
}

function get_unique_records(array $records)
{
    $unique_records = [];

    foreach ($records as $record) {
        $id = $record['id'];
        $name = $record['name'];

        if (!isset($unique_records[$id])) {
            $unique_records[$id] = $name;
        }
    }

    return $unique_records;
}

function convert_array_into_csv_row($fields): string
{
    return implode(",", $fields) . "\n";
}

function get_count_of_records_if(array $records, string $field_of_interest, string $value_to_find): int
{
    $number_of_occurrences = 0;
    foreach ($records as $record) {
        if ($record[$field_of_interest] == $value_to_find) {
            $number_of_occurrences++;
        }
    }
    return $number_of_occurrences;
}

function get_records_where(array $records, string $field_of_interest, string $value_to_find): array
{
    $conditional_records = [];
    foreach ($records as $record) {
        if ($record[$field_of_interest] == $value_to_find) {
            array_push($conditional_records, $record);
        }
    }
    return $conditional_records;
}

function does_value_exist_in_array(array $records_array, string $field_of_interest, string $value_to_find): bool
{
    foreach ($records_array as $item) {
        if ($item[$field_of_interest] == $value_to_find) return true;
    }
    return false;
}
