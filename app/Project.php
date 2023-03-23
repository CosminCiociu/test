<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Project model
class Project extends Model
{
    protected $fillable = ['name', 'description', 'start_date', 'end_date'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}