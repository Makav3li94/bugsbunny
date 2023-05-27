<?php

namespace App\Helpers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

function numberConverter($string)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
    $num = range(0, 9);
    $convertedPersianNums = str_replace($persian, $num, $string);
    $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);
    return $englishNumbersOnly;
}

function englishToPersianNumber($string)
{
    //arrays of persian and latin numbers
    $persian_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $latin_num = range(0, 9);

    $string = str_replace($latin_num, $persian_num, $string);

    return $string;
}

function fileUploader($file, $path)
{

    $fileName = $file->getClientOriginalName();
    $fileNewName = time() . '-' . $fileName;
    $file->move(public_path($path), $fileNewName);
    return $path . $fileNewName;
}

function fileDownloader(Request $request, File $file, User $user)
{
    $mac = $request->input('mac');
    $check = Hash::check($user->id . $file->id . '!@#__)(FR3', $mac);
    if ($check == true) {
        return response()->download(public_path(File::find($file->id)->file));
    } else {
        abort(404);
    }
}

