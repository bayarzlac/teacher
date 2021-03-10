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
    public function index(Request $request)
    {
        $pageTitle = 'Ирц, явцын дүн';
        $pageName = 'irts';

        $angi = Angi::orderBy('ner', 'asc')->get();
        $students = Students::where('a_id', $request->get("a_id"))->orderBy('ner', 'asc')->get();

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
        for ($i = 0; $i < count($request->sid); $i += 1)
        {
            
        }

        
        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('teacher-irts')->with('a_id', $request->a_id)->with('success', 'Оюутан амжилттай нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Оюутан амжилттай нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
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
