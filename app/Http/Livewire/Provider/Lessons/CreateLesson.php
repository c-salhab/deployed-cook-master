<?php


namespace App\Http\Livewire\Provider\Lessons;

use App\Models\Lessons;
use \App\Models\Subscription;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateLesson extends Component
{
    use WithFileUploads;

    public $lesson;
    public $lesson_steps = [];
    public $number_lesson_steps = 0;

    public $successMessage;
    public $errorMessage;

    public function createLesson(){

        try{
            $path = $this->lesson['image']->store('lessons');
        }catch (\Exception $e){
            Log::error($e);
            $this->errorMessage = "Couldn't store image.";
        }

        $lesson = Lessons::create([

        ]);

        foreach ($this->lesson_steps as $lesson){
            $path = $lesson['video']->store('lessons');
        }

    }

    public function addStep(){
        $this->number_lesson_steps++;
        $this->lesson_steps[$this->number_lesson_steps - 1]['order'] = $this->number_lesson_steps;
    }

    public function showStep(){
        dd($this->lesson, $this->lesson_steps);
    }

    public function update()
    {
        $this->validate([
            'lesson.image' => 'image|max:1024', // 1MB Max
            'lesson_steps.*.video' => 'image|max:1024', // 1MB Max
        ]);
    }
    public function render()
    {
        $lessons = Lessons::where('creator_id', auth()->user()->id)->get();
        return view('provider.lessons.create')->layout('layouts.provider');
    }
}
