<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    //public function store(Request $request)
   // {
     //   $validated = $request->validate([
        //    'name' => 'required|string|max:255',
        //    'email' => 'required|string|email|max:255|unique:users',
        //    'password' => 'required|string|min:8',
         //   'is_admin' => 'boolean'
       // ]);

       // $validated['password'] = Hash::make($validated['password']);
       // $user = User::create($validated);

       // return redirect()->route('admin.users.index')
       //     ->with('success', 'Utilisateur créée.');
   // } 

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'is_admin' => 'boolean'
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Modification réussie.');
    }

    //public function destroy(User $user)
   // {
      //  if ($user->id === auth()->id()) {
       //     return redirect()->route('admin.users.index')
         //       ->with('error', 'Impossible de supprimer vôtre compte.');
       // }

       // $user->delete();

       // return redirect()->route('admin.users.index')
       ///     ->with('success', 'Utilisateur supprimé.');
    //}
}
