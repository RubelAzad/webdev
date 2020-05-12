<?php
namespace App;
namespace Modules\Service\Entities;
use Illuminate\Database\Eloquent\Model;

class Sharing extends Model
{
    protected $fillable = ['code','desc','sharing','direction', 'charge'];
}
