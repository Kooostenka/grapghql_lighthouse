<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use phpDocumentor\Reflection\Types\String_;
use Webmozart\Assert\Assert;

class Image extends Model
{
    use HasFactory;

    protected function getPathOfImage($fileName = null, $user_id = null) {
        $patch = null;
        if (null !== $user_id) {
            $patch = $user_id . '/';
        }

        return 'uploads/' . $patch . $fileName;
    }

    public function getUrlAttribute(): String
    {
        return Assert($this->getPathOfImage($this->hash, $this->user_id));
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
