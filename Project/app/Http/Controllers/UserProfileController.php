<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AESEncryptor;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 🔓 Decrypt email sebelum dikirim ke view
        $decryptedEmail = AESEncryptor::decrypt($user->email);

        return view('user.profile', [
            'user' => $user,
            'decryptedEmail' => $decryptedEmail
        ]);
    }
}