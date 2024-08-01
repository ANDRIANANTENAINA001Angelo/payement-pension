<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historique extends Model
{
    use HasFactory;

    protected $fillable= [
        "date_payment",
        "pensionnaire_id",
        "montant",
        "personnel_id"
    ];

    public function pensionnaire():BelongsTo{
        return $this->belongsTo(Pensionnaire::class,"pensionnaire_id");
    }

    public function personnel():BelongsTo{
        return $this->belongsTo(User::class,"personnel_id");
    }

    protected $hidden=[
        "created_at",
        "updated_at"
    ];


}
