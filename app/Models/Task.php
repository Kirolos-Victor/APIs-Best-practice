<?php

namespace App\Models;

use App\Traits\Timezone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, Timezone;

    protected $table = 'tasks';
    protected $fillable = ['title', 'description', 'deadline', 'user_lists_id', 'status', 'created_at', 'updated_at'];


}
