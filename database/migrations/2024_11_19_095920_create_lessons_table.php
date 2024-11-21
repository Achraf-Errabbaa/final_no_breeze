<?php  

use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  

class CreateLessonsTable extends Migration  
{  
    public function up()  
    {  
        Schema::create('lessons', function (Blueprint $table) {  
            $table->id();  
            $table->string('title');  
            $table->text('description')->nullable(); 
            $table->string('file')->nullable();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');  
            $table->unsignedInteger('duration')->nullable(); // Duration in minutes  
            $table->timestamps();  
        });  
    }  

    public function down()  
    {  
        Schema::dropIfExists('lessons');  
    }  
}