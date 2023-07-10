<?php


namespace App\Http\Livewire\Provider\Lessons;

use App\Models\Lessons;
use \App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateLesson extends Component
{
    use WithFileUploads;

    public $lesson;
    /*
    public $title;
    public $description;
    public $price;
    public $image;
    public $difficulty;
    */
    public $lesson_steps = [];
    public $number_lesson_steps = 0;

    public function createLesson(){

    }

    public function render()
    {
        $lessons = Lessons::where('creator_id', auth()->user()->id)->get();
        return view('provider.lessons.create')->layout('layouts.provider');
    }
}
