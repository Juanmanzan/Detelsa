<?php
// ContrasenaController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ContrasenaController extends Controller
{
    public function edit()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        
        return view('contrasena');
    }

    public function verificarPassword(Request $request)
    {
        $request->validate(['password' => 'required']);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Contraseña incorrecta'
            ], 401);
        }

        Session::put('credentials_verified', true);
        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'sometimes|string|max:255|unique:users,username,' . Auth::id(),
            'password' => 'sometimes|string|min:6'
        ], [
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'username.unique' => 'Este nombre de usuario ya está en uso.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $user = Auth::user();
        $changes = false;

        if ($request->filled('username') && $request->username !== $user->username) {
            $user->username = $request->username;
            $changes = true;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $changes = true;
        }

        if ($changes) {
            $user->save();
            Session::flush();
            Auth::logout();

            return response()->json([
                'success' => true,
                'redirect' => route('login')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No se realizaron cambios'
        ]);
    }

    public function clearVerification()
    {
        Session::forget('credentials_verified');
        return response()->json(['success' => true]);
    }
}
?>