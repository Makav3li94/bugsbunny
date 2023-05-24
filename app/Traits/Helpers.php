<?php

namespace App\Traits;


use App\Models\Admin;
use App\Models\File;
use App\Notifications\AdminNotifications;
use Notification;

trait Helpers
{
    private function notifyAdmin($user_id, $name,  $mobile, $type, $type_id, $status, $message = null)
    {
        $details = [
            'user_id' => $user_id,
            'name' => $name,
            'mobile' => $mobile,
            'type' => $type,
            'type_id' => $type_id,
            'status' => $status,
            'message' => $message
        ];
        $users = Admin::all();
        Notification::send($users, new AdminNotifications($details));
    }

    public function storeFile($file, $title, $file_title_id = null, $path = null)
    {

        $fc = $this->FileUploader($file, $path);
        $file = File::create([
            'user_id' => auth()->id(),
            'file_title_id' => $file_title_id,
            'title' => $title,
            'file' => $fc,
        ]);
        return $file->id;
    }

    protected function FileUploader($file, $path)
    {
        $fileName = $file->getClientOriginalName();
        $fileNewName = time() . '-' . $fileName;
        $file->move(public_path($path), $fileNewName);
        return $path . $fileNewName;
    }

    protected function readMFNotification($user_id, $type, $type_id)
    {
        foreach (auth()->user()->unreadNotifications as $notification) {
            if ($notification->data['user_id'] == $user_id && $notification->data['type'] == $type && $notification->data['type_id'] == $type_id)
                $notification->markAsRead();
        }
    }

    public function status($status,$type){
        if ($status == 1){
            $details = ['type'=>$type,'status'=>'تایید شده'];
        }elseif ($status == 2){
            $details = ['type'=>$type,'status'=>'رد شده'];
        }
        return $details;
    }
}
