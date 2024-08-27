<?php
function format_currency($amount, $decimals = 2) {
    return number_format($amount, $decimals, '.', ',');
}
