<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ticket extends Model
{
    use SoftDeletes;
    protected $dates=['deleted_at'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

}
