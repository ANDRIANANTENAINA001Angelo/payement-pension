<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pensionnaire extends Model
{
    use HasFactory;

    protected $fillable = ['name','numCnaps', 'cin', 'numMatricule', 'solde'];

    public function getNameAttribute($value)
    {
        return (string) $value;
    }

    public function getNumCnapsAttribute($value)
    {
        return (int) $value;
    }

    public function getCinAttribute($value)
    {
        return (int) $value;
    }

    public function setNumCnapsAttribute($value)
    {
        $this->attributes['numCnaps'] = (string) $value;
    }

    public function setCinAttribute($value)
    {
        $this->attributes['cin'] = (string) $value;
    }

    protected $cast=[
        "created_at"=>"datetime:Y-m-d",
        "updated_at"=>"datetime:Y-m-d",
    ];

    protected $hidden=[
        // "created_at",
        // "updated_at"
    ];

}
