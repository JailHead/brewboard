<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'erp_employees';

    protected $fillable = [
        'user_id',
        'role_id',
        'name',
        'last_name',
        'birthdate',
        'address',
        'phone',
        'emergency_contact',
        'nss',
        'entry_date',
        'shift',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'entry_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(EmployeeRole::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->last_name}";
    }
}
