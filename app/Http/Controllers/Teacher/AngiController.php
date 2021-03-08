<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Angi;
use App\Models\Tenhim;
use App\Models\Teachers;
use App\Models\Mergejil;
use App\Models\MergejilTurul;

class AngiController extends Controller
{
    public function index()
    {
        $pageTitle = 'Ангиуд';
        $pageName = 'angi';

        $angi = Angi::select('angi.*', 'teachers.ner as bagsh', 'teachers.ovog')
                            ->join('teachers', 'teachers.id', '=', 'angi.b_id')
                            ->orderBy('ner', 'asc')
                            ->get();

        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'angiud' => $angi,
            'user' => Auth::guard('teacher')->user()
        ]);
    }

    public function add()
    {
        $pageTitle = 'Анги нэмэх';
        $pageName = 'angi';

        // $tenhims = Tenhim::orderBy('ner', 'desc')->get();
        $teachers = Teachers::orderBy('ner', 'desc')->get();

        $mergejil = Mergejil::orderBy('ner', 'asc')->get();
        $bolovsrol = MergejilTurul::orderBy('ner', 'asc')->get();

        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('teacher')->user(),
            'mergejils' => $mergejil,
            'bolovsrols' => $bolovsrol,
            'teachers' => $teachers
        ]);
    }

    public function store(Request $request)
    {

        $angi = new Angi;

        $angi->ner = Str::ucfirst($request->ner);
        $angi->course = $request->course;
        $angi->buleg = Str::ucfirst($request->buleg);
        $angi->m_id = $request->m_id;
        $angi->b_id = $request->b_id;

        $angi->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('teacher-angi')->with('success', 'Анги амжилттай нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Анги амжилттай нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function edit($id)
    {
        $pageTitle = 'Анги засварлах';
        $pageName = 'angi';

        $teacher = Angi::findOrFail($id);

        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/edit', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'teacher' => $teacher,
            'user' => Auth::guard('teacher')->user()
        ]);
    }

    public function update(Request $request, $id)
    {
        $angi = Angi::findOrFail($id);

        $angi->ner = Str::ucfirst($request->ner);
        $angi->course = $request->course;
        $angi->buleg = Str::ucfirst($request->buleg);
        $angi->m_id = $request->m_id;
        $angi->b_id = $request->b_id;

        $angi->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('teacher-angi')->with('success', 'Анги амжилттай засварлагдлаа!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Анги амжилттай засварлагдлаа!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function destroy(Request $request, $id)
    {
        $member = angi::findOrFail($id);
        $member->delete();

        return redirect()->route('angi')->with('success', 'Анги устгагдлаа нэмэгдлээ!'); 

    }
}
