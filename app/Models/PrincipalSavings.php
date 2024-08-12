<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrincipalSavings extends Model
{
    use HasFactory;

    protected $fillable = ['date','customer_id','amount'];

    // public function customer(){
    //     return $this->belongsTo(Customer::class, 'customer_id');
    // }

    public function user(){
        return $this->belongsTo(User::class, 'customer_id');
    }
}
