<?php

namespace App\Http\Controllers;

use App\Bookings;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getMyBookings($id){
        $userBookings = Bookings::where('user_id', $id)->get();

        return $userBookings;
    }
}
