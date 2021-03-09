<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Students;
use App\Models\Angi;

class IrtsController extends Controller
{
    public function index()
    {
        $pageTitle = 'Ирц, явцын дүн';
        $pageName = 'irts';

        $angi = Angi::orderBy('ner', 'asc')->get();
        $students = Students::where('a_id', 2)->orderBy('ner', 'asc')->get();

        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'angis' => $angi,
            'students' => $students,            
            'user' => Auth::guard('teacher')->user()
        ]);
    }

    public function save(Request $request) 
    {
        redirect()->route('teacher-irts')->with('success', 'Ирц амжилттай бүртгэгдлээ!');
    }

    public function result()
    {
        $pageTitle = 'Ирц, явцын дүн';
        $pageName = 'irts';

        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('teacher')->user()
        ]);
    }
}
