<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'amount', 'Tgl_Pengajuan', 'Tgl_Cair', 'Tenor', 'jml_angsuran', 'stat_loan', 'tgl_lunas'];

    public $timestamps = false; // Menonaktifkan timestamps

    // public function customer(){
    //     return $this->belongsTo(Customer::class, 'customer_id');
    // }

    public function user(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function installment(){
        return $this->hasMany(Installments::class, 'loans_id');
    }
}
