<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListSubject;
use Illuminate\Support\Facades\Auth;


class SubjectListController extends Controller
{
    public function saveSubject(Request $request)
    {
        echo json_encode($request->all());
        $newSubject = new ListSubject();
        $newSubject->subject_id = $request->sbid;
        $newSubject->title = $request->sbname;
        $newSubject->description = $request->sbdes;
        $newSubject->price = $request->sbprice;
        $newSubject->learning_hours = $request->sblh;
        $newSubject->save();
        return redirect('mainpage')->with('save', 'Success')->withErrors('error', 'Failed');
    }

    public function mainpage()
    {
        if (Auth::check()) {
            return view('mainpage', ['listSubjects' => ListSubject::all()]);
        }
        return redirect("login")->withSuccess('You do not have access');
    }
    public function markDelete($id)
    {
        $listSubject = ListSubject::find($id);
        $listSubject->delete();
        return redirect('mainpage');
    }

    public function markUpdate($id, Request $request)
    {
        $listSubject = ListSubject::find($id);
        $listSubject->subject_id = $request->sbid;
        $listSubject->title = $request->sbname;
        $listSubject->description = $request->sbdes;
        $listSubject->price = $request->sbprice;
        $listSubject->learning_hours = $request->sblh;
        $listSubject->update();
        return redirect('mainpage');
    }}
