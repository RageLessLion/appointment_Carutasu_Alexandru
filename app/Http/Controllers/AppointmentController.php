<?php

namespace App\Http\Controllers;



use App\Models\Consultant;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    //manage appointments
    public function manage() {
        return view('appointments.manage', ['appointments' => auth()->user()->appointments()->get()]);
    }


    //show create form
    public function create(){
        return view('appointments.create',['consultants'=>Consultant::all()]);
    }

    //show edit form
    public function edit(Appointment $appointment){
        //make sure the user logged is the owner
        return view('appointments.edit',['appointment' => $appointment]);
    }


    //Store appointment data
public function store(Request $request) {
//        dd($request);
    $attr = $request->validate([
        'consultant' => 'required',
        'date' => 'required',
        'time' => 'required'
    ]);

    $attr['consultant_id'] = $attr['consultant'];
    $attr['user_id'] = auth()->user()->getAuthIdentifier();

    unset($attr['consultant']);
    unset($attr['date']);
    $startAt = Carbon::createFromFormat('m/d/Y, H:i:s', $attr['time']);
    $endAt = $startAt;
    $endAt = new Carbon($startAt);
    $endAt->addHour();
    $attr['start_time'] = $startAt;
    $attr['finish_time'] = $endAt;
    unset($attr['time']);
    $appointment = new Appointment($attr);
    $appointment->save();

    return redirect('/')->with('message', 'Appointment submitted succesfully');
}

    public function update(Request $request,Appointment $appointment){
        //make sure the user logged is the owner
            $formFields = $request->validate([
                'start_time'=>'required',
                'finish_time'=>'required',
                'consultant_id'=>'required',
                'description'=>'required',
            ]);

            $appointment->update($formFields);

            return redirect('/appointments/manage')->with('message','Appointment updated successfully');
        }

        public function delete($id){
            $appointment = Appointment::find($id);
            $appointment->delete();
            return response()->json(['success'=>'Record has been deleted']);
        }


    }



