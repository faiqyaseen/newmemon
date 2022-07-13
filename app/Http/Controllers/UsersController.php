<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->except([
            '_token',
            '_method',
            'profile',
            'cover',
        ]);

        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension();
            $ImageName = 'profile-' . time(). '.' . $extension;
            $image->move(public_path('assets/img/'), $ImageName);
            $data['profile'] = $ImageName;
        }

        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $extension = $image->getClientOriginalExtension();
            $ImageName = 'cover-' . time(). '.' . $extension;
            $image->move(public_path('asset/img/'), $ImageName);
            $data['cover'] = $ImageName;
        }

        $data['password'] = Hash::make($data['password']); 

        User::create($data);

        return redirect()
            ->route('users.index')
            ->with('success','User has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::where('id', $id)->first();
        return view('users.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::where('id', $id)->first();
        return view('users.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->except([
            '_token',
            '_method',
            'profile',
            'cover',
        ]);

        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension();
            $ImageName = 'profile-' . time(). '.' . $extension;
            $image->move(public_path('assets/img/'), $ImageName);
            $data['profile'] = $ImageName;
        }

        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $extension = $image->getClientOriginalExtension();
            $ImageName = 'cover-' . time(). '.' . $extension;
            $image->move(public_path('asset/img/'), $ImageName);
            $data['cover'] = $ImageName;
        }

        User::where('id', $id)->update($data);

        return redirect()
            ->route('users.index')
            ->with('success','User has been added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        if ($user->profile != null) {
            if (file_exists(public_path('assets/img/'.$user->profile ))) {
                unlink(public_path('/assets/img/'.$user->profile ));
            }
        }
        if ($user->cover != null) {
            if (file_exists(public_path('assets/img/'.$user->cover ))) {
                unlink(public_path('/assets/img/'.$user->cover ));
            }
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success','Post has been deleted successfully.');
    }
}
