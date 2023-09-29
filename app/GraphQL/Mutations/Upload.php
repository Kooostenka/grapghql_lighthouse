<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use PhpParser\Error;

final class Upload
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        /** @var User $user */
        $user = \Auth::guard()->user();

        /** @var \Illuminate\Http\UploadedFile $file */
        $file = $args['file'];

        Storage::disk('public')->put(Image::getPathOfImage(null, null), $file);

        $image = new Image();
        $image->name = $file->getFilename();
        $image->hash = $file->hashName();
        $image->user_id = $user->id;
        $image->save();

        return $image;
    }
}
