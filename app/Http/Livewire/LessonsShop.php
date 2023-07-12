<?php


namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Lessons;
use App\Models\LessonStep;
use \App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LessonsShop extends Component
{

    public function preview(){

    }

    public function addCart($id){

        DB::table('carts')->insert([
            'user_id' => auth()->user()->id,
            'lesson_id' => $id,]);
    }
    public function removeCart($id){

        DB::table('carts')->where('lesson_id', $id)->delete();
    }

    public function render()
    {
        $lessons = Lessons::all();
        foreach ($lessons as $lesson){
            if(DB::table('carts')->where('lesson_id', $lesson->id)->first()){
                $lesson['active'] = true;
            }else{
                $lesson['active'] = false;
            };
        }
        return view('lessons.index', ['lessons' => $lessons])->layout('layouts.app');
    }
}
