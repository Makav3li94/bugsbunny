<?php


namespace App\Helpers;

use App\Models\LogActivity as LogActivityModel;


class LogActivity{

    public static function addToLog($subject,$model_type,$model_id){

        $log = [];
        $log['subject'] = $subject;
        $log['url'] = request()->fullUrl();
        $log['method'] = request()->method();
        $log['ip'] = request()->ip();
        $log['agent'] = request()->header('user-agent');
        $log['user_id'] = auth()->check() ? auth()->id() : 1;
        $log['model_id'] = $model_id;
        $log['model_type'] = $model_type;
        LogActivityModel::create($log);

    }

    public static function logActivityLists(){
        return LogActivityModel::latest()->get();
    }

}
