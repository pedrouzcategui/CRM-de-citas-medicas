<?php

require_once 'globals.php';

function pretty_dump(array $fields): void
{
    echo "<pre>";
    var_dump($fields);
    echo "</pre>";
}

function dd(...$data): void
{
    foreach ($data as $var) {
        if (!is_array($var)) {
            echo $var . "<br/>";
            continue;
        }
        pretty_dump($var);
    }
    die();
}

function get_days_as_string_from_days_array(array $days_array): string
{
    $days = array();
    foreach ($days_array as $day_character) {
        array_push($days, DAYS[$day_character]);
    }
    return implode(" ", $days);
}

function sort_by_field(array $records, string $field_of_interest, $desc = false): array
{
    // Using usort for flexibility and efficiency
    usort($records, function ($a, $b) use ($field_of_interest, $desc) {
        $valueA = $a[$field_of_interest];
        $valueB = $b[$field_of_interest];

        if ($valueA == $valueB) {
            return 0;
        }

        if ($desc) {
            return $valueB > $valueA ? -1 : 1;
        } else {
            return $valueA < $valueB ? -1 : 1;
        }
    });

    return $records;
}

function sanitize_input($string)
{
    return trim($string);
}


function get_param_from_url(string $param)
{
    $value = $_GET[$param];
    if (!isset($value)) die("Fatal Error");
    return $value;
}
