<?php

require_once '../utils.php';

function render_select(string $name, string $label, array $options, string $id_key = '', string $value_key = '', string $selected_value = '')
{
    $select_html = "<div class='form-control'>";
    $select_html .= "<label class='block mb-sm' for='$name'>$label</label>";
    $select_html .= "<select class='form-input' name='$name' required>";
    if ($id_key != '' && $value_key != '') {
        foreach ($options as $key => $option) {
            $id = $option[$id_key];
            $value = $option[$value_key];
            if ($selected_value != '' && $selected_value == $id) {
                $select_html .= "<option value='$id' selected>$id - $value</option>";
            } else {
                $select_html .= "<option value='$id'>$id - $value</option>";
            }
        }
    } else {
        foreach ($options as $key => $option) {
            if ($selected_value != '' && $selected_value == $key) {
                $select_html .= "<option value='$key' selected>$option</option>";
            } else {
                $select_html .= "<option value='$key'>$option</option>";
            }
        }
    }
    $select_html .= "</select></div>";

    return $select_html;
}
