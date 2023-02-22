<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class products extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'description',
        'sections_id',
    ];

    public function productionToSectionsRealtions(): BelongsTo
    {
        return $this->belongsTo(sections::class,'sections_id');
    }
    
}
