<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    public function redirectTo()
    {
        $role = Auth::user()->role->name;

        switch ($role) {
            case 'administrator':
                return route('admin.home');
                break;
            case 'viewer':
                return route('viewer.home');
                break;
            case 'moderator':
                return route('moderator.home');
                break;
            case 'monitor':
                return route('monitor.home');
                break;
            default:
                return route('viewer.home');
                break;
        }
    }
}
