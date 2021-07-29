<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Traits\WorkflowTrait;

class Register extends Model
{
    //install workflow machine
    use WorkflowTrait;

    //protected field
    protected $fillable = ['firstname', 'lastname', 'email','dateofbirth','status'];
}
