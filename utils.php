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

function ordenar_por_fecha($a, $b)
{
    // Convertimos las fechas a objetos DateTime para una comparación precisa
    $fecha_a = new DateTime($a['Fecha']);
    $fecha_b = new DateTime($b['Fecha']);

    // Comparamos las fechas. Si $a es más reciente que $b, retorna -1
    return $fecha_b->getTimestamp() - $fecha_a->getTimestamp();
}

function sort_by_field(array $records): array
{
    usort($records, 'ordenar_por_fecha');
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

function build_datetime_from_date_and_time_array($dateArray, $timeArray): DateTime
{
    $dateTimeString = $dateArray['year'] . '-' . $dateArray['month'] . '-' . $dateArray['day'] . ' ' .
        $timeArray['hours'] . ':' . $timeArray['minutes'] . ':00';
    return new DateTime($dateTimeString);
}

function has_date_passed($dateArray, $timeArray): bool
{
    $dateTime = build_datetime_from_date_and_time_array($dateArray, $timeArray);

    $now = new DateTime();

    if ($dateTime < $now) {
        echo "The date already passed";
    }

    return $dateTime < $now;
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

function get_readable_date_spanish(string $fecha_formato_db)
{
    // Convertimos la fecha en un objeto DateTime para facilitar la manipulación
    $fecha = new DateTime($fecha_formato_db);

    // Definimos un array asociativo para los nombres de los meses
    $meses = array(
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre'
    );

    $dia = $fecha->format('d');
    $mes = $fecha->format('m');
    $ano = $fecha->format('Y');

    return "$dia de $meses[$mes], $ano";
}

function military_to_standard_time($military_time)
{
    // Split the hours and minutes
    list($hours, $minutes) = explode(':', $military_time);

    // Convert hours to integer
    $hours = intval($hours);

    // Determine AM or PM and adjust hours if necessary
    $period = ($hours >= 12) ? 'PM' : 'AM';
    $hours = ($hours > 12) ? $hours - 12 : $hours;

    // If hours is 0, set it to 12
    $hours = ($hours == 0) ? 12 : $hours;

    // Return the time in standard format
    return "$hours:$minutes $period";
}
