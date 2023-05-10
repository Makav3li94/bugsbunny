<?php

namespace App\Http\Controllers\Admin;

use App\Models\File;
use App\Models\FileTitle;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    protected function store(Request $request, User $user)
    {
        if ($request->ajax()) {
            $fileTitlesCount = FileTitle::all()->count();
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'fileTitle' => 'required|numeric|integer|min:0|max:' . $fileTitlesCount,
                'file' => 'required|file|mimes:zip,rar,pdf,jpg,jpeg,png,doc,docx|max:5000',
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
            $fileCounts = File::where('user_id', $user->id)->get()->count();
            $file = [
                0 => $fileCounts,
                1 => $record->title,
                2 => $record->fileTitle->title,
                3 => Hash::make($user->id . $record->id . '!@#__)(FR3'),
                4 => $record->id
            ];
            return response()->json(['fileCreate' => 'submitted', 'file' => $file]);
        }
    }

    protected function destroy(Request $request, File $file)
    {
        if ($request->ajax()) {
            if (file_exists(public_path($file->file))) {
                unlink(public_path($file->file));
            }
            $file->delete();
            return response()->json(['deleteFile' => 'success']);
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
        $mac = $request->input('mac');
        $check = Hash::check($user->id . $file->id . '!@#__)(FR3', $mac);
        if ($check == true) {
            return response()->download(public_path(File::find($file->id)->file));
        } else {
            abort(404);
        }
    }
}
