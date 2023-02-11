<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    /*
    @primaryKey: Primary key associated with model
    @incrementing: tells eloquent that primary key does not increment
    @timestamps: No timestamp value 
    */
    protected $table = "views";
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $dateFormat = 'd/m/y';

    //protected $connection = 'sqlite'; 
}
