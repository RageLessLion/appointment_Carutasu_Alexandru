<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{
    public function index(){
        return view('consultants.index',[
           'consultants'=> Consultant::all()
        ]);
    }

    public function checkForAvailability($consultant_id,$date){
        //following 24h interval to search
        $interval = Carbon::createFromFormat('Y-m-d', $date);
        $interval = $interval->add('day',1)->toDateString();

        $appointments = Appointment::all()
            ->where('consultant_id',$consultant_id)
            ->where('start_time', '>=', $date)
            ->where('finish_time', '<=', $interval);

        $array = array();
        foreach($appointments as $appointment){
            array_push($array,$appointment);
        }

        return array_column($array,'start_time');
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
