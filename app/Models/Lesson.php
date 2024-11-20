<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class Lesson extends Model  
{  
    use HasFactory;  

    protected $fillable = [  
        'title',  
        'description',  
        'class_id',  
        'duration', // duration in minutes  
    ];  

    public function class()  
    {  
        return $this->belongsTo(Course::class);  
    }  
}  