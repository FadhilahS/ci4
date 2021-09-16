<?php

namespace App\Models;

use CodeIgniter\Model;

class AssignmentModel extends Model
{
    protected $table = 'Assignment';
    protected $useTimeStamps = 'true';
    protected $allowedFields = ['assignment_id', 'task_name', 'slug', 'description', 'id', 'point', 'due_date'];

    public function getAssignment($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        } else {
            return $this->where(['slug' => $slug])->first();
        }
    }
}
