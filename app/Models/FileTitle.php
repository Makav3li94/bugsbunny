<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileTitle extends Model
{
    use SoftDeletes;
    protected $dates = [];
    protected $guarded = [];

    public function file()
    {
        return $this->hasOne(File::class);
    }
}
