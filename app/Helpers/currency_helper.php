<?php
function format_currency($amount, $decimals = 2) {
    return number_format($amount, $decimals, '.', ',');
}


//Currency to words conversion

function numberToWords($num) {
    $units = [
        '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine',
        'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen',
        'seventeen', 'eighteen', 'nineteen'
    ];

    $tens = [
        '', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'
    ];

    $thousands = [
        '', 'thousand', 'million', 'billion'
    ];

    if ($num == 0) {
        return 'zero';
    }

    $words = [];
    $chunks = splitNumber($num);
    
    foreach ($chunks as $i => $chunk) {
        if ($chunk) {
            $words[] = chunkToWords($chunk) . ' ' . $thousands[$i];
        }
    }

    return trim(implode(' ', array_reverse($words)));
}

function chunkToWords($chunk) {
    $units = [
        '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine',
        'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen',
        'seventeen', 'eighteen', 'nineteen'
    ];

    $tens = [
        '', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'
    ];

    $words = [];

    // Handle hundreds
    if ($chunk >= 100) {
        $words[] = $units[(int)($chunk / 100)] . ' hundred';
        $chunk %= 100;
    }

    // Handle tens and units
    if ($chunk < 20) {
        $words[] = $units[$chunk];
    } else {
        $words[] = $tens[(int)($chunk / 10)];
        if ($chunk % 10) {
            $words[] = $units[$chunk % 10];
        }
    }

    return trim(implode(' ', $words));
}

function splitNumber($num) {
    // Splits the number into chunks of 3 digits
    $chunks = [];
    while ($num > 0) {
        $chunks[] = $num % 1000;
        $num = (int)($num / 1000);
    }
    return $chunks;
}

function currency_to_words($amount) {
    // Split into whole and decimal parts
    $wholePart = floor($amount);
    $decimalPart = round(($amount - $wholePart) * 100); // Convert to cents

    // Convert to words
    $wholePartWords = numberToWords($wholePart);
    $decimalPartWords = numberToWords($decimalPart);

    $result = "Qatari Riyals {$wholePartWords}";
    
    if ($decimalPart > 0) {
        $result .= " & {$decimalPartWords} Dirhams";
    } else {
        $result .= " only";
    }

    return $result;
    
}
