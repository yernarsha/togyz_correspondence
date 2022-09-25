<?php

function getResult($res) {
    if ($res == 1) return '1-0';
    else if ($res == -1) return '0-1';
    else if ($res == 0) return '1/2-1/2';

    return '';
}

function normalize($s) {
    $s = str_replace(PHP_EOL, '<br>', $s);
    $s = str_replace(" ", "&nbsp;", $s);

    return $s;
}