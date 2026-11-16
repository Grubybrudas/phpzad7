<?php

function obliczProcent($punkty) {
    return $punkty . "%";
}

function przyznajOcene($punkty) {
    if ($punkty >= 90 && $punkty <= 100) {
        return 5;
    } elseif ($punkty >= 80) {
        return 4;
    } elseif ($punkty >= 60) {
        return 3;
    } elseif ($punkty >= 40) {
        return 2;
    } else {
        return 1;
    }
}

function czyZdal($punkty) {
    if ($punkty >= 40) {
        return true;
    } else {
        return false;
    }
}
