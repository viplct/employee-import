<?php

namespace App\Http\Controllers;

use App\Services\EmployeeImportService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ImportController extends Controller
{
    public function __construct(protected readonly EmployeeImportService $importService)
    {
    }
    public function import(Request $request)
    {
        $raw = $request->getContent();

        if (empty($raw)) {
            return $this->sendResponse([
                'status' => 'error',
                'message' => 'CSV content is missing.',
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $this->importService->handleImport($raw);
            return $this->sendResponse(['message' => 'Import successful.']);
        } catch (\Exception $e) {
            return $this->sendResponse(['error' => 'Import failed: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
