<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'user_id','model_id','model_type'
    ];

    public function sectionLink($id){
        $section = Section::find($id);
        if ($section){
            $route = route('section',$section->slug);
        }else{
            $route = 'javascript:void(0)';
        }
        return $route;
    }
}
