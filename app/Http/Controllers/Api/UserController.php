<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = [];
        $sortBy = 'id';
        $direction = 'asc';
        $perPage = $request->perPage == -1 ? User::count() : $request->perPage;
        
        if(!empty($request->search)){
            $where = ['name','like','%'.$request->search.'%'];            
        }

        if(!empty($request->sortBy)){
            $sortBy = $request->sortBy;
        }

        if(!empty($request->descending)){
            $direction = $request->descending == "true" ? 'desc' : 'asc';
        }
        if($where)
            return User::where([$where])->orderBy($sortBy, $direction)->paginate($perPage);

        return User::orderBy($sortBy, $direction)->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return [];
    }
}
