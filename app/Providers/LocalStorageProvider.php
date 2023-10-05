<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;

class LocalStorageProvider implements IStorageProvider
{
    public function save($file, $folder)
    {
        $sourceFilePath = storage_path("app/{$file}");
        $destinationFilePath = storage_path("app/{$folder}/{$file}");

        // Move o arquivo para o destino
        File::move($sourceFilePath, $destinationFilePath);

        return $file;
    }

    public function delete($file, $folder)
    {
        $filePath = storage_path("app/{$folder}/{$file}");

        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }
}
