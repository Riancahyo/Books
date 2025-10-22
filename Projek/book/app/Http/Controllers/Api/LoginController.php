<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\SimpleEncryption;

class LoginController extends Controller
{
    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'pin' => 'required', // pastikan user kirim PIN juga!
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user) {
            return new BookResource(false, "Email tidak ditemukan", 404);
        }

        try {
            // decrypt password di database pakai PIN yang dikirim user
            $decryptedPassword = SimpleEncryption::decrypt($user->password, $request->pin);

            if ($decryptedPassword !== $request->password) {
                return new BookResource(false, "Password atau PIN salah", 401);
            }

            $token = $user->createToken(
                "auth_token",
                $user->getAllPermissions()->pluck("name")->toArray()
            )->plainTextToken;

            return new BookResource(true, "Berhasil login", [
                "Token" => $token,
                "Hak" => $user->load("roles")
            ]);
        } catch (\Exception $e) {
            return new BookResource(false, "PIN salah atau data rusak", 400);
        }
    }

    public function Logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return new BookResource(true, "Berhasil Logout", 202);
    }
}
