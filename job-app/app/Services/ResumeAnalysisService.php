<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ResumeAnalysisService
{
    public function extractResumeInformation(string $fileUrl)
    {
        // Extract raw text form the resume pdf file (read pdf file, and get the text)
        $rawText = $this->extractTextFromPdf($fileUrl);

        // Use OpenAI API to organize the text info a structured format
        // Output: summary, skills, experience, education -> JSON

        // Return the JSON object
    }

    public function extractTextFromPdf(string $fileUrl): string
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'resume');
        $filePath = parse_url($fileUrl, PHP_URL_PATH);

        if (!$filePath) {
            throw new \Exception('Invalid file URL');
        }

        $filename = basname($filePath);

        $storagePath = "resumes/{$filename}";

        if (!Storage::disk('cloud')->exists($storagePath)) {
            throw new \Exception('File not found');
        }

        $pdfContent = Storage::disk('cloud')->get($storagePath);
        if (!$pdfContent) {
            throw new \Exception('Failed to read file');
        }

        file_put_contents($tempFile, $pdfContent);
    }
}
