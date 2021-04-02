<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use App\Models\TsahimHicheel;
use App\Models\Fond;
use App\Models\Daalgavar;

class AguulgaController extends Controller
{
    public function index($id)
    {
        $pageTitle = 'Заах хичээлийн агуулга';
        $pageName = 'aguulga';

        $activeMenu = activeMenu($pageName);

        $aguulga = TsahimHicheel::select('tsahim_hicheel.id', 'tsahim_hicheel.sedev', 'tsahim_hicheel.tailbar', 'daalgavar.id as d_id')->
            leftJoin('daalgavar', 'tsahim_hicheel.id', '=', 'daalgavar.ts_id')->
            where('tsahim_hicheel.f_id', '=', $id)->get();

        return view('teacher/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'aguulga' => $aguulga,
            'user' => Auth::guard('teacher')->user()
        ]);
    }

    public function add($id)
    {
        $pageTitle = 'Хичээлийн агуулга нэмэх';
        $pageName = 'aguulga';

        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('teacher')->user()
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::guard('teacher')->user();
        $path = "";

        if ($request->hasFile('file'))
        {
            $path = $request->file('file')->store('uploads/' . strval($user->code));
        }   

        $TsahimHicheel = new TsahimHicheel;
        $TsahimHicheel->sedev = $request->sedev;
        $TsahimHicheel->tailbar = $request->tailbar;
        $TsahimHicheel->aguulga = $request->aguulga;
        $TsahimHicheel->fileUrl = $path;
        $TsahimHicheel->f_id = $request->f_id;
        $TsahimHicheel->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('teacher-aguulga', [$request->f_id])->with('success', 'Хичээлийн агуулга амжилттай нэмэгдлээ!');
                break;
            case 'save_and_new':
                return back()->with('success', 'Хичээлийн агуулга амжилттай нэмэгдлээ!');
                break;
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function edit($id)
    {
        $pageTitle = 'Хичээлийн агуулга засварлах';
        $pageName = 'aguulga';

        $activeMenu = activeMenu($pageName);

        $aguulga = TsahimHicheel::findOrFail($id);

        return view('teacher/pages/'.$pageName.'/edit', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'aguulga' => $aguulga,
            'user' => Auth::guard('teacher')->user()
        ]);
    }

    public function update(Request $request, $id)
    {
        $TsahimHicheel = TsahimHicheel::findOrFail($id);

        $path = "";

        if ($request->hasFile('file'))
        {
            $path = Storage::putFile('files', new File('/uploads/files'));
        }

        $TsahimHicheel->sedev = $request->sedev;
        $TsahimHicheel->tailbar = $request->tailbar;
        $TsahimHicheel->aguulga = $request->aguulga;
        $TsahimHicheel->fileUrl = $path;
        $TsahimHicheel->f_id = $request->f_id;
        $TsahimHicheel->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('teacher-aguulga', [$request->f_id])->
                    with('success', 'Хичээлийн агуулга амжилттай засагдлаа!');
                break;
            case 'save_and_new':
                return back()->with('success', 'Хичээлийн агуулга амжилттай засагдлаа!');
                break;
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function destroy(Request $request, $id)
    {
        // $member = Daalgavar::where('ts_id', '=', $id)->get();

        // if ($member) 
        // {
        //     $member->delete();
        // }

        $member = TashimHicheel::findOrFail($id);
        
        $member->delete();

        return redirect()->route('students')->with('success', 'Сонгогдсон ауулга устгагдлаа!'); 
    }

    public function delete(Request $request)
    {
        $member = TsahimHicheel::findOrFail($request->get("ts_id"));
        $member->delete();

        return redirect()->route('manager-students')->with('success', 'Оюутан амжилттай устгалаа!'); 
    }
}