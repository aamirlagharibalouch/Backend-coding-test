<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyOrganizationController extends Controller
{
    public function index()
    {
        $files = [
            "insurance.txt" => "Company A",
            "letter.docx" => "Company A",
            "Contract.docx" => "Company B"
        ];

        $result = $this->groupByOwners($files);

        echo "<h2>Input Array</h2>";

        echo "<pre>";
        print_r($files);
        echo "<hr>";
        echo "<h2>Output Array</h2>";
        print_r($result);
        echo "</pre>";
    }

    private function groupByOwners($files)
    {
        $result = [];

        foreach ($files as $file => $owner) {
            if (!isset($result[$owner])) {
                $result[$owner] = [];
            }

            $result[$owner][] = $file;
        }

        return $result;
    }
}
