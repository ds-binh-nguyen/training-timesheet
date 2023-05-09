<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class TimesheetExport implements ShouldAutoSize, FromView, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('exports.timesheet', [
            'timesheets' => $this->data
        ]);
    }

    public function registerEvents(): array
    {
        return array(
            AfterSheet::class => function(AfterSheet $event) {
                // Set Filter for header Username and Date
                $event->sheet->getDelegate()->setAutoFilter('A1:B1');
            }
        );
    }
}
