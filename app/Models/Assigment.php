<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assigment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'subjects',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
