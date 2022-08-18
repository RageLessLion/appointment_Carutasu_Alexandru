<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{
    public function index(){
        return view('consultants.index',[
           'consultants'=> Consultant::all()
        ]);
    }

    public function delete($id){
        $consultant = Consultant::find($id);
        $consultant->delete();
        return response()->json(['success'=>'Record has been deleted']);
    }

    public function create(){
        return view('consultants.create');
    }

    //show edit form
    public function edit(Consultant $consultant){
        return view('consultants.edit',['consultant' => $consultant]);
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);

        Consultant::create($formFields);

        return redirect('/admin')->with('message','Consultant updated successfully');
    }

    public function update(Request $request,Consultant $consultant){
        $formFields = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);

        $consultant->update($formFields);
        return redirect('/admin')->with('message','Consultant updated successfully');
    }



}
