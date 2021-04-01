<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Daalgavar;
use App\Models\TsahimHicheel;

class DaalgavarController extends Controller
{
    //tsahim_hicheel id aar holbogdol daalgavariig gargah
    public function index($id)
    {
        $pageTitle = 'Гэрийн даалгавар';
        $pageName = 'daalgavar';

        $daalgavar = Daalgavar::select('id', 'ts_id', 'end_time')->
            where('ts_id', '=', $id)->get();

        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'daalgavar' => $daalgavar,
            'user' => Auth::guard('teacher')->user()
        ]);
    }

    public function add($id)
    {
        $pageTitle = 'Даалгавар нэмэх';
        $pageName = 'daalgavar';

        $aguulga = TsahimHicheel::findOrFail($id);
        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'aguulga' => $aguulga,
            
            'user' => Auth::guard('teacher')->user()
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::guard('teacher')->user();
        $path = "";

        if ($request->hasFile('file'))
        {
            $path = Storage::putFile('files', new File('/uploads/files'));
        }

        $daalgavar = new Daalgavar;
        $daalgavar->ts_id = $request->ts_id;
        $daalgavar->end_time = $request->end;
        $daalgavar->fileUrl = $path;
        $daalgavar->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('teacher-daalgavar', [$request->ts_id])->with('success', 'Гэрийн даалгавар амжилттай нэмэгдлээ!');
                break;
            case 'preview':
                echo 'preview';
                break;
        }
    }
}