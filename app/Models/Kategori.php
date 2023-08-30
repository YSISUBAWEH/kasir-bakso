<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;
    public $table = "kategori_menu";
    protected $fillable = [
        'nama',
    ];


    public function menu(): HasMany{
        return $this->hasMany(Menu::class);
    }
}
