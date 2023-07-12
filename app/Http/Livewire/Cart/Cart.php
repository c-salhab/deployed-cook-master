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
        $number_items = 0;
        $total_price = 0;

        $recipes_id = [];
        $lessons_id = [];
        $classes_id = [];

        foreach($cart as $element){
            $number_items += 1;
            if($element->recipe_id){
                $recipes_id[] = $element->recipe_id;
            }elseif($element->lesson_id){
                $lessons_id[] = $element->lesson_id;
            }else{
                $classes_id[] = $element->class_id;
            }
        }

        $recipes = [];
        $lessons = [];
        $classes = [];

        if(!empty($recipes_id)){
            foreach ($recipes_id as $id){
                $recipes[] = DB::table('recipes')->where('id', '=', $id)->get();
            }
            foreach ($recipes as $recipe){
                $total_price += $recipe[0]->price;
            }
        }
        if(!empty($lessons_id)){
            foreach ($lessons_id as $id){
                $lessons[] = DB::table('lessons')->where('id', '=', $id)->get();
            }
            foreach ($lessons as $lesson){
                $total_price += $lesson[0]->price;
            }
        }
        if(!empty($classes_id)){
            foreach ($classes_id as $id){
                $classes[] = DB::table('classes')->where('id', '=', $id)->get();
            }
            foreach ($classes as $class){
                $total_price += $class[0]->price;
            }
        }
        return view('cart.index', ['recipes' => $recipes, 'lessons' => $lessons, 'classes' => $classes, 'number_items' => $number_items, 'total_price' => $total_price])->layout('layouts.app');
    }
}
