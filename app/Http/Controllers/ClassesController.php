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
        $todaysDate = date('Y-m-d');
        $classes = Classes::where('date', '>=', $todaysDate)->get();

        return $classes;
    }

    public function createClass(Request $request){
        $class = new Classes;

        $duplicateClass = Classes::where('date', '=', $request->date)
                                    ->where('time', '=', $request->time)
                                    ->get();

        if ($duplicateClass->count()){
            return response()->json('There is already a class for the following time and date', 405);
        } else {
            $class->title = $request->title;
            $class->date = $request->date;
            $class->time = $request->time;
            $class->class_length = $request->class_length;
            $class->going = $request->going;

            $class->save();

            return response()->json($class, 201);
        }
    }

    public function deleteClass($classId)
    {
        $class = Classes::findOrFail($classId);

        if ($class){
            $doesClassHaveConfirms = Confirm::where('class_id', $classId)->get();

            if ($doesClassHaveConfirms->count()){
                foreach($doesClassHaveConfirms as $remove){
                    DB::table('confirms')
                        ->where('class_id', $remove->class_id)->delete();
                }   
            }
            $class->delete(); 
        } else {
            return response()->json(error);
        }
        return response()->json(null, 202);
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

        $confirms = DB::table('classes')
                    ->join('confirms', 'confirms.class_id', 'classes.id')
                    ->select('confirms.*')
                    ->where('confirms.class_id', $id)->get();

        return $confirms;
    }

    public function getGoingForClass($id){

        $confirms = DB::table('classes')
                    ->join('confirms', 'confirms.class_id', 'classes.id')
                    ->select('confirms.*')
                    ->where('confirms.class_id', $id)->get();

        $usersArray = array();
        foreach($confirms as $confirm){
            $usersArray[] = DB::table('users')
                    ->where('id', $confirm->user_id)->get();
        }

        return $usersArray;
    }

    public function showMyClasses($user_id){

        $confirms = Confirm::where('user_id', $user_id)->get();

        $classesArray = array();
        foreach($confirms as $confirm){
            $classesArray[] = DB::table('classes')
                    ->where('id', $confirm->class_id)->get();
        }

        // $usersArray = array();
        // foreach($confirms as $confirm){
        //     $usersArray[] = DB::table('users')
        //             ->where('id', $confirm->user_id)->get();
        // }

        return $classesArray;
    }

    public function updateClass (Request $request, $class_id){
        $class = Classes::findOrFail($class_id);

        $class->title = $request->title;
        $class->date = $request->date;
        $class->time = $request->time;
        $class->class_length = $request->class_length;
        $class->going = $request->going;

        $class->save();

        return response()->json($class, 201);
    }
}
