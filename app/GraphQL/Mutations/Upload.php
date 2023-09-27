<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Image;
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
        $validator = \Validator::make($args, [
            'file' => 'required|image'
        ]);

        if($validator->fails()){
            throw new Error('Invalid type');
        }


        /** @var \Illuminate\Http\UploadedFile $file */
        $file = $args['file'];

        Storage::disk('public')->put(Image::getPathOfImage(null, null), $file);

        $image = new Image();
        $image->name = $file->getFilename();
        $image->hash = $file->hashName();
        $image->save();

        return $image;
    }
}
