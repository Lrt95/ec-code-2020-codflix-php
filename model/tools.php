<?php

/**
 * Class Tools
 */
class Tools
{
    /**
     * Tools constructor.
     */
    public function __construct()
    { }


    /**
     * Function to create HTML Select
     * @param string $name
     * @param array $options
     * @param string $label
     */
    public function createSelect($name, $options, $label) : void
    {
        echo '<div class="input-group mb-3">';
        echo '<div class="input-group-prepend">';
        echo '<label class="input-group-text" for= "' . $name . '">' . $label . '</label>';
        echo '</div>';
        echo '<select class="custom-select" id="' . $name . '" name ="' . $name . '">';
        foreach($options as $key => $value)
        {
            echo '<option value=' . $key . '>' .  $value . '</option>';
        }
        echo '</select>';
        echo '</div>';
    }

    public function createInput($type, $id, $name, $value, $class, $placeholder){
        echo '<input type="' .
            $type . '" id="' .
            $id .'" name="' .
            $name . '" value="' .
            $value .  '" class="' .
            $class . '"placeholder="' .
            $placeholder .'"/>';
    }

    public function createButton($type, $class, $value){
        echo '<button type="' . $type . '" class="' . $class . '">' . $value . '</button>';
    }
}

?>
