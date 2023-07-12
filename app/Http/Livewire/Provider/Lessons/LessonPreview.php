<?php


namespace App\Http\Livewire\Provider\Lessons;

use App\Models\Lessons;
use App\Models\LessonStep;
use \App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LessonPreview extends Component
{

    public $lesson_id;
    public $duration = 0;

    public function mount($lesson_id){
        $this->lesson_id = $lesson_id;
    }
    public function render()
    {
        $lesson = Lessons::where('id', $this->lesson_id)->first();
        $lesson_steps = LessonStep::where('lesson_id', $this->lesson_id)->get();
        foreach ($lesson_steps as $step){
            $this->duration += $step->duration;
        }
        return view('lessons.preview', ['lesson' => $lesson, 'duration'=> $this->duration])->layout('layouts.app');
    }
}
