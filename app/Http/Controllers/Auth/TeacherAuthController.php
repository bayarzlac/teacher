<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequestTeacher;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Teacher;

use Auth;

class TeacherAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/teacher/login';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function teacherGet()
    {
        return redirect(url('teacher/login'));
    }

    public function teacherGetLogin()
    {
        return view('teacher.login.main', [
            'layout' => 'login'
        ]);
    }

    public function TeacherLogin(LoginRequestTeacher $request)
    {
        
        if (Auth::guard('teacher')->attempt([
                'code' => $request->code, 
                'password' => $request->password
            ]))
        {
            $user = Auth::guard('teacher')->user();
            
        } else {
            throw new \Exception('Wrong code or password.');
        }
    }

    public function teacherLogout()
    {
        Auth::guard('teacher')->logout();   
        return redirect(url('teacher/login'));
    }
}