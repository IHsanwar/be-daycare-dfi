<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ChildHistoryExport implements FromView, WithEvents
{
    protected $child;
    protected $histories;

    public function __construct($child, $histories)
    {
        $this->child = $child;
        $this->histories = $histories;
    }

    public function view(): View
    {
        return view('excel.excel_child_history', [
            'child' => $this->child,
            'histories' => $this->histories
        ]);
    }
    
    /**
     * Register events handlers for styling the Excel export
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;
                
                $headerRange = 'A1:' . $sheet->getHighestColumn() . '1';
                $sheet->getDelegate()->getStyle($headerRange)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => '4472C4'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                
                $childInfoRange = 'A2:' . $sheet->getHighestColumn() . '5';
                $sheet->getDelegate()->getStyle($childInfoRange)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'E9EFF7'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);
                
                $sectionHeaderStyle = [
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'D9E1F2'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ];
                
                $sheet->getDelegate()->getStyle('A6:' . $sheet->getHighestColumn() . '6')->applyFromArray($sectionHeaderStyle);
                
                $historyStartRow = 7;
                
                // Apply zebra striping to the histories section
                $historyLastRow = $sheet->getHighestRow();
                for ($row = $historyStartRow; $row <= $historyLastRow; $row++) {
                    // Apply light gray to even rows
                    if ($row % 2 == 0) {
                        $sheet->getDelegate()->getStyle('A' . $row . ':' . $sheet->getHighestColumn() . $row)
                            ->getFill()
                            ->setFillType(Fill::FILL_SOLID)
                            ->getStartColor()
                            ->setRGB('F2F2F2');
                    }
                }
                
                // Auto-size columns for better readability
                foreach (range('A', $sheet->getHighestColumn()) as $col) {
                    $sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
            }
        ];
    }
}