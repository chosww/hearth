<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ResourceCollection extends Model
{
    use HasFactory;
    use HasTranslations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'user_id',
        'description',
    ];

    /**
     * The attributes that are transterms
     *
     * @var array
     */
    public $translatable = [
        'title',
        'description',
    ];

    /**
     * Get user of this resource collection
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the resources that are assigned this collection.
     */
    public function resources()
    {
        return $this->belongsToMany(Resource::class);
    }
}
