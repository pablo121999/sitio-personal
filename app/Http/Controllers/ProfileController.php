<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function main(Request $request): View
    {
        return view('usuario.main', [
            'user' => $request->user(),
        ]);
    }

    public function ListaUsuarios(): JsonResponse
    {
        return response()->json(User::select('id', 'name', 'email')->get());
    }


    public function CrearUsuarioVista(): View
    {
        return view('usuario.crear');
    }

    public function Crear(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
            ],
            [
                'name.required' => 'El campo nombre es obligatorio.',
                'email.required' => 'El campo correo electrónico es obligatorio.',
                'email.email' => 'El correo electrónico no es válido.',
                'email.unique' => 'Este correo ya está registrado.',
                'password.required' => 'El campo contraseña es obligatorio.',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            ]
        );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('GestionUsuarios')->with('success', 'Usuario creado correctamente.');
    }




    public function EditarUsuarios($id): View
    {
        return view('usuario.editar', [
            'user' => User::where('id', $id)->select('id', 'name', 'email')->first(),
        ]);
    }


    public function actualizar(Request $request, $id)
    {
        // Buscar el usuario
        $user = User::findOrFail($id);

        // Actualizar los datos
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->passwordNuevo);
        $user->save();

        return redirect()->route('GestionUsuarios')->with('success', 'Usuario actualizado correctamente.');
    }



    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
