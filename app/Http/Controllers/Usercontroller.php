<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Gestionnaire;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Usercontroller extends Controller
{

    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telephone' => 'required|numeric|unique:users,telephone',
            'password' => 'required',
        ]);

        // Si la validation échoue, rediriger avec des messages d'erreur
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Créer un utilisateur dans la base de données
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
        ]);

        // Rediriger vers la page de connexion avec un message de succès
        return redirect()->route('login.form')->with('success', 'Compte créé avec succès. Vous pouvez maintenant vous connecter.');
    }
    public function show(string $id)
    {
        //
    }

    public function login(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw  ValidationException::withMessages(
                [
                    'email' => trans('auth.failed')
                ]
            );
        }

        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->role === 'gestionnaire') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'utilisateur') {
            return redirect()->route('client.index');
        } else {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Rôle utilisateur non reconnu.',
            ]);
        }
    }

    public function register(){
        return view('register');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function loginForm()
    {
        return view('login');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'telephone' => 'required|string|max:15',
            'role' => 'required|string|in:utilisateur,gestionnaire',
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        return redirect()->route('admin.gestionnaires')->with('success', 'Utilisateur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function storeuser(Request $request){
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telephone' => 'required|string|max:15',
            'role' => 'required|string|in:utilisateur,gestionnaire',
            'password' => "passser123"
        ]);

        if ($validated['role'] ==="utilisateur"){
            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->telephone = $validated['telephone'];
            $user->role = $validated['role'];
            $user->password = Hash::make('password');
            $user->save();
            return redirect()->route('admin.utilisateurs')->with('success', 'Utilisateur ajouté avec succès');
        }
            $user = new Gestionnaire();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->telephone = $validated['telephone'];
            $user->role = $validated['role'];
            $user->password = Hash::make('password');
            $user->save();
            return redirect()->route('admin.gestionnaires')->with('success', 'Gestionnaire ajouté avec succès');
    }

}
