<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\Job_translation;

class Job extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    /**
     * @var \Illuminate\Support\HigherOrderCollectionProxy|mixed
     */
    public $translationModel = Job_translation::class;
    public $translatedAttributes = ['title', 'description']; 
    
    // Define your normal fillable attributes
    protected $fillable = ['employer_id', 'salary', 'url', 'featured', 'location', 'type'];      
    protected $table = 'jobs';

    public function Tag(string $name): void
    {
        $Tag = Tag::firstOrCreate(['name' => strtolower($name)]);

        $this->Tags()->attach($Tag);
    }

    public function Tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function Employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function salary(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }
}
