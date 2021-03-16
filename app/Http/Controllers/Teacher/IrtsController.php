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
            'user' => Auth::guard('teacher')->user()
        ]);
    }

    public function save(Request $request) 
    {

        for ($i = 0; $i < count($request->get("s_id")); $i++)
        {
            $exists = Irts::where('s_id', '=', $request->get("s_id")[$i])
                ->whereDate('day', '=', $request->get("day"))->get();

            if (count($exists))
            {
                $exists->delete();
            }

            // $newIrts = new Irts;
            // $newIrts->s_id = $request->get("s_id")[$i];
            // $newIrts->day = $request->get("day");
            // $newIrts->h_id = 1;
            // $newIrts->status = $request->get("status")[$i];
            // $newIrts->dun = $request->get("dun")[$i];
            
            // $newIrts->save();
        }
        
        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('teacher-irts')->with('a_id', $request->a_id)->with('success', 'yu yaasan'); 
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
