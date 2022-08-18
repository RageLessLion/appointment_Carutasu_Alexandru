<?php

namespace App\Http\Controllers;



use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{

    //show all appointments
//    public function index(){
//        return view('appointments.index',[
//           'appointments' => Appointment::all()
//        ]);
//    }


    //show single appointments
//    public function show(Appointment $appointment){
//        return view('appointments.show',[
//           'appointment'=>$appointment
//        ]);
//    }


    //manage appointments
    public function manage() {
        return view('appointments.manage', ['appointments' => auth()->user()->appointments()->get()]);
    }


    //show create form
    public function create(){
        return view('appointments.create');
    }

    //show edit form
    public function edit(Appointment $appointment){
        //make sure the user logged is the owner
        return view('appointments.edit',['appointment' => $appointment]);
    }


    //Store appointment data
    public function store(Request $request){
        $formFields = $request->validate([
            'start_time'=>'required',
            'finish_time'=>'required',
            'consultant_id'=>'required',
            'description'=>'required',
        ]);

        $formFields['user_id'] = auth()->id();


        Appointment::create($formFields);

        return redirect('/');
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



