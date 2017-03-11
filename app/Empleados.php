<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
  protected $table ='empleados';
  public $fillable = ['name','firstname','lastname','date_of_birth','salary'];
}