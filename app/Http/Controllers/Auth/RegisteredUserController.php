<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        // Simple form (या बाद में invitation-based join के लिए use कर सकती हो)
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Basic registration – assignment में ये primary flow नहीं होगा
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'role'       => User::ROLE_MEMBER,
            'company_id' => null,
        ]);

        auth()->login($user);

        return redirect('/dashboard');
    }
}
