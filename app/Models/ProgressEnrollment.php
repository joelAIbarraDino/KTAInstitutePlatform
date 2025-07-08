<?php

namespace App\Models;

use DinoEngine\Core\Model;

class ProgressEnrollment extends Model {
    
    protected static string $table = 'progress_enrollment';
    protected static string $PK_name = 'id_progress';
    protected static array $columns = ['id_progress', 'completed', 'id_enrollment', 'id_lesson'];
    protected static array $fillable = ['completed', 'id_enrollment', 'id_lesson'];

    public ?int $id_progress;
    public int $completed;
    public int $id_enrollment;
    public int $id_lesson;

    public function __construct($args = []){
        $this->id_progress = $args["id_progress"]??null;
        $this->completed = $args["completed"]??1;
        $this->id_enrollment = $args["id_enrollment"]??0;
        $this->id_lesson = $args["id_lesson"]??0;
    }

    public function validate(){

    }
}