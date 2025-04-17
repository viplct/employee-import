<?php

namespace App\Services;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use Illuminate\Support\Facades\File;

class EmployeeImportService
{
    protected int $chunkSize = 1000;
    public function handleImport(string $rawContent): void
    {
        // Set execution limits for large files
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '0');

        // Temporary path to store CSV file
        $tmpPath = storage_path('app/tmp_upload.csv');

        // Save the raw content to a file
        File::put($tmpPath, $rawContent);

        try {
            // Handle the import process
            $this->import($tmpPath);
        } catch (\Exception $e) {
            // Clean up file in case of an error
            $this->cleanUp($tmpPath);
            throw $e;
        }

        // Clean up the temporary file after successful import
        $this->cleanUp($tmpPath);


    }

    private function import(string $filePath)
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setDelimiter(',');
        $csv->setHeaderOffset(0);

        // Convert to array for chunking
        $records = iterator_to_array($csv->getRecords());

        foreach (array_chunk($records, $this->chunkSize) as $chunk) {
            DB::transaction(function () use ($chunk) {
                foreach ($chunk as $record) {
                    Employee::updateOrCreate(
                        ['employee_id' => $record['Emp ID']],
                        [
                            'user_name'        => $record['User Name'],
                            'name_prefix'      => $record['Name Prefix'],
                            'first_name'       => $record['First Name'],
                            'middle_initial'   => $record['Middle Initial'],
                            'last_name'        => $record['Last Name'],
                            'gender'           => $record['Gender'],
                            'email'            => $record['E Mail'],
                            'date_of_birth'              => date('Y-m-d', strtotime($record['Date of Birth'])),
                            'time_of_birth'              => $this->convertToTime24($record['Time of Birth']) ?: null,
                            'age'              => (int)$record['Age in Yrs.'],
                            'date_of_joining'              => date('Y-m-d', strtotime($record['Date of Joining'])),
                            'age_in_company'   => (float)$record['Age in Company (Years)'],
                            'phone'            => $record['Phone No.'],
                            'place'            => $record['Place Name'],
                            'county'           => $record['County'],
                            'city'             => $record['City'],
                            'zip'              => $record['Zip'],
                            'region'           => $record['Region'],
                        ]
                    );
                }
            });
        }
    }

    private function convertToTime24(string $time): ?string
    {
        try {
            return Carbon::createFromFormat('h:i:s A', $time)?->format('H:i:s');
        } catch (\Exception $e) {
            return null;
        }
    }

    private function cleanUp(string $filePath)
    {
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }
}
