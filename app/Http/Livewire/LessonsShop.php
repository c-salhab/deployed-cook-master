<?php


namespace App\Http\Livewire;

use App\Models\Lessons;
use App\Models\LessonStep;
use \App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LessonsShop extends Component
{
    public function render()
    {
        $lessons = Lessons::all();
        return view('lessons.index', ['lessons' => $lessons])->layout('layouts.app');
    }
}
