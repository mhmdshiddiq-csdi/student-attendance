<?php

namespace App\Livewire\Teacher\Students;

use App\Models\Student;
use Livewire\Component;

class StudentList extends Component
{
    public function render()
    {
        return view('livewire.teacher.students.student-list', [
            'students' => Student::all(),
        ]);
    }
}
