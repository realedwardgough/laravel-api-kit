<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class Customer extends Model
{
   use HasFactory;

   protected $fillable = [
      'name',
      'type',
      'email',
      'address',
      'city',
      'province',
      'postcode'
   ];

   public function invoices() {
      return $this->hasMany(Invoice::class);
   }
}
