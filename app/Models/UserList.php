<?php

namespace App\Models;

use App\Scopes\UserScope;
use App\Traits\Timezone;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserList extends Model
{
    use HasFactory, Timezone, RefreshDatabase;


    protected $table = 'user_lists';
    protected $fillable = ['user_id', 'title', 'description', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_lists_id', 'id');
    }


    protected static function booted()
    {
        parent::boot();

        static::addGlobalScope(new UserScope());
    }

}
