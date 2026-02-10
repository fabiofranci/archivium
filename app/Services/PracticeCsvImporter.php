<?php

namespace App\Services;

use App\Models\Practice;
use App\Models\MetadataDefinition;
use App\Models\PracticeMetadata;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SplFileObject;

class PracticeCsvImporter
{
    public function import(string $csvPath, string $archiveBasePath): int
    {
        $file = new SplFileObject($csvPath);
        $file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
        );

        $headers = [];
        $imported = 0;

        DB::transaction(function () use ($file, &$headers, &$imported, $archiveBasePath) {
            foreach ($file as $index => $row) {
                if ($index === 0) {
                    $headers = $this->normalizeHeaders($row);
                    continue;
                }

                if (!is_array($row)) {
                    continue;
                }

                if (count(array_filter($row, fn ($v) => $v !== null && $v !== '')) === 0) {
                    continue;
                }

                $data = array_combine($headers, $row);

                if ($data === false) {
                    Log::warning('CSV row/header mismatch', [
                        'row' => $row,
                        'headers' => $headers,
                    ]);
                    continue;
                }

                $practice = Practice::create([
                    'external_code' => $data['external_code'] ?? null,
                    'file_path'     => $data['file_path'] ?? null,
                ]);

                // Verifica file path (read-only)
                if (! empty($practice->file_path)) {
                    $fullPath = rtrim($archiveBasePath, '/') . '/' . ltrim($practice->file_path, '/');

                    if (! file_exists($fullPath)) {
                        Log::warning('File not found for practice', [
                            'practice_id' => $practice->id,
                            'path'        => $fullPath,
                        ]);
                    }
                }

                foreach ($data as $key => $value) {
                    if (in_array($key, ['external_code', 'file_path'])) {
                        continue;
                    }

                    if ($value === null || $value === '') {
                        continue;
                    }

                    $definition = MetadataDefinition::firstOrCreate(
                        ['code' => $key],
                        [
                            'label' => ucfirst(str_replace('_', ' ', $key)),
                            'type'  => 'string',
                        ]
                    );

                    PracticeMetadata::create([
                        'practice_id'            => $practice->id,
                        'metadata_definition_id' => $definition->id,
                        'value'                  => $value,
                    ]);
                }

                $imported++;
            }
        });

        return $imported;
    }

    protected function normalizeHeaders(array $headers): array
    {
        return array_map(function ($header) {
            return trim(
                strtolower(
                    str_replace(' ', '_', $header)
                )
            );
        }, $headers);
    }
}
