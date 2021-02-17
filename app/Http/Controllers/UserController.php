<?php

namespace App\Http\Controllers;

use App\Http\Resources\{UserResource,MeetingResource, QuestionResource};
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function meetings()
    {
        $u = Meeting::where('user_id', Auth::user()->id)->get();
        $user = [
            'meetings' => MeetingResource::collection($u),
        ];
        return response()->json($user, 200);
    }

    public function meetingsList($id)
    {
        $u = Meeting::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if($u) {
            $user = [
                'id' => $u->id,
                'title' => $u->title,
                'count' => $u->questions->count(),
                'questions' => QuestionResource::collection($u->questions)
            ];
            return response()->json($user, 200);
        } else {
            return response()->json(['error' => ['Sessão não encontrada']], 400);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(UserResource::collection(User::all()), 200);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->meetings;
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
