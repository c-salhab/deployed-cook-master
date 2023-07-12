<?php


namespace App\Http\Livewire\Courses;

use App\Models\Classes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class CoursesShop extends Component
{

    public function addCart($id){

        DB::table('carts')->insert([
            'user_id' => auth()->user()->id,
            'class_id' => $id,]);
    }
    public function removeCart($id){

        DB::table('carts')->where('class_id', $id)->delete();
    }

    public function render()
    {
        $classes = Classes::all();
        foreach ($classes as $class){
            $class->description = Str::limit($class->description, 25);

            if(DB::table('possess_classes')
                ->where('user_id', auth()->user()->id)
                ->where('class_id', $class->id)
                ->first()) {
                $class['possessed'] = true;
            }else{
                $class['possessed'] = false;
            }
            if(DB::table('carts')->where('class_id', $class->id)->first()){
                $class['active'] = true;
            }else{
                $class['active'] = false;
            };
        }
        return view('courses.index', ['classes' => $classes])->layout('layouts.app');
    }
}
