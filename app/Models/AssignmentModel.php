<?php

namespace App\Models;

use CodeIgniter\Model;

class AssignmentModel extends Model
{
    protected $table = 'Assignment';
    protected $primaryKey = 'assignment_id';
    protected $useTimeStamps = 'true';
    protected $allowedFields = ['task_name', 'description', 'id', 'point', 'due_date', 'task'];

    public function getAssignment($assignment_id = false)
    {
        if ($assignment_id == false) {
            return $this->findAll();
        } else {
            return $this->where(['assignment_id' => $assignment_id])->first();
        }
    }
}
