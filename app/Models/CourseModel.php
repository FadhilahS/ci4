<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'Course';
    protected $useTimeStamps = 'true';
    protected $allowedFields = ['course_name', 'trainer_name', 'description', 'sampul'];

    public function getCourse($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
