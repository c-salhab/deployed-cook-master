<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Materials;
use App\Models\Rentals;
use App\Models\RentalProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;

class CouponController extends Controller
{

    public function createCoupon(Request $request){

        $stripeSecretKey = config('stripe.sk');


    }
}
