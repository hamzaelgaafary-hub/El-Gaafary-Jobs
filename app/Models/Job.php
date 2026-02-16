<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;

    /**
     * @var \Illuminate\Support\HigherOrderCollectionProxy|mixed
     */
    protected $fillable = [];

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
