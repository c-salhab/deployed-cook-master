<?php


namespace App\Http\Livewire\Provider\Classes;

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
    public function render()
    {
        $classes_affiliated = Examiner::where('user_id', '=', auth()->user()->id)->get();
        $classes = [];
        foreach ($classes_affiliated as $class){
            $classes[] = $class->class_id;
        }

        $classes_collections = [];
        foreach ($classes as $id){
            $classes_collections[] = Classes::find($id);
        }
        return view('provider.classes.index', ['classes' => $classes_collections])->layout('layouts.provider');
    }
}
