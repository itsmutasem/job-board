<?php

namespace App\Services;

class ResumeAnalysisService
{
    public function extractResumeInformation(string $fileUrl)
    {
        // Extract raw text form the resume pdf file (read pdf file, and get the text)

        // Use OpenAI API to organize the text info a structured format
        // Output: summary, skills, experience, education -> JSON

        // Return the JSON object
    }
}
