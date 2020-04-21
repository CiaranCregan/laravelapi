<?php

namespace App\Http\Controllers;

use App\Bookings;
use App\User;
use App\Mail\BookingConfirmation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTodaysBookings(){
        $todaysDate = date('Y-m-d');

        $bookings = Bookings::where('date', $todaysDate)->orderBy('time', 'asc')->get();

        return $bookings;
    }
    public function getAllBookings()
    {
        // $lastSunday = date('Y-m-d',strtotime('last sunday')); 
        // $nextSunday = date('Y-m-d',strtotime('next sunday')); 
        // $todaysDate = date('Y-m-d');
        $bookings = Bookings::orderBy('time', 'asc')->get();

        return $bookings;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBookingsByUserId($username)
    {
        $todaysDate = date('Y-m-d');
        $userBookings = Bookings::where('date', '>', $todaysDate);
            // ->orderBy('date', 'desc')
            // ->orderBy('time', 'desc')
            // ->get();

        return $todaysDate;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createNewBooking(Request $request){
        $booking = new Bookings;

        $userDetailsById = User::where('name',$request->username) -> first();

        $booking->user_id = $userDetailsById->id;
        $booking->username = $request->username;
        $booking->date = $request->date;
        $booking->booking_type = $request->booking_type;
        $booking->time = $request->time;

        $booking->save();

        $emailData = array(
            'username' => $userDetailsById->name,
            'date' => $request->date,
            'time' => $request->time,
            'type' => $request->booking_type
        );

        Mail::to($userDetailsById->email)->send(new BookingConfirmation($emailData));

        return $booking;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bookings  $bookings
     * @return \Illuminate\Http\Response
     */
    public function show(Bookings $bookings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bookings  $bookings
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookings $bookings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bookings  $bookings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookings $bookings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bookings  $bookings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookings $bookings)
    {
        //
    }
}
