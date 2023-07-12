<?php


namespace App\Http\Livewire\Cart;

use App\Models\Lessons;
use App\Models\LessonStep;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Cart extends Component
{
    public function render()
    {
        $cart = \App\Models\Cart::where('user_id', auth()->user()->id)->get();
        $recipes_id = [];
        $events_id = [];
        $lessons_id = [];
        $classes_id = [];

        foreach($cart as $element){
            if($element->recipe_id){
                $recipes_id[] = $element->recipe_id;
            }elseif ($element->event_id){
                $events_id[] = $element->event_id;
            }elseif($element->lesson_id){
                $lessons_id[] = $element->lesson_id;
            }else{
                $classes_id[] = $element->class_id;
            }
        }

        $recipes = [];
        $events = [];
        $lessons = [];
        $classes = [];

        if(!empty($recipes_id)){
            foreach ($recipes_id as $id){
                $recipes[] = DB::table('recipes')->where('id', '=', $id)->get();
            }
        }
        if(!empty($events_id)){
            foreach ($events_id as $id){
                $events[] = DB::table('events')->where('id', '=', $id)->get();
            }
        }
        if(!empty($lessons_id)){
            foreach ($lessons_id as $id){
                $lessons[] = DB::table('lessons')->where('id', '=', $id)->get();
            }
        }
        if(!empty($classes_id)){
            foreach ($classes_id as $id){
                $classes[] = DB::table('classes')->where('id', '=', $id)->get();
            }
        }
        dd($recipes, $events, $lessons, $classes);
        return view('cart.index', ['recipes' => $recipes, 'events' => $events, 'lessons' => $lessons, 'classes' => $classes])->layout('layouts.app');
    }
}
