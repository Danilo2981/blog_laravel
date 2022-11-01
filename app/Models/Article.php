<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", 
        "category_id", 
        "title", 
        "content",
    ];

    protected $perPage = 5;

    // Utilizamos self para atar al usuario autentificado el articulo
    protected static function boot() {
        parent::boot();
        if(!app()->runningInConsole()) {
            self::creating(function (Article $article) {
                $article->user_id = auth()->id();
            });
        } 
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    // Mostrar dia hora y minuto sin segundo
    public function getCreatedAtFormattedAttribute(): string {
        return Carbon::parse($this->created_at)->format("d-m-Y H:i");
    }

    // Crea un resumen del contenido
    public function getExcerptAttribute(): string {
        return Str::excerpt($this->content);
    }
}
