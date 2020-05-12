<?php
namespace App;
namespace Modules\Service\Entities;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected $fillable = ['code','desc','payment_type','name', 'qty', 'price'];
}
