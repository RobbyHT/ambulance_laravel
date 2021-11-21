<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;                  // 因使用collection需Model::all()，故無法使用SQL語法查詢輸出，將其轉換為陣列格式處理
use Maatwebsite\Excel\Concerns\ShouldAutoSize;             // 自動等寬
use Maatwebsite\Excel\Concerns\WithHeadings;               // 啟用表頭headings陣列格式輸出
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;   // 匯出 0 原樣顯示，不為 null
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class EquipmentDataExport implements FromArray, ShouldAutoSize, WithEvents, WithTitle, WithHeadings, WithStrictNullComparison
{
    protected $invoices;

    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }

    public function array(): array
    {
        return $this->invoices;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return '設備資料';
    }

    public function headings(): array
    {
        return [
            '設備名稱',
            '數量',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                // 設定title背景色
                $sheet->getStyle('A1:B1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('D9D9D9');
                $widths = [
                    'A' => 30, 'B' => 10
                ];
                foreach ($widths as $k => $v) {
                    // 設定列寬度
                    $sheet->getColumnDimension($k)->setAutoSize(false);
                    $sheet->getColumnDimension($k)->setWidth($v);
                }
                $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A1:B1')->getFont()->setBold(true);

                $rows_count = $sheet->getHighestDataRow();
            },
        ];
    }
}