<?php

namespace App\Http\Controllers;

use App\Classes;
use App\User;
use App\Confirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = Classes::all();

        return $classes;
    }

    public function getTodaysClasses(){
        $todaysDate = date('Y-m-d');

        // $confirms = DB::table('classes')->join('confirms', 'confirms.class_id', 'classes.id')->select('confirms.*')->where('confirms.class_id', 4)->get();

        $todaysClasses = Classes::where('date', $todaysDate)->orderBy('time', 'asc')->get();

        return $todaysClasses;

    }

    public function updateGoingAmountForClass($classId, $userId){
        $addConfirm = new Confirm;

        Classes::where('id', $classId)->increment('going');
        
        $addConfirm->class_id = $classId;
        $addConfirm->user_id = $userId;

        $addConfirm->save();

        return 'Done';
    }

    public function removeBooking($classId, $userId){

        Classes::where('id', $classId)->decrement('going');

        $confirmId = Confirm::where('class_id', $classId)
                            ->where('user_id', $userId)
                            ->first();

        $removeConfirm = Confirm::findOrFail($confirmId->id);

        $removeConfirm->delete();
        
        return $removeConfirm;
    }

    public function getGoingForSpecificClass($id){

        $confirms = DB::table('classes')->join('confirms', 'confirms.class_id', 'classes.id')->select('confirms.*')->where('confirms.class_id', $id)->get();

        return $confirms;
    }

    public function showMyClasses($id){

        $todaysDate = date('Y-m-d');

        $classIds = Confirm::where('user_id', $id)->get();

        foreach($classIds as $id){
            $all[] = Classes::where('id', $id->class_id)->where('date', '>=', $todaysDate)->get()->toArray();
            // $classes = Classes::where('id', $id->class_id)->get();
        };

        return $all;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $classes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $classes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $classes)
    {
        //
    }
}
