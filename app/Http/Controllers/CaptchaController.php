<?php
namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\RegisterViewResponse;

class CaptchaController extends Controller
{
    protected StatefulGuard $guard;
    protected CreatesNewUsers $creator;
    public function __construct(StatefulGuard $guard,CreatesNewUsers $creator)
    {
        $this->guard = $guard;
        $this->creator = $creator;
    }
    public function index()
    {
        return view('register');
    }
    public function capthcaFormValidate(Request $request)
    {
    /* Uncomment to enable. It does not work with Docker */
        $request->validate([
            'captcha' => 'required|captcha'
        ]);
        $a = new \Laravel\Fortify\Http\Controllers\RegisteredUserController($this->guard);
        $a->store($request,$this->creator);
        return view('auth.login');
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
