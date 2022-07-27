<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\ContactRequest;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactRequestImport implements ToModel, WithHeadingRow, ShouldQueue, WithChunkReading
{
    public function model(array $row)
    {
        $category = Category::where('name', $row['kategorie'])->first();

        return new ContactRequest([
            'name' => $row['name'],
            'email' => $row['email'],
            'message' => $row['message'],
            'category_id' => $category->id,
        ]);
    }

    public function chunkSize(): int
    {
        return 10;
    }
}
