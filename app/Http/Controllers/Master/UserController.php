<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response($users);
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
        $this->validate($request,[
            'username'      => 'required',
            'password'      => 'required',
            'email'         => 'required',
        ]);

        $user = User::create([
            'username'      => $request->username,
            'password'      => Hash::make($request->password),
            'email'         => $request->email,
            'status'        => $request->input('status',1),
            'created_by'    => Auth::user()->id,
        ]);

        //success save to database
        if($user){
            return response()->json([
                'success'       => true,
                'message'       => 'List User Post',
                'data'          => $user
            ],200);
        }

        //failed save to database
        return response()->json([
            'success'       => false,
            'message'       => 'Post Failed to save',
            'data'          => $user
        ],409);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        // make response JSON

        return response()->json([
            'success'   => true,
            'message'   => 'Detail User',
            'data'      => $user
        ],200);
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
        $this->validate($request,[
            'username'      => 'required',
            // 'password'      => 'required',
            'email'         => 'required',
        ]);

        $user = [
            'username'      => $request->username,
            'password'      => Hash::make($request->password),
            'email'         => $request->email,
            'status'        => $request->input('status',1),
            'created_by'    => Auth::user()->id,
        ];
        User::whereId($id)->update($user);
        //success save to database
        if($user){
            return response()->json([
                'success'       => true,
                'message'       => 'List User Post',
                'data'          => $user
            ],200);
        }

        //failed save to database
        return response()->json([
            'success'       => false,
            'message'       => 'Post Failed to save',
            'data'          => $user
        ],409);
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
