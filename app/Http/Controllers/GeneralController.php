<?php

namespace App\Http\Controllers;

use App\Bookings;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function updateUserInformation(Request $request, $id){
        $user = User::findOrFail($id);

        return $user;
    }

    public function attendClass($user_id){
        return 'Hello';
    }
}
