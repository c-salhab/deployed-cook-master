<?php


namespace App\Http\Livewire\Lessons;

use App\Models\Lessons;
use App\Models\LessonStep;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LessonPreview extends Component
{

    public $lesson_id;
    public $duration = 0;

    public function mount($lesson_id){
        $this->lesson_id = $lesson_id;
    }

    public function addCart(){
        DB::table('carts')->insert([
            'user_id' => auth()->user()->id,
            'lesson_id' => $this->lesson_id,]);
    }

    public function removeCart($id){

        DB::table('carts')->where('lesson_id', $this->lesson_id)->delete();
    }
    public function render()
    {
        $lesson = Lessons::where('id', $this->lesson_id)->first();
        $this->duration = 0;
        if(DB::table('possess_lessons')
            ->where('user_id', auth()->user()->id)
            ->where('lesson_id', $this->lesson_id)
            ->first()) {
            $lesson['possessed'] = true;
        }else{
            $lesson['possessed'] = false;
        }
        if(DB::table('carts')->where('lesson_id', $this->lesson_id)->first()){
            $lesson['active'] = true;
        }else{
            $lesson['active'] = false;
        };
        $lesson_steps = LessonStep::where('lesson_id', $this->lesson_id)->get();
        foreach ($lesson_steps as $step){
            $this->duration += $step->duration;
        }
        $creator = User::where('id', $lesson->creator_id)->first();
        return view('lessons.preview', ['lesson' => $lesson, 'duration'=> $this->duration, 'creator'=> $creator])->layout('layouts.app');
    }
}
