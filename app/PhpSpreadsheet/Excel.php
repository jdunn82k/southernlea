<?php


namespace App\PhpSpreadsheet;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Exception;



class Excel
{
    public static function basic($headers, $rows)
    {
        //Initialize New Spreadsheet
        $sp = new Spreadsheet();
        try
        {
            $sheet = $sp->getActiveSheet();
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }

        //Set Header
        $cell_letter = "A";
        for($i = 0;$i<count($headers);$i++)
        {

            $sheet->setCellValue($cell_letter."1", $headers[$i]);
            if ($cell_letter !== "J" && $cell_letter !== "K")
            {
                $sp->getActiveSheet()->getColumnDimension($cell_letter)->setAutoSize(true);
            } else {
                $sp->getActiveSheet()->getColumnDimension($cell_letter)->setWidth(12);
            }
            $sp->getActiveSheet()->getStyle($cell_letter."1", $headers[$i])
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

            $cell_letter++;
        }

        //Set Rows
        $row_num = 2;
        foreach($rows as $row)
        {
            $cell_letter = "A";
            foreach($row as $item)
            {
                $sheet->setCellvalue($cell_letter.$row_num, $item);
                $sp->getActiveSheet()->getStyle($cell_letter.$row_num)->getAlignment()->setWrapText(true);

                $sp->getActiveSheet()->getStyle($cell_letter.$row_num)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $cell_letter++;
            }
            $row_num++;
        }

        //Create file and send to output
        $writer = new Xlsx($sp);

//        $writer->save('export.xlsx');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="export.xlsx"');
        try{
            $writer->save("php://output");
        } catch (Exception $e){
            return $e->getMessage();
        }
        exit;

    }
}