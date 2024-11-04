<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

/**
 * Upload File
 *
 * @param Livewire\TemporaryUploadedFile $file
 * @param string $collection
 *
 * @return string
 */
function uploadFile(TemporaryUploadedFile $file, $collection = ""): string
{
    $mime = $file->getMimeType();
    $extension = "." . $file->getClientOriginalExtension();
    $collection = $collection != "" ? $collection . "/" : null;
    if (Str::contains($mime, "video")) {
        $path = "videos/";
        $file = $file->get();
    } elseif (Str::contains($mime, "image")) {
        $path = "images/";
        $extension = ".webp";
        $file = Image::make($file)->encode("webp");
    } else {
        $path = "documents/";
        $file = $file->get();
    }

    $path = $path . $collection;
    ensureDirExists($path);
    $path = $path . sha1(Str::uuid()) . $extension;
    Storage::disk("local_public")->put($path, $file);
    return $path;
}

function ensureDirExists($dir)
{
    $dir = public_path("storage/" . $dir);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

/**
 * check and remove file if available
 *
 * @param string $file
 *
 * @return void
 */
function deleteFile($file)
{
    if ((file_exists(public_path("storage/" . $file)) && is_string($file) && $file != "")) {
        unlink(public_path("storage/" . $file));
    }
}

/**
 * Search Array by its Value
 * and return its key
 *
 * @param array $array
 * @param mixed $value
 *
 * @return mixed
 */
function flipSearch(array $array, $value): mixed
{
    $flip = array_flip($array);
    if ($value == "") {
        return null;
    }
    return $flip[$value];
}

/**
 * Check user roles
 * using spatie/laravel-permission package
 * used for auth()->user() method
 *
 * @param App\Models\User $user
 * @param mixed $role
 *
 * @return bool
 */
function roleCheck($user, $role)
{
    if (is_null($user)) return false;
    return $user->hasRole($role);
}

function checkFileType(string $path, string $type): bool
{
    if ((file_exists($path) && is_string($path) && $path != "")) {
        $mime = File::mimeType($path);
        return Str::contains($mime, $type);
    }
    return false;
}

function number_format_short(int|float $num)
{
    return (new NumberFormatter(
        app()->getLocale(),
        NumberFormatter::PADDING_POSITION
    ))->format($num);
}

function money_format(int|float $num)
{
    return "Rp. " . number_format($num);
}

/**
 * return default asset if resource not found
 * this method work with Storage::url() method
 *
 * @param string $asset | '/asset/image/test.png' | dont use '/storage/asset/image/test.png'
 * @param string $default | '/asset/image/test.png' | dont use '/storage/asset/image/test.png'
 */
function asset_default($asset, $default = "")
{
    $asset = Storage::url($asset);
    $default = Storage::url($default);
    if (file_exists(public_path($asset)) && $asset != "/storage/") {
        return $asset;
    }

    return $default;
}
