<?php

namespace App\Models;


use App\Notifications\AdminNotifications;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notification;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles, HasFactory;

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function fromTask()
    {
        return $this->hasMany(Task::class, 'id', 'from_id');
    }

    public function toTask()
    {
        return $this->hasMany(Task::class, 'id', 'to_id');
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function todos()
    {
        return $this->hasMany(User::class, 'id', 'marketer_id');
    }


}
