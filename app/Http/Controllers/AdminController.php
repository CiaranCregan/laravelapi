<?php

namespace App\Http\Controllers;

use App\User;
use App\Bookings;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        $users = User::where('isAdmin', 0)->get();

        return $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDropdownUsers()
    {
        $users = User::select('name')->where('isAdmin', 0)->get();

        $usersNameArray = array('-- Please select a user --');

        foreach($users as $user){
            array_push($usersNameArray, $user->name);
        }

        return $usersNameArray;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllBookings()
    {
        $bookings = Bookings::all();

        return $bookings;
    }

    public function showUserBookings($user_id){
        $bookings = Bookings::where('user_id', $user_id)
                            ->orderBy('date')
                            ->orderBy('time')
                            ->get();

        return $bookings;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
