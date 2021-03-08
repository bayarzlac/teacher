<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{

    public function index()
    {

        $pageTitle = 'Хувийн мэдээлэл';
        $pageName = 'settings';

        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('teacher')->user()
        ]);
    }

    public function password()
    {

        $pageTitle = 'Нууц үг солих';
        $pageName = 'settings';

        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/password', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('teacher')->user()
        ]);
    }

    public function huvaari()
    {

        $pageTitle = 'Хуваарь тохиргоо';
        $pageName = 'settings';

        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/huvaari', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('teacher')->user()
        ]);
    }
}
