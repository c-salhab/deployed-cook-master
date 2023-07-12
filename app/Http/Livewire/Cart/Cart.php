<?php


namespace App\Http\Livewire\Cart;

use App\Models\Lessons;
use App\Models\LessonStep;
use App\Models\PossessClasse;
use App\Models\PossessLesson;
use App\Models\PossessRecipe;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Cart extends Component
{
    public $coupon_recipes_used = 0;
    public $coupon_lessons_used = 0;
    public $coupon_classes_used = 0;

    public $recipes = [];
    public $lessons = [];
    public $classes = [];
    public $successMessage;
    public $total_price = 0;
    public function checkout(){

        if($this->total_price == 0){
            $this->success();
        }else{
            $items = [];

            foreach ($this->recipes as $recipe){
                $items[] = ['price' => $recipe[0]['price_id'], 'quantity' => 1];
            }
            foreach ($this->lessons as $lesson){
                $items[] = ['price' => $lesson[0]['price_id'], 'quantity' => 1];
            }
            foreach ($this->classes as $class){
                $items[] = ['price' => $class[0]['price_id'], 'quantity' => 1];
            }

            $stripeSecretKey = config('stripe.sk');
            $stripe = new \Stripe\StripeClient($stripeSecretKey);
            $checkout_session = $stripe->checkout->sessions->create([
                'success_url' => route('cart.checkout.success'),
                'cancel_url' => route('cart.checkout.cancel'),
                'line_items' => [
                    $items
                ],
                'mode' => 'payment',
            ]);

            return redirect()->away($checkout_session->url);
        }
    }
    public function render()
    {
        $cart = \App\Models\Cart::where('user_id', auth()->user()->id)->get();
        $number_items = 0;

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

        $this->recipes = [];
        $this->lessons = [];
        $this->classes = [];

        if(!empty($recipes_id)){
            foreach ($recipes_id as $id){
                $this->recipes[] = DB::table('recipes')->where('id', '=', $id)->get();
            }
            foreach ($this->recipes as $recipe){
                $this->total_price += $recipe[0]->price;
            }
        }
        if(!empty($lessons_id)){
            foreach ($lessons_id as $id){
                $this->lessons[] = DB::table('lessons')->where('id', '=', $id)->get();
            }
            foreach ($this->lessons as $lesson){
                $this->total_price += $lesson[0]->price;
            }
        }
        if(!empty($classes_id)){
            foreach ($classes_id as $id){
                $this->classes[] = DB::table('classes')->where('id', '=', $id)->get();
            }
            foreach ($this->classes as $class){
                $this->total_price += $class[0]->price;
            }
        }
        return view('cart.index', ['recipes' => $this->recipes, 'lessons' => $this->lessons, 'classes' => $this->classes, 'number_items' => $number_items, 'total_price' => $this->total_price])->layout('layouts.app');
    }

    public function success(){
        foreach ($this->recipes as $recipe){
            PossessRecipe::create([
                'user_id' => auth()->user()->id,
                'recipe_id' => $recipe[0]['id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        foreach ($this->lessons as $lesson){
            PossessLesson::create([
                'user_id' => auth()->user()->id,
                'lesson_id' => $lesson[0]['id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        foreach ($this->classes as $class){
            PossessClasse::create([
                'user_id' => auth()->user()->id,
                'class_id' => $class[0]['id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->recipes_id = [];
        $this->lessons_id = [];
        $this->classes_id = [];

        \App\Models\Cart::where('user_id', auth()->user()->id)->delete();
        $this->successMessage = 'Payment successful ! Go check your product :D';
        return view('cart.checkout.success');
    }
}
