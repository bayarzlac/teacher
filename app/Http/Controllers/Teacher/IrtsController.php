<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Students;
use App\Models\Angi;
use App\Models\Irts;

class IrtsController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = 'Ирц, явцын дүн';
        $pageName = 'irts';

        $angi = Angi::orderBy('ner', 'asc')->get();
        //$students = Students::where('a_id', $request->get("a_id"))->orderBy('ner', 'asc')->get();

        $irts = Students::leftJoin('irts', 'students.id', '=', 'irts.s_id')->where('a_id', $request->get('a_id'))->get();

        foreach ($irts as $ir) 
        {
            if ($ir->status == null) 
            {
                $ir->status = 1;
            }
        }

        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'angis' => $angi,
            'irts' => $irts,            
            'user' => Auth::guard('teacher')->user()
        ]);
    }

    public function save(Request $request) 
    {
        for ($i = 0; $i < count($request->data[]); $i += 1)
        {
            
        }

        
        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('teacher-irts')->with('a_id', $request->a_id)->with('success', 'yu yaasan'); 
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
