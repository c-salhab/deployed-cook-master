<?php


namespace App\Http\Livewire\Manager;

use App\Models\Classes;
use App\Models\Examiner;
use App\Models\Lessons;
use App\Models\LessonStep;
use \App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowClasses extends Component
{
    public $successMessage;
    public function validateClass(Classes $class){
        dd($class);
        DB::table('classes')->update(['validated' => 1]);
        $this->successMessage = 'Course got validated ! Wouhou.';
    }
    public function deleteClass(Classes $class){
        $class->delete();
        $this->successMessage = 'Course successfully deleted.';
    }
    public function render()
    {
        $classes = Classes::all();
        return view('management.classes.index', ['classes' => $classes])->layout('layouts.management');
    }
}
