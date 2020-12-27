<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

/**
 * App\Models\Monument
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $latitude
 * @property string $longitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Monument filter(array $frd)
 * @method static Builder|Monument newModelQuery()
 * @method static Builder|Monument newQuery()
 * @method static Builder|Monument query()
 * @method static Builder|Monument whereCreatedAt($value)
 * @method static Builder|Monument whereDescription($value)
 * @method static Builder|Monument whereId($value)
 * @method static Builder|Monument whereLatitude($value)
 * @method static Builder|Monument whereLongitude($value)
 * @method static Builder|Monument whereName($value)
 * @method static Builder|Monument whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Monument extends Model
{
    use HasFactory;
    use HasTrixRichText;

    protected $table = 'monuments';

    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'monument-trixFields',
        'attachment-monument-trixFields',
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude(string $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude(string $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreatedAt(): ?\Illuminate\Support\Carbon
    {
        return $this->created_at;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdatedAt(): ?\Illuminate\Support\Carbon
    {
        return $this->updated_at;
    }

    /**
     * @param Builder $query
     * @param array $frd
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $frd): Builder
    {
        foreach ($frd as $key => $value) {
            switch ($key) {
                case 'search':
                    $query->where('name', 'like', '%' . $value . '%');
                    break;
            }
        }

        return $query;
    }

    /**
     * @return BelongsToMany
     */
    public function monumentPictures():BelongsToMany{
        return $this->belongsToMany(MonumentPicture::class, 'monuments_monument_pictures');
    }

    /**
     * @return Collection
     */
    public function getMonumentPictures():Collection{
        return $this->monumentPictures()->get();
    }

}
