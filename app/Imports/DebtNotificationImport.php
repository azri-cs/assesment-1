<?php

namespace App\Imports;

use App\Models\DebtNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DebtNotificationImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DebtNotification([
            'mobile_number' => $row['mobile_number'],
            'text1' => $row['text1'],
            'amount' => $row['amount'],
            'text2' => $row['text2']
        ]);
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
