<?php
namespace App\MediaLib;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;

class CustomPathGenerator extends DefaultPathGenerator
{
    public function getPath(Media $media) : string
    {
        if ($media->model_type == 'App\Models\User') {
            return 'user/' . $media->getKey().'/';
        }
        if ($media->model_type == 'App\Models\PeternakanBerkas') {
            return 'peternakan-berkas/' . $media->getKey().'/';
        }
        if ($media->model_type == 'App\Models\PerikananBerkas') {
            return 'perikanan-berkas/' . $media->getKey().'/';
        }
        if ($media->model_type == 'App\Models\Galeri') {
            return 'galeri/' . $media->getKey().'/';
        }
        if ($media->model_type == 'App\Models\PraktekDokterHewanBerkas') {
            return 'praktek-dokter-hewan-berkas/' . $media->getKey().'/';
        }
        return $media->id;
    }

    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media) . 'conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media) . 'responsive/';
    }
}
