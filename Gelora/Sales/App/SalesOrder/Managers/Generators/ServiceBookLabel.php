<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Generators;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

require(base_path('Solumax/PhpHelperExtended/Fpdf/fpdf.php'));

class ServiceBookLabel {

    protected $salesOrder;
    protected $unit;
    protected $pdf;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
        $this->unit = $this->salesOrder->unit;
    }

    public function generate() {

        $this->barcodeFile = tempnam('/tmp', $this->salesOrder->id);
        include(base_path('Solumax/PhpHelper/Libraries/barcode.php'));
        barcode($this->barcodeFile, str_replace(' ', '', $this->unit->getAttribute('engine_number')));
        
        
        $tenantInfo = (object) \Setting::retrieve()->data('TENANT_INFO')->data_1;
        $this->dealerCode = $tenantInfo->DEALER_CODE;

        $this->pdf = new \FPDF('P', 'mm', [165, 200]);
        $this->pdf->SetFont('Arial', '', 7);
        $this->pdf->AddPage('P');
        $this->pdf->SetMargins(0,0,0);
        $this->pdf->SetAutoPageBreak(false);
        
        $this->generateColumnLabels();

        $filename = 'SPK-' . $this->salesOrder->id . '.pdf';
        return $this->pdf->Output('I', $filename);
    }

    protected function generateColumnLabels() {
        
        $leftMargin = 5;

        for ($i = 0; $i < 5; $i++) {
            
            $rowY = (39 * $i) + 2;
            $secondColumnX = $this->pdf->GetPageWidth() / 2 + $leftMargin;
            
            $this->pdf->SetXY($leftMargin, $rowY);
            $this->generateLabel();
            $this->pdf->SetXY($secondColumnX, $rowY);
            $this->generateLabel();
        }
    }

    protected function generateLabel() {
        
        $rowHeight = 3.5;

        $this->pdf->Image($this->barcodeFile, null, null, 60, 7, 'PNG');
        $this->pdf->Cell(0, $rowHeight, 'NO MESIN: ' . str_replace(' ', '', $this->unit->getAttribute('engine_number')), 0, 2);
        $this->pdf->Cell(0, $rowHeight, 'NO RANGKA: ' . $this->unit->getAttribute('chasis_number'), 0, 2);
        $this->pdf->Cell(0, $rowHeight, 'NAMA: ' . $this->salesOrder->getAttribute('customer.name'), 0, 2);
        $this->pdf->Cell(0, $rowHeight, 'ALAMAT: ' . $this->salesOrder->getAttribute('customer.address'), 0, 2);
        $this->pdf->Cell(0, $rowHeight, 'Type: ' . $this->unit->getAttribute('type_name'), 0, 2);
        $this->pdf->Cell(0, $rowHeight, $this->dealerCode, 0, 2);
    }

}
