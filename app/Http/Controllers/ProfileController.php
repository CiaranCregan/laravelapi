<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $profile = Profile::where('user_id', $id)->get();

        return $profile;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateInformation(Request $request, $id)
    {
        $profile = Profile::where('user_id', $id)->first();

        if (!$profile){
            $newProfile = new Profile;

            $newProfile->user_id = $id;
            $newProfile->dob = $request->dob;
            $newProfile->height = $request->height;
            $newProfile->weight = $request->weight;
            $newProfile->goal_weight = $request->goal_weight;
            $newProfile->action_plan = $request->action_plan;
            $newProfile->mobile_number = $request->mobile_number;

            $newProfile->save();

            return $newProfile;
        } else {

            $profile->user_id = $id;
            $profile->dob = $request->dob;
            $profile->height = $request->height;
            $profile->weight = $request->weight;
            $profile->goal_weight = $request->goal_weight;
            $profile->action_plan = $request->action_plan;
            $profile->mobile_number = $request->mobile_number;

            $profile->save();

            return $profile;
        }
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
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
