<?php


namespace App\Http\Livewire\Lessons;

use App\Models\Lessons;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
            $lesson->description = Str::limit($lesson->description, 25);

            if(DB::table('possess_lessons')
                ->where('user_id', auth()->user()->id)
                ->where('lesson_id', $lesson->id)
                ->first()) {
                $lesson['possessed'] = true;
            }else{
                $lesson['possessed'] = false;
            }
            if(DB::table('carts')->where('lesson_id', $lesson->id)->first()){
                $lesson['active'] = true;
            }else{
                $lesson['active'] = false;
            };
        }
        return view('lessons.index', ['lessons' => $lessons])->layout('layouts.app');
    }
}
