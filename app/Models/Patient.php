<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number', 
        'first_name', 
        'last_name', 
        'date_of_birth', 
        'gender', 
        'phone_number', 
        'address',
    ];
    

    protected $casts = [
        'date_of_birth' => 'date',
    ];
    protected static function booted()
    {
        static::creating(function ($patient) {
            $patient->registration_number = 'REG-' . Str::random(8);
        });
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public $timestamps = false;

}