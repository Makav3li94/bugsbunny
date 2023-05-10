<?php

namespace App\Http\Controllers\User;

use App\Models\Admin;
use App\Models\File;
use App\Models\FileTitle;
use App\Models\User;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    use Helpers;

    protected function store(Request $request, User $user)
    {
        if ($request->ajax()) {
            if ($user->id == auth()->user()->id || $user->primary_id == auth()->user()->id) {
                $fileTitlesCount = FileTitle::all()->count();
                $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'fileTitle' => 'required|numeric|integer|min:0|max:' . $fileTitlesCount,
                    'file' => 'required|file|mimes:zip,rar,pdf,jpg,jpeg,png,doc,docx,application/msword|max:5000',
                ]);
                if ($validator->fails()) {
                    return response()->json(['fileError' => $validator->errors()->toArray()]);
                }
                $title = $request->input('title');
                $fileTitle = $request->input('fileTitle');
                $file = $request->file('file');
                $path = '/uploads/files/';
                $file = $this->FileUploader($file, $path);
                $record = File::create([
                    'user_id' => $user->id,
                    'file_title_id' => $fileTitle,
                    'title' => $title,
                    'file' => $file,
                ]);


                $this->handleUserStatus();

                $fileCounts = File::where('user_id', $user->id)->get()->count();
                $file = [
                    0 => $fileCounts,
                    1 => $record->title,
                    2 => $record->fileTitle->title,
                    3 => Hash::make($user->id . $record->id . '!@#__)(FR3'),
                    4 => $record->id,
                    5 => verta($record->created_at)->format('Y-n-j')
                ];
                return response()->json(['fileCreate' => 'submitted', 'file' => $file]);
            }
        }
    }

    protected function destroy(Request $request, File $file)
    {
        if ($request->ajax()) {
            if ($file->user_id == auth()->user()->id || $file->user->primary_id == auth()->user()->id) {
                if (file_exists(public_path($file->file))) {
                    unlink(public_path($file->file));
                }
                $file->delete();
                return response()->json(['deleteFile' => 'success']);
            }
        }
    }

    protected function FileUploader($file, $path)
    {

        $fileName = $file->getClientOriginalName();
        $fileNewName = time() . '-' . $fileName;
        $file->move(public_path($path), $fileNewName);
        return $path . $fileNewName;
    }

    protected function FileDownloader(Request $request, File $file, User $user)
    {
        if ($user->id == auth()->user()->id || $user->primary_id == auth()->user()->id) {
            $mac = $request->input('mac');
            $check = Hash::check($user->id . $file->id . '!@#__)(FR3', $mac);
            if ($check == true) {
                return response()->download(public_path(File::find($file->id)->file));
            } else {
                abort(404);
            }
        }
    }

    /**
     * @return void
     */
    protected function handleUserStatus(): void
    {
        $user = auth()->user();
        $user_cat = $user->company->user_category_id;

        if ($user_cat == 0) {
            $arr = ['شناسنامه', 'کارت ملی'];
            $cats = [$user_cat, 2];
        } elseif ($user_cat == 1) {
            $arr = ['آگهی تاسیس', 'روزنامه رسمی'];
            $cats = [$user_cat, 2];
        }
        $fileTitles = $user->files()->with(["fileTitle" => function ($q) use ($cats) {
            $q->whereIn('file_titles.file_cat', $cats);
        }])->get()->pluck('fileTitle')->toArray();
        $fileTitles = array_column($fileTitles, 'title');
        $count = count(array_intersect($arr, $fileTitles));

        if ($count == 2) {
            if ($user_cat == 1) {
                $user->update(['authStatus' => 2]);
                $this->notifyAdmin($user->id, $user->name, $user->company->company_name, $user->mobile, 'register', 0, 0, 'کاربر حقوقی اطلاعات را تکمیل کرد و منتظر تایید است.');
            } elseif ($user_cat == 0) {
                $user->update(['authStatus' => 3]);
                $this->notifyAdmin($user->id, $user->name, $user->company->company_name, $user->mobile, 'register', 0, 0, 'کاربر حقیقی اطلاعات را تکمیل کرد و منتظر تایید است.');
            }

        }
    }
}
