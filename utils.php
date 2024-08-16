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

function get_date_in_assoc_format(string $date_string): array
{
    $date_array = [];
    $x = explode("-", $date_string);
    $date_array['year'] = $x[0];
    $date_array['month'] = $x[1];
    $date_array['day'] = $x[2];
    return $date_array;
}

function get_time_in_assoc_format(string $time_string): array
{
    $time_array = [];
    $x = explode(":", $time_string);
    $time_array['hours'] = $x[0];
    $time_array['minutes'] = $x[1];
    return $time_array;
}

function has_date_passed($dateArray, $timeArray): bool
{
    // Create a DateTime object for the given date and time
    $dateTimeString = $dateArray['year'] . '-' . $dateArray['month'] . '-' . $dateArray['day'] . ' ' .
        $timeArray['hours'] . ':' . $timeArray['minutes'] . ':00';
    $dateTime = new DateTime($dateTimeString);

    // Get the current date and time
    $now = new DateTime();

    // Compare the two DateTime objects
    if ($dateTime < $now) {
        echo "The date already passed";
    }
    return $dateTime < $now;
}
