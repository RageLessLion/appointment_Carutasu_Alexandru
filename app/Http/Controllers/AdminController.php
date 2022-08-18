<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultant;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            abort(Response::HTTP_FORBIDDEN);
        } else


            if (auth()->user()->is_admin != 1) {
                abort(Response::HTTP_FORBIDDEN);
            } else
                return view('admin.index',[
                    'appointments'=>Appointment::all(),
                    'users'=>User::all(),
                    'consultants'=>Consultant::all(),
                ]);
    }
}
