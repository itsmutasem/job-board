<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use OpenAI\Laravel\Facades\OpenAI;
use Spatie\PdfToText\Pdf;

class ResumeAnalysisService
{
    public function extractResumeInformation(string $fileUrl)
    {
        try {
            // Extract raw text form the resume pdf file (read pdf file, and get the text)
            $rawText = $this->extractTextFromPdf($fileUrl);

            Log::debug('Successfully extracted text from pdf file' . strlen($rawText) . 'characters');

            // Use OpenAI API to organize the text info a structured format
            $response = OpenAI::chat()->create([
                'model' => 'gpt-4o',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a precise resume parser. Extract information exactly as it appears in the resume without adding any interpretation or additional information. The output should be in JSON format.'
                    ],
                    [
                        'role' => 'user',
                        'content' => "Parse the following resume content and extract the information as a JSON object with the exact keys: 'summary', 'skills', 'experience', 'education'. The resume content is: {$rawText}. Return an empty string for key that is not found."
                    ]
                ],
                'response_format' => [
                    'type' => 'json_object'
                ],
                'temperature' => 0.1
            ]);

            $result = $response->choices[0]->message->content;
            Log::debug('OpenAI response: ' . $result);

            $parsedResult = json_decode($result, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('Failed to parse OpenAI response: ' . json_last_error_msg());
                throw new \Exception('Failed to parse OpenAI response');
            }

            // Validate the parsed result
            $requiredKeys = ['summary', 'skills', 'experience', 'education'];
            $missingKeys = array_diff($requiredKeys, array_keys($parsedResult));

            if (count($missingKeys) > 0) {
                Log::error('Missing required keys: ' . implode(', ' . $missingKeys));
                throw new \Exception('Missing required keys in the parsed result');
            }

            // Return the JSON object
            return [
                'summary' => $parsedResult['summary'] ?? '',
                'skills' => $parsedResult['skills'] ?? '',
                'experience' => $parsedResult['experience'] ?? '',
                'education' => $parsedResult['education'] ?? ''
            ];
        } catch (\Exception $e) {
            Log::error('Error extracting resume information: ' . $e->getMessage());
            return [
                'summary' => '',
                'skills' => '',
                'experience' => '',
                'education' => '',
            ];
        }
    }

    public function analyzeResume($jobVacancy, $resumeData)
    {
        try {
            $jobDetails = json_encode([
                'job_title' => $jobVacancy->title,
                'job_description' => $jobVacancy->description,
                'job_location' => $jobVacancy->location,
                'job_type' => $jobVacancy->type,
                'job_salary' => $jobVacancy->salary,
            ]);

            $resumeDetails = json_encode($resumeData);

            $response = OpenAI::chat()->create([
                'model' => 'gpt-4o',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => "Yor are an expert HR professional and job recruiter.
                            You are given a job job vacancy and a resume.
                            Your task is to analyze the resume and determine if candidate is a good fit for the job.
                            The output should be in JSON format.
                            Provide a score form 0 to 100 for the candidate's suitability for the job, and a detailed feedback.
                            Response should only be JSON that has the following keys: 'aiGeneratedScore', 'aiGeneratedFeedback'.
                            AI generated feedback should be detailed and specific to the job and the candidate's resume."
                    ],
                    [
                        'role' => 'user',
                        'content' => "Pleas evaluate this job application.
                            Job Details: {$jobDetails}.
                            Resume Details: {$resumeDetails}"
                    ]
                ],
                'response_format' => [
                    'type' => 'json_object'
                ],
                'temperature' => 0.1
            ]);

            $result = $response->choices[0]->message->content;
            Log::debug('OpenAI evaluation response: ' . $result);

            $parsedResult = json_decode($result, true);
        } catch () {

        }
    }

    public function extractTextFromPdf(string $fileUrl): string
    {
        // Reading the file form the cloud to local disk storage in temp file
        $tempFile = tempnam(sys_get_temp_dir(), 'resume');
        $filePath = parse_url($fileUrl, PHP_URL_PATH);

        if (!$filePath) {
            throw new \Exception('Invalid file URL');
        }

        $filename = basename($filePath);

        $storagePath = "resumes/{$filename}";

        if (!Storage::disk('cloud')->exists($storagePath)) {
            throw new \Exception('File not found');
        }

        $pdfContent = Storage::disk('cloud')->get($storagePath);
        if (!$pdfContent) {
            throw new \Exception('Failed to read file');
        }

        file_put_contents($tempFile, $pdfContent);

        // Set Poppler binary path depending on OS
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Windows
            $binaryPath = 'C:/poppler/poppler-25.07.0/Library/bin/pdftotext.exe';
        } else {
            // Linux/macOS (common locations)
            $binaryPath = '/usr/bin/pdftotext';
        }

        // Extract text using Spatie
        $text = (new Pdf($binaryPath))
            ->setPdf($tempFile)
            ->text();

        // Clear up the temp file
        unlink($tempFile);

        return $text;
    }
}
