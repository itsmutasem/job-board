<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToText\Pdf;

class ResumeAnalysisService
{
    public function extractResumeInformation(string $fileUrl)
    {
        // Extract raw text form the resume pdf file (read pdf file, and get the text)
        $rawText = $this->extractTextFromPdf($fileUrl);

        Log::debug('Successfully extracted text from pdf file' . strlen($rawText) . 'characters');

        // Use OpenAI API to organize the text info a structured format
        // Output: summary, skills, experience, education -> JSON

        // Return the JSON object
        return [
            'summary' => '',
            'skills' => '',
            'experience' => '',
            'education' => ''
        ];
    }

    public function extractTextFromPdf(string $fileUrl): string
    {
        // Reading the file form the cloud to local disk storage in temp file
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

        // Check if pdf-to-text is installed
        $pdfToTextPath = ['/mingw64/bin/pdftotext', '/usr/bin/pdftotext', '/usr/local/bin/pdftotext'];
        $pdfToTextAvailable = false;

        foreach ($pdfToTextPath as $path) {
            if (file_exists($path)) {
                $pdfToTextAvailable = true;
                break;
            }
        }

        if (!$pdfToTextAvailable) {
            throw new \Exception('pdf-to-text is not installed');
        }

        // Extract text form the pdf file
        $instance = new PDF();
        $instance->setPdf($tempFile);
        $text = $instance->text();

        // Clear up the temp file
        unlink($tempFile);

        return $text;
    }
}
