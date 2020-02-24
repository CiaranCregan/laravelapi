<?php

namespace App\Http\Controllers;

use App\Bookings;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getMyBookings($user_id){
        $userBookings = Bookings::where('user_id', $user_id)->get();

        return $userBookings;
    }
}
