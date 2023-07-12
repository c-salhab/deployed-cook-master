<?php


namespace App\Http\Livewire\Courses;

use App\Models\Lessons;
use App\Models\LessonStep;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CoursePage extends Component
{

    public $lesson_id;
    public $duration = 0;

    public function mount($lesson_id){
        $this->lesson_id = $lesson_id;
    }

    public function render()
    {
        $lesson = Lessons::where('id', $this->lesson_id)->first();
        $this->duration = 0;
        $lesson_steps = LessonStep::where('lesson_id', $this->lesson_id)->orderBy('order')->get();
        foreach ($lesson_steps as $step){
            $this->duration += $step->duration;
        }
        $creator = User::where('id', $lesson->creator_id)->first();
        return view('lessons.page', ['lesson' => $lesson, 'lesson_steps'=> $lesson_steps,'duration'=> $this->duration, 'creator'=> $creator])->layout('layouts.app');
    }
}
