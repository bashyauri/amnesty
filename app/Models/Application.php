<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Application extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = ['id'];
    protected $table = 'application_form';
    public function state()
    {
        return $this->belongsTo(State::class, 'stateid');
    }


    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'account_id');
    }
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}