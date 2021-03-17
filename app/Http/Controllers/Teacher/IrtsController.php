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
        
        $day = $request->get("day");

        $irts = Students::join('irts', 'students.id', '=', 'irts.s_id')
                ->where('a_id', '=', $request->get('a_id'))
                ->whereDate('day', '=', $day)
                ->select('students.id', 'students.ovog', 'students.ner', 'irts.status', 'irts.dun')->get();

        if (count($irts) == 0)
        {
            $irts = Students::where('a_id', '=', $request->get('a_id'))
                    ->select('students.id', 'students.ovog', 'students.ner')->get();

            foreach ($irts as $ir) 
            {
                $ir->status = 1;
                $ir->dun = 0;
            }
        }

        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'angis' => $angi,
            'irts' => $irts,
            'day' => $day,
            'user' => Auth::guard('teacher')->user()
        ]);
    }

    public function save(Request $request) 
    {
        $day = $request->get("day");

        for ($i = 0; $i < count($request->get("s_id")); $i++)
        {
            $member = Irts::where('s_id', '=', $request->get("s_id")[$i])
                ->whereDate('day', '=', $day)->get();

            if (count($member) > 0)
            {
                $member->status = $request->get("status")[$i];
                $member->dun = $request->get("dun")[$i];
                $member->save();
            }
            else 
            {
                $member = new Irts;
                $member->s_id = $request->get("s_id")[$i];
                $member->day = $day;
                $member->h_id = 1;
                $member->status = $request->get("status")[$i];
                $member->dun = $request->get("dun")[$i];
                
                $member->save();
            }
        }
        
        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('teacher-irts')->with('a_id', $request->get('a_id'))
                    ->with('day', $request->get('day'))
                    ->with('success', 'Ирцийн мэдээ хадгалагдлаа'); 
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }
}
