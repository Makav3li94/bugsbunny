<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function quizHeaders()
    {
        return $this->hasMany(QuizHeader::class);
    }
}
