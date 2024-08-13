<?php
function render_input(string $type, string $name, string $label, string $value = '', string $placeholder = '', bool $required = false): void
{
    echo "
        <div class='form-control'>
            <label class='block mb-sm' for='$name'>$label</label>
            <input class='form-input' type='$type' name='$name' value='$value' placeholder='$placeholder' " . ($required ? 'required' : "") . "/>
        </div>
    ";
}
