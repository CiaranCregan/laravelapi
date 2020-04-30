<?php

namespace App\Http\Controllers;

use App\Bookings;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getMyBookings($user_id){
        $todaysDate = date('Y-m-d');
        $userBookings = Bookings::where('user_id', $user_id)
                        ->where('date', '<', $todaysDate)
                        ->orderBy('date')
                        ->orderBy('time')
                        ->get();

        return $userBookings;
    }

    public function getTodaysBookings($user_id){
        $todaysDate = date('Y-m-d');
        $userBookings = Bookings::where('user_id', $user_id)
                        ->where('date', '=', $todaysDate)
                        ->orderBy('date')
                        ->orderBy('time')
                        ->get();

        return $userBookings;
    }

    public function getFutureBookings($user_id){
        $todaysDate = date('Y-m-d');
        $userBookings = Bookings::where('user_id', $user_id)
                        ->where('date', '>', $todaysDate)
                        ->orderBy('date')
                        ->orderBy('time')
                        ->get();

        return $userBookings;
    }

    public function attendClass($user_id){
        return 'Hello';
    }
}
