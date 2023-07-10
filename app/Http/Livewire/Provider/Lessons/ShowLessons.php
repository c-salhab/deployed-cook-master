<?php


namespace App\Http\Livewire\Provider\Lessons;

use App\Models\Lessons;
use \App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowLessons extends Component
{
    public function render()
    {
        $lessons = Lessons::where('creator_id', auth()->user()->id)->get();
        return view('provider.lessons.index', ['lessons' => $lessons])->layout('layouts.provider');
    }
}
