<?php

if (!function_exists('journal_voucher')) {
    function journal_voucher($id,$pref) {
        $length_code   = 6;
        $string_code   = substr(str_repeat(0, $length_code).$id, - $length_code);
        $order_uid = $pref.$string_code;
        return $order_uid;
    }
}


?>