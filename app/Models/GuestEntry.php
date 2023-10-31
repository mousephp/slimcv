<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
    
class GuestEntry extends Model
{
    use SoftDeletes;

    protected $table = "guest_entrys";

    protected $fillable = ["full_name","email","comment"];

    protected $dates = ['deleted_at'];
}
