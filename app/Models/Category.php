<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function activeSections()
    {
        return $this->hasMany(Section::class)->where([['status', 2], ['kind', 0]]);
    }
}
