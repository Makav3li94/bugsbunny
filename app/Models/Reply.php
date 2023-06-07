<?php

namespace App\Models;

use App\Interfaces\Likeable;
use App\Traits\HasLikes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model implements Likeable
{
    use HasFactory,HasLikes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children(){
        return $this->hasMany(Reply::class, 'parent_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
