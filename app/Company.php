<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Company model
class Company extends Model
{
    protected $fillable = ['name', 'address'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}