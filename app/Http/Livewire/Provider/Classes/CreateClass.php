<?php


namespace App\Http\Livewire\Provider\Classes;

use App\Models\Classes;
use App\Models\ClassLessons;
use App\Models\Examiner;
use App\Models\Lessons;
use App\Models\LessonStep;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateClass extends Component
{
    use WithFileUploads;

    public $class;
    public $class_lessons;
    public $class_examiners;
    public $number_lessons = 0;
    public $number_examiners = 0;

    public $available_lessons;
    public $available_examiners;

    public $successMessage;
    public $errorMessage;

    public function createClass(){

        try{
            $path = $this->class['image']->store('classes', 'images');

            //Create the product
            try{
                $stripeSecretKey = config('stripe.sk');
                $stripe = new \Stripe\StripeClient($stripeSecretKey);
                $product = $stripe->products->create([
                    'name' => $this->class['title'],
                    'active' => true,
                    'images' => [env('APP_URL') . $path]
                ]);

                //Create a subscription price
                $price = $stripe->prices->create([
                    'unit_amount' => (int)($this->class['price'] * 100),
                    'currency' => 'eur',
                    'product' => $product->id,
                ]);

                try{
                    $class = Classes::create([
                        'title' => $this->class['title'],
                        'description' => $this->class['description'],
                        'image_url' => $path,
                        'difficulty' => $this->class['difficulty'],
                        'price' => $this->class['price'],
                        'created_at' => now(),
                        'updated_at' => now(),
                        'product_id' => $product->id,
                        'price_id' => $price->id,
                    ]);
                    try{
                        foreach ($this->class_lessons as $lesson){
                            ClassLessons::create([
                                'class_id' => $class->id,
                                'lesson_id' => $lesson['id'],
                                'order' => $lesson['order']
                            ]);
                        }
                    }catch (Exception $e){
                        Log::error($e);
                        $this->errorMessage = "Couldn't add lessons in database.";
                    }
                    try{
                        foreach ($this->class_examiners as $examiner){
                            Examiner::create([
                                'user_id' => $examiner['id'],
                                'class_id' => $class->id,
                            ]);
                        }
                    }catch (Exception $e){
                        Log::error($e);
                        $this->errorMessage = "Couldn't add lessons in database.";
                    }
                }catch (Exception $e){
                    Log::error($e);
                    $this->errorMessage = "Couldn't create class in database.";
                }
            }catch(Exception $e){
                Log::error($e);
                $this->errorMessage = "Stripe api error occurred.";
            }
        }catch (\Exception $e){
            Log::error($e);
            $this->errorMessage = "An error occurred.";
        }
        $this->successMessage = "Certificated course has been created successfully !";
    }

    public function addLesson(){
        if ($this->number_lessons == 0 || (isset($this->class_lessons[$this->number_lessons - 1]['id']) && $this->class_lessons[$this->number_lessons - 1]['id'] != 0)) {
            $this->number_lessons++;
            $this->class_lessons[$this->number_lessons - 1]['order'] = $this->number_lessons;
        }
    }

    public function addExaminer(){
        if ($this->number_examiners == 0 || (isset($this->class_examiners[$this->number_examiners - 1]['id']) && $this->class_examiners[$this->number_examiners - 1]['id'] != 0)) {
            $this->number_examiners++;
        }
    }

    public function checkClass(){
        dd($this->class, $this->class_lessons);
    }
    public function render()
    {
        $this->available_lessons = Lessons::all();
        $this->available_examiners = User::where('role','provider')->get();
        return view('provider.classes.create', ['available_lessons' => $this->available_lessons, 'available_examiners' => $this->available_examiners])->layout('layouts.provider');
    }
}
