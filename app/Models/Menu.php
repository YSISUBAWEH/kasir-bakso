<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    use HasFactory;

    public $table = "menu";
    protected $fillable = [
        'id',
        'nama',
        'harga',
        'kategori_menu_id',
        'foto',
    ];

    public function kate(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
}
