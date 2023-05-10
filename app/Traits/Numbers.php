<?php

namespace App\Traits;


use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Str;

trait Numbers
{
    function convertNumbers($srting, $toPersian = FALSE)
    {
        $fa_num = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $en_num = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        if ($toPersian) return Str::replace($en_num, $fa_num, $srting);
        else return Str::replace($fa_num, $en_num, $srting);
    }

    public function convertToGoregianDateAndTime($date, $toPersian = FALSE)
    {
        $date = $this->convertNumbers($date, $toPersian);
        $date = explode(' ', $date);
        $date = $date[0];
        $date = explode('/', $date);
        $date = Verta::getGregorian($date[0], $date[1], $date[2]);
        $date = $date[0] . '-' . $date[1] . '-' . $date[2];

        return $date;
    }

    public function convertToJalaliDateAndTime($date, $toPersian = FALSE)
    {
        $date = explode(' ', $date);
        $date = $date[0];
        $date = explode('-', $date);
        $date = Verta::getJalali($date[0], $date[1], $date[2]);
        if ($date[1]<=9)$date[1] = str_pad($date[1], 2, '0', STR_PAD_LEFT);
        if ($date[2]<=9)$date[2] = str_pad($date[2], 2, '0', STR_PAD_LEFT);
        $date = $date[0] . '-' . $date[1] . '-' . $date[2];

        $date =  $this->convertNumbers($date, $toPersian);
        return $date;
    }

    public function convertToGoregianDate($date, $toPersian = FALSE)
    {
        $date = $this->convertNumbers($date, $toPersian);
        $date = explode('/', $date);
        $date = Verta::getGregorian($date[0], $date[1], $date[2]);
        $date = $date[0] . '-' . $date[1] . '-' . $date[2];
              return $date;
    }

    public function convertToJalaliDate($date, $toPersian = FALSE)
    {
        $date = explode('-', $date);
        $date = Verta::getJalali($date[0], $date[1], $date[2]);
        if ($date[1]<=9)$date[1] = str_pad($date[1], 2, '0', STR_PAD_LEFT);
        if ($date[2]<=9)$date[2] = str_pad($date[2], 2, '0', STR_PAD_LEFT);
        $date = $date[0] . '/' . $date[1] . '/' . $date[2];
        $date = $this->convertNumbers($date, $toPersian);
        return $date;
    }
}
