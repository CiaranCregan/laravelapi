<?php

namespace App\Http\Controllers;

use App\Bookings;
use App\User;
use App\Mail\BookingConfirmation;
use App\Mail\BookingDeleted;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class BookingsController extends Controller
{
    
    public function getTodaysBookings(){
        $todaysDate = date('Y-m-d');

        $bookings = Bookings::where('date', $todaysDate)->orderBy('time', 'asc')->get();

        return $bookings;
    }
    public function getAllBookings()
    {
        $bookings = Bookings::orderBy('time', 'asc')->get();

        return response()->json(['hello' => $bookings], 201);
    }

    public function getBookingsByUserId($username)
    {
        $todaysDate = date('Y-m-d');
        $userBookings = Bookings::where('date', '>', $todaysDate);

        return Response::json($todaysDate, 200);
    }

    public function createNewBooking(Request $request){
        $booking = new Bookings;

        $userDetailsById = User::where('name',$request->username) -> first();

        // check other bookings
        $duplicateBooking  = Bookings::where('date', '=', $request->date)
                                    ->where('time', '=', $request->time)
                                    ->get();

        if ($duplicateBooking->count()){
            return response()->json('There is already a booking for the following time and date', 405);
        } else {

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

            return response()->json($booking, 201);
        }
    }

    public function updateBooking (Request $request, $booking_id){
        $booking = Bookings::findOrFail($booking_id);

        $userDetailsById = User::where('name', $request->username) -> first();

        // check other bookings
        $duplicateBooking  = Bookings::where('date', '=', $request->date)
                                    ->where('time', '=', $request->time)
                                    ->get();

        if ($duplicateBooking->count()){
            return response()->json('There is already a booking for the following time and date', 405);
        } else {

            $booking->user_id = $userDetailsById->id;
            $booking->username = $request->username;
            $booking->date = $request->date;
            $booking->booking_type = $request->booking_type;
            $booking->time = $request->time;

            $booking->save();

            // $emailData = array(
            //     'username' => $userDetailsById->name,
            //     'date' => $request->date,
            //     'time' => $request->time,
            //     'type' => $request->booking_type
            // );

            // Mail::to($userDetailsById->email)->send(new BookingConfirmation($emailData));

            return response()->json($booking, 201);
        }

        $booking->save();

        return $booking;
    }

    public function destroy($bookingId)
    {
        $booking = Bookings::findOrFail($bookingId);

        if ($booking){
            $userDetailsById = User::where('id', $booking->user_id) -> first();

            // $emailData = array(
            //         'username' => $userDetailsById->name,
            //         'date' => $booking->date,
            //         'time' => $booking->time,
            //         'type' => $booking->booking_type
            //     );
    
            // Mail::to($userDetailsById->email)->send(new BookingDeleted($emailData));
            $booking->delete(); 
        } else {
            return response()->json(error);
        }
        return response()->json(null, 202);
    }
}
