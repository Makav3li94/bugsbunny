<?php

namespace App\Models;

use App\Interfaces\Likeable;
use App\Traits\HasLikes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pishran\LaravelPersianSlug\HasPersianSlug;
use Spatie\Sluggable\SlugOptions;

class Section extends Model implements Likeable
{
    use HasFactory,HasLikes,HasPersianSlug;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }
    public function latestReply()
    {
        return $this->hasOne(Reply::class)->latest();
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

    public function hasDone($user_id){
        return $this->quizHeaders->where('user_id', $user_id)->count() > 0;
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
