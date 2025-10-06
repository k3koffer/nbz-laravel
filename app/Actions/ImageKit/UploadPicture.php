<?php

namespace App\Actions\ImageKit;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;
use JunaidiAR\ImageKitAdapter\ImageKitAdapter;
use Illuminate\Support\Facades\Log;

class UploadPicture
{
    /**
     * Загружает файл на ImageKit и возвращает путь и ID файла.
     *
     * @param UploadedFile $file
     * @return array{path: string, imagekit_id: string}|null
     */

    public function execute(UploadedFile $file): ?array
    {
        try {
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $folder = 'posts/';

            $adapter = Storage::disk('imagekit')->getAdapter();
            $imagekitClient = $adapter->getClient();

            $response = $imagekitClient->upload([
                'file' => fopen($file->getRealPath(), 'r'), // Получаем содержимое файла
                'fileName' => $fileName,
                'folder' => $folder,
            ]);

            if (is_object($response) && isset($response->result->fileId) && isset($response->result->filePath)) {
                return [
                    'path'        => $response->result->filePath,
                    'imagekit_id' => $response->result->fileId,
                ];
            }

            Log::error('ImageKit upload failed. Invalid response structure after successful upload.', [
                'response' => json_decode(json_encode($response), true)
            ]);
            return null;
            
        } catch (\Throwable $e) {
            Log::error('ImageKit upload exception: ' . $e->getMessage(), [
                'file' => $file->getClientOriginalName(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return null;
        }

        return null;
    }
}