<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class MembersExport implements FromArray, WithStrictNullComparison
{
    protected $members;

    public function __construct(array $members)
    {
        $this->members = $members;
    }

    public function array(): array
    {
        return $this->members;
    }
}
