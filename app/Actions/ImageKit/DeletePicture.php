<?php

namespace App\Actions\ImageKit;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DeletePicture
{
    /**
     * Удаляет файл с ImageKit по его ID.
     *
     * @param string $fileId
     * @return bool
     */
    public function execute(string $fileId): bool
    {
        try {
            /** @var \JunaidiAR\ImageKitAdapter\ImageKitAdapter $adapter */
            $adapter = Storage::disk('imagekit')->getAdapter();
            $imagekitClient = $adapter->getClient();

            // Вызов метода deleteFile для удаления файла по его ID
            $response = $imagekitClient->deleteFile($fileId);

            if (isset($response->responseMetadata['statusCode']) && $response->responseMetadata['statusCode'] === 204) {
                return true;
            }

            Log::error('ImageKit delete failed. API returned an error.', [
                'fileId' => $fileId,
                'response' => json_decode(json_encode($response), true)
            ]);

            return false;

        } catch (\Throwable $e) {
            // Логирование исключения в случае сбоя запроса
            Log::error('ImageKit delete exception: ' . $e->getMessage(), [
                'fileId' => $fileId,
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return false;
        }
    }
}