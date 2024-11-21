<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classmodel extends Model
{
    use HasFactory; 

    protected $fillable = ['name', 'max_participants'];  

    public function courses()  
    {  
        return $this->hasMany(Course::class,'class_id');  
    }
}
