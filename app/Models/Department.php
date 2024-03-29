<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function programs()
    {
        return $this->belongsToMany(Program::class);
    }
}
