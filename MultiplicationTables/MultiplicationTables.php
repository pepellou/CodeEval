<?php

for ($i = 1; $i <= 12; $i++) {
    $line = "";
    for ($j = 1; $j <= 12; $j++) {
        $next = $i * $j;
        while (strlen($next) < 4) {
            $next = " " . $next;
        }
        $line .= $next;
    }
    echo trim($line)."\n";
}
