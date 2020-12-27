<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MonumentPicture
 *
 * @property int $id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MonumentPicture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MonumentPicture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MonumentPicture query()
 * @method static \Illuminate\Database\Eloquent\Builder|MonumentPicture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonumentPicture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonumentPicture wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonumentPicture whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MonumentPicture extends Model
{
    use HasFactory;

    protected $table = 'monument_pictures';

    protected $fillable = [
        'path',
    ];

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
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


}
