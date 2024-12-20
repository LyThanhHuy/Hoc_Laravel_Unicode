<?php

function isUppercase($value, $message, $fail) {
    if ($value !== mb_strtoupper($value, 'UTF-8')) {
        // xay ra loi
        $fail($message);
    }
}

?>