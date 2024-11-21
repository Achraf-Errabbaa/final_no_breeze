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
        'course_id',
        'file', 
        'duration', 
    ];  

    public function class()  
    {  
        return $this->belongsTo(Course::class);  
    }  
}  