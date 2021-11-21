<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;                  // 因使用collection需Model::all()，故無法使用SQL語法查詢輸出，將其轉換為陣列格式處理
use Maatwebsite\Excel\Concerns\ShouldAutoSize;             // 自動等寬
use Maatwebsite\Excel\Concerns\WithHeadings;               // 啟用表頭headings陣列格式輸出
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;   // 匯出 0 原樣顯示，不為 null
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class UserDataExport implements FromArray, ShouldAutoSize, WithEvents, WithTitle, WithHeadings, WithStrictNullComparison
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
        return '員工資料';
    }

    public function headings(): array
    {
        return [
            '帳號',
            '姓名',
            '性別',
            '出生年月日',
            '身分證字號',
            '電子郵件',
            '電話',
            '證照到期日',
            '建立日期',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                // 設定title背景色
                $sheet->getStyle('A1:K1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('D9D9D9');
                $widths = [
                    'A' => 15, 'B' => 20, 'C' => 10, 'D' => 10, 'E' => 15, 
                    'F' => 15, 'G' => 25, 'H' => 15, 'I' => 15
                ];
                foreach ($widths as $k => $v) {
                    // 設定列寬度
                    $sheet->getColumnDimension($k)->setAutoSize(false);
                    $sheet->getColumnDimension($k)->setWidth($v);
                }
                $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A1:I1')->getFont()->setBold(true);

                $rows_count = $sheet->getHighestDataRow();

                $sheet->getStyle("I2:I".($rows_count))->getFont()->getColor()->setARGB('FF0000');
            },
        ];
    }
}