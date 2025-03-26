<?php

use DinoEngine\Core\Model;

class ProgressEnrollment extends Model {
    
    protected static $table = 'progress_enrollment';
    protected static $PK_name = 'id_progress';
    protected static $columns = ['id_progress', 'completed', 'id_enrollment', 'id_lesson'];
    protected static $fillable = ['completed'];

    public ?int $id_progress;
    public bool $completed;
    public int $id_enrollment;
    public int $id_lesson;

    public function __construct($args = []){
        $this->id_progress = $args["id_progress"]??null;
        $this->completed = $args["completed"]??true;
        $this->id_enrollment = $args["id_enrollment"]??0;
        $this->id_lesson = $args["id_lesson"]??0;
    }

    public function validate(){

    }
}