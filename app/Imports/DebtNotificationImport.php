<?php

namespace App\Imports;

use App\Models\DebtNotification;
use DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DebtNotificationImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    public function collection(Collection $collection): void
    {
        $chunks = $collection->chunk(5000);

        foreach ($chunks as $chunk) {
            $records = $chunk->map(function ($row) {
                return [
                    'mobile_number' => $row['mobile_number'],
                    'text1' => $row['text1'],
                    'amount' => $row['amount'],
                    'text2' => $row['text2'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();

            DB::table('debt_notifications')->insert($records);
        }
    }

    public function batchSize(): int
    {
        return 5000; //adjust according to server specs
    }

    public function chunkSize(): int
    {
        return 5000; //adjust according to server specs
    }
}
