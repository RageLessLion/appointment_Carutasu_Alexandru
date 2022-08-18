<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;

    public $table = 'appointments';
//    public mixed $user_id;

//    protected $dates = [
//        'start_time',
//        'created_at',
//        'updated_at',
//        'deleted_at',
//        'finish_time',
//    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [
        'description',
        'consultant_id',
        'start_time',
        'created_at',
        'updated_at',
        'deleted_at',
        'finish_time',
        'user_id',
    ];

    //belongs to user(client)
    public function client(){
        return $this->belongsTo(User::class,'user_id');
    }

    //belongs to consultant
    public function consultant()
    {
        return $this->belongsTo(Consultant::class);
    }
}
