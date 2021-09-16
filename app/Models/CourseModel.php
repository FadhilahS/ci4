<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'Course';
    protected $useTimeStamps = 'true';
    protected $allowedFields = ['course_name', 'slug', 'trainer_name', 'description', 'sampul'];

    public function getCourse($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        } else {
            return $this->where(['slug' => $slug])->first();
        }
    }
}
