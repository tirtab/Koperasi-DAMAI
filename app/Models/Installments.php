<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installments extends Model
{
    use HasFactory;

    protected $fillable = ['tgl_angsuran', 'amount', 'angsuranKe', 'loans_id', 'tgl_lunas'];

    public function loans(){
        return $this->belongsTo(Loans::class, 'loans_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
