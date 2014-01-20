<?php

$morse_table = array(
    '.-'    => 'A', '-...'  => 'B', '-.-.'  => 'C', '-..'   => 'D',
    '.'     => 'E', '..-.'  => 'F', '--.'   => 'G', '....'  => 'H',
    '..'    => 'I', '.---'  => 'J', '-.-'   => 'K', '.-..'  => 'L',
    '--'    => 'M', '-.'    => 'N', '---'   => 'O', '.--.'  => 'P',
    '--.-'  => 'Q', '.-.'   => 'R', '...'   => 'S', '-'     => 'T',
    '..-'   => 'U', '...-'  => 'V', '.--'   => 'W', '-..-'  => 'X',
    '-.--'  => 'Y', '--..'  => 'Z', '-----' => '0', '.----' => '1',
    '..---' => '2', '...--' => '3', '....-' => '4',
    '.....' => '5', '-....' => '6', '--...' => '7',
    '---..' => '8', '----.' => '9', ''      => ' '
);

foreach (file($argv[1]) as $line) {
    $decoded = "";
    foreach (explode(" ", trim($line)) as $symbol) {
        $decoded .= $morse_table[$symbol];
    }
    echo "$decoded\n";
}