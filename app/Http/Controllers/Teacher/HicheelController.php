<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Fond;

class HicheelController extends Controller
{
    public function index()
    {
        $user = Auth::guard('teacher')->user();

        $pageTitle = 'Заах хичээлүүдийн';
        $pageName = 'hicheel';
        
        $fond = Fond::join('hicheel', 'hicheel.id', '=', 'fond.h_id')->
            select('hicheel.id', 'hicheel.ner', 'fond.tsag' )->
            where('t_id', '=', $user->id)->get();

        $activeMenu = activeMenu($pageName);

        return view('teacher/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'fond' => $fond,
            'user' => $user
        ]);
    }
}