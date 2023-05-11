<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable=[
        'q_user',
        'q_name',
        'q_email',
        'q_department',
        'q_programe',
        'q_title',
        'q_description',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
