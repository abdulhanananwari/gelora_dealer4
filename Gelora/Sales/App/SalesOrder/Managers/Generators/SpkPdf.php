<?php

namespace Gelora\Sales\App\SalesOrder\Managers\Generators;

use Gelora\Sales\App\SalesOrder\SalesOrderModel;

require(base_path('Solumax/PhpHelperExtended/Fpdf/fpdf.php'));

class SpkPdf {

    protected $salesOrder;
    protected $pdf;

    public function __construct(SalesOrderModel $salesOrder) {
        $this->salesOrder = $salesOrder;
        $this->salesOrderBalance = $salesOrder->calculate()->salesOrderBalance();
        $this->pdf = new \FPDF();
    }

    public function generate($download = false) {

        $filename = 'SPK-' . $this->salesOrder->id . '-' . \Carbon\Carbon::now()->timestamp . '.pdf';

        $this->pdf->AddPage('P', 'Legal');

        $this->generateHeading();

        $this->generateMetaData();
        $this->generatePersonalData();

        $this->generateOrderData();

        $this->generateExtras();
        $this->generatePayments();

        if ($this->salesOrder->payment_type == 'credit') {
            $this->generateCreditData();
        }

        $this->generateFooter();
        $this->generateSpkNote();

        if ($download) {

            return $this->pdf->Output('I', $filename);
        } else {

            $content = $this->pdf->Output('S', $filename);
            return $this->upload($content);
        }
    }

    protected function generateLine($draw = true) {

        $width = $this->pdf->GetPageWidth();
        $this->pdf->Ln(5);
        $y = $this->pdf->GetY();
        if ($draw) {
            $this->pdf->Line(0 + 10, $y, $width - 10, $y);
        }
    }

    protected function generateHeading() {

        $setting = \Setting::retrieve()->data('TENANT_INFO');
        $tenantInfo = (object) $setting->data_1;

        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->Cell(0, 10, $tenantInfo->TENANT, 0, 1);


        $width = $this->pdf->GetPageWidth();
        $y = $this->pdf->GetY();

        if (isset($tenantInfo->LOGO)) {
            $this->pdf->Image($tenantInfo->LOGO, $width - 30, 10, 20);
        }

        $this->pdf->SetY($y);
        $this->pdf->SetFont('Arial', '', 10);
//        $this->pdf->Ln(7);
        $this->pdf->MultiCell(0, 5, $tenantInfo->ADDRESS, 0, 1);
//        $this->pdf->Ln(7);
        $this->pdf->Cell(0, 5, $tenantInfo->PHONE_NUMBER, 0, 1);

        $this->generateLine();
    }

    protected function generateMetaData() {

        $y = $this->pdf->GetY();
        $width = $this->pdf->GetPageWidth();

        $this->pdf->Ln(4);
        $this->pdf->SetFont('Arial', 'B', 13);
        $this->pdf->Cell(0, 10, 'SURAT PEMESANAN KENDARAAN', 0, 2);

        $y = $this->pdf->GetY();

        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(0, 7, 'Dibuat: ' . $this->salesOrder->created_at->toDateTimeString(), 0, 2);
        $this->pdf->Cell(0, 7, 'Oleh: ' . $this->salesOrder->getAttribute('creator.name'), 0, 0);
        $this->pdf->setY($y);


        if ($this->salesOrder->validated_at) {
            $this->pdf->SetX($width / 3);
            $this->pdf->Cell(0, 7, 'Validasi: ' . $this->salesOrder->validated_at->toDateTimeString(), 0, 2);
            $this->pdf->Cell(0, 7, 'Oleh: ' . $this->salesOrder->getAttribute('validator.name'), 0, 0);
            $this->pdf->setY($y);
        }

        $this->pdf->SetX($width / 3 * 2);
        $this->pdf->Cell(0, 7, 'Cetak: ' . \Carbon\Carbon::now()->toDateTimeString(), 0, 2);
        $this->pdf->Cell(0, 7, 'Oleh: ' . \ParsedJwt::getByKey('name'), 0, 0);
        $this->pdf->setY($y);

        $this->pdf->Ln(15);
        $this->generateLine(false);
    }

    protected function generatePersonalData() {

        $y = $this->pdf->GetY();
        $width = $this->pdf->GetPageWidth();

        $customer = (object) $this->salesOrder->customer;
        $registration = (object) $this->salesOrder->registration;

        // Customer
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(0, 10, 'PEMESAN', 0, 2);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(0, 5, $customer->type, 0, 2);
        $this->pdf->Cell(0, 5, $customer->name, 0, 2);
        $this->pdf->Cell(0, 5, $customer->phone_number, 0, 2);
        $this->pdf->Cell(0, 5, $customer->email, 0, 2);
        $this->pdf->Cell(0, 5, 'KTP: ' . $customer->ktp, 0, 2);
        $this->pdf->MultiCell(95, 5, $customer->address, 0);

        $maxY = $this->pdf->GetY();
        $this->pdf->SetY($y);
        $this->pdf->SetX($width * 1 / 3);

        // Registration
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(0, 10, 'STNK', 0, 2);
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(0, 5, $registration->type, 0, 2);
        $this->pdf->Cell(0, 5, $registration->name, 0, 2);
        $this->pdf->Cell(0, 5, $registration->phone_number, 0, 2);
        $this->pdf->Cell(0, 5, 'KTP: ' . $registration->ktp, 0, 2);
        $this->pdf->MultiCell(0, 5, $registration->address, 0);

        $this->pdf->SetY($y);
        $this->pdf->SetX($width * 2 / 3);

        // Image

        if (isset($registration->ktp_file_url) && $registration->ktp_file_url) {
            list($imageWidth, $imageHeight) = getimagesize($registration->ktp_file_url);
            $this->pdf->Image($registration->ktp_file_url, null, null, ($imageHeight > $imageWidth ? null : ($width / 4)), ($imageHeight > $imageWidth ? ($width / 4) : null));
        }

        $this->pdf->SetY($maxY);
        $this->pdf->Ln(2);
        $this->generateLine(false);
    }

    protected function generateOrderData() {

        $y = $this->pdf->GetY();
        $maxY = $y;
        $width = $this->pdf->GetPageWidth();
        $vehicle = (object) $this->salesOrder->vehicle;

        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(0, 10, 'PESANAN', 0, 2);

        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(0, 5, $vehicle->brand, 0, 2);
        $this->pdf->Cell(0, 5, $vehicle->name, 0, 2);
        $this->pdf->Cell(0, 5, $vehicle->code, 0, 2);


        if (!empty($vehicle->variant)) {
            $variant = (object) $vehicle->variant;
            $this->pdf->Cell(0, 5, $variant->name . ' | ' . $variant->code, 0, 2);
        }
        
        $maxY = $maxY > $this->pdf->GetY() ? $maxY : $this->pdf->GetY();
        
        $this->pdf->SetY($y);
        $this->pdf->SetX($width / 3);

        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(0, 10, 'HARGA', 0, 2);

        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(0, 5, 'Jenis Penjualan: ' . $this->salesOrder->sales_condition, 0, 2);
        $this->pdf->Cell(0, 5, 'Jenis Pembayaran: ' . $this->salesOrder->payment_type, 0, 2);

        if ($this->salesOrder->sales_condition == 'isi') {
            $this->pdf->Cell(0, 5, 'Harga On TR: Rp ' . number_format($this->salesOrder->on_the_road), 0, 2);
        } else {
            $this->pdf->Cell(0, 5, 'Harga Off TR: Rp ' . number_format($this->salesOrder->off_the_road), 0, 2);
        }

        if ($this->salesOrder->discount > 0) {
            $this->pdf->Cell(0, 5, 'Discount: Rp ' . number_format($this->salesOrder->discount), 0, 2);
        }

        if ($this->salesOrder->mediator_fee > 0) {
            $this->pdf->Cell(0, 5, 'Mediator Fee: Rp ' . number_format($this->salesOrder->mediator_fee), 0, 2);
            $this->pdf->Cell(0, 5, 'Mediator: ' . $this->salesOrder->getAttribute('mediator.name'), 0, 2);
        }
        
        $maxY = $maxY > $this->pdf->GetY() ? $maxY : $this->pdf->GetY();
        
        $this->pdf->SetY($y);
        $this->pdf->SetX($width / 3 * 2);
        
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(0, 10, 'PEMBAYARAN', 0, 2);
        $this->pdf->SetFont('Arial', '', 10);

        if ($this->salesOrder->payment_type == 'credit') {
            $this->pdf->Cell(0, 5, 'DP PO: ' . number_format($this->salesOrder->getAttribute('leasingOrder.dp_po')), 0, 2);
            $this->pdf->Cell(0, 5, 'Total Terhutang: ' . number_format($this->salesOrderBalance['grand_total']), 0, 2);
            $this->pdf->Cell(0, 5, 'Sisa Terhutang: ' . number_format($this->salesOrderBalance['payment_unreceived']), 0, 2);
        }
        
        
        $maxY = $maxY > $this->pdf->GetY() ? $maxY : $this->pdf->GetY();
        $this->pdf->SetY($maxY);
        
        $this->generateLine();
    }

    protected function generateExtras() {

        $width = $this->pdf->GetPageWidth();

        function posXX($width, $col) {
            return (($width - 10) / 6 * $col) + 15;
        }

        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->Cell(0, 10, 'LAIN-LAIN', 0, 2);

        $this->pdf->SetFont('Arial', '', 10);

        $this->pdf->SetX(posXX($width, 0));
        $this->pdf->Cell(0, 5, 'Nama', 0, 0);

        $this->pdf->SetX(posXX($width, 2));
        $this->pdf->Cell(0, 5, 'Jumlah', 0, 0);

        $this->pdf->SetX(posXX($width, 3));
        $this->pdf->Cell(0, 5, 'Quantity', 0, 0);

        $this->pdf->SetX(posXX($width, 4));
        $this->pdf->Cell(0, 5, 'PPN', 0, 0);


        $this->pdf->SetX(posXX($width, 5));
        $this->pdf->Cell(0, 5, 'Total', 0, 1);

        $this->pdf->Ln(2);
        $y = $this->pdf->GetY();
        $this->pdf->Line(0 + 15, $y, $width - 15, $y);
        $this->pdf->Ln(2);

        foreach ($this->salesOrder->salesOrderExtras as $salesOrderExtra) {

            $this->pdf->SetX(posXX($width, 0));
            $this->pdf->Cell(0, 5, $salesOrderExtra->item_name, 0, 0);

            $this->pdf->SetX(posXX($width, 2));
            $this->pdf->Cell(0, 5, number_format($salesOrderExtra->quantity), 0, 0);

            $this->pdf->SetX(posXX($width, 3));
            $this->pdf->Cell(0, 5, number_format($salesOrderExtra->price_per_unit), 0, 0);

            $this->pdf->SetX(posXX($width, 4));
            $this->pdf->Cell(0, 5, number_format($salesOrderExtra->vat), 0, 0);

            $this->pdf->SetX(posXX($width, 5));
            $this->pdf->Cell(0, 5, number_format($salesOrderExtra->total), 0, 1);
        }

        $this->generateLine();
    }


    protected function generatePayments() {

        $width = $this->pdf->GetPageWidth();

        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->Cell(0, 10, 'PEMBAYARAN', 0, 2);

        $this->pdf->SetFont('Arial', '', 10);

        $this->pdf->SetX(posXX($width, 0));
        $this->pdf->Cell(0, 5, 'Jenis', 0, 0);

        $this->pdf->SetX(posXX($width, 1));
        $this->pdf->Cell(0, 5, 'Account', 0, 0);

        $this->pdf->SetX(posXX($width, 2));
        $this->pdf->Cell(0, 5, 'Tanggal', 0, 0);

        $this->pdf->SetX(posXX($width, 3));
        $this->pdf->Cell(0, 5, 'Jumlah', 0, 1);

        $this->pdf->Ln(2);
        $y = $this->pdf->GetY();
        $this->pdf->Line(0 + 15, $y, $width - 15, $y);
        $this->pdf->Ln(2);
        
        $transaction = $this->salesOrderBalance['details']['transactions'];

        foreach ($transaction['transactions'] as $transaction) {

            $this->pdf->SetX(posXX($width, 0));
            $this->pdf->Cell(0, 5, $transaction->account_type, 0, 0);

            $this->pdf->SetX(posXX($width, 1));
            $this->pdf->Cell(0, 5, $transaction->account_name, 0, 0);

            $this->pdf->SetX(posXX($width, 2));
            $this->pdf->Cell(0, 5, $transaction->date, 0, 0);

            $this->pdf->SetX(posXX($width, 3));
            $this->pdf->Cell(0, 5, number_format($transaction->amount), 0, 1);
        }

        $this->generateLine();
    }

    protected function generateCreditData() {

        $width = $this->pdf->GetPageWidth();
        $leasingOrder = $this->salesOrder->subDocument()->leasingOrder();

        function posX($width, $col) {
            return (($width - 10) / 6 * $col) + 15;
        }

        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', 'B', 11);
        $this->pdf->Cell(0, 10, 'DATA KREDIT', 0, 2);

        $this->pdf->SetFont('Arial', '', 10);

        $this->pdf->SetX(posX($width, 0));
        $this->pdf->Cell(0, 5, 'Leasing', 0, 0);

        $this->pdf->SetX(posX($width, 2));
        $this->pdf->Cell(0, 5, 'DP', 0, 0);

        $this->pdf->SetX(posX($width, 3));
        $this->pdf->Cell(0, 5, 'Tenor', 0, 0);

        $this->pdf->SetX(posX($width, 4));
        $this->pdf->Cell(0, 5, 'Cicilan', 0, 0);

        $this->pdf->SetX(posX($width, 5));
        $this->pdf->Cell(0, 5, 'Nomor PO', 0, 1);

        $this->pdf->Ln(2);
        $y = $this->pdf->GetY();
        $this->pdf->Line(0 + 15, $y, $width - 15, $y);
        $this->pdf->Ln(2);

        $this->pdf->SetX(posX($width, 0));
        $this->pdf->Cell(0, 5, $leasingOrder->mainLeasing['name'], 0, 0);

        $this->pdf->SetX(posX($width, 2));
        $this->pdf->Cell(0, 5, number_format($leasingOrder->dp_po), 0, 0);

        $this->pdf->SetX(posX($width, 3));
        $this->pdf->Cell(0, 5, number_format($leasingOrder->tenor), 0, 0);

        $this->pdf->SetX(posX($width, 4));
        $this->pdf->Cell(0, 5, number_format($leasingOrder->cicilan), 0, 0);

        $this->pdf->SetFont('Arial', '', 7);
        $this->pdf->SetX(posX($width, 5));
        $this->pdf->MultiCell(0, 5, $leasingOrder->po_number);
        $this->pdf->SetFont('Arial', '', 10);


        $this->generateLine();
    }

    protected function generateFooter() {

        $y = $this->pdf->GetY();
        $width = $this->pdf->GetPageWidth();
        $height = $this->pdf->GetPageHeight();
        $customer = (object) $this->salesOrder->customer;
        
        $this->pdf->Ln(2);

        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(0, 5, 'Mengetahui & Menyetujui', 0, 2);

        $this->pdf->Ln(15);

        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(0, 5, $customer->name, 0, 0);

        $this->pdf->SetX($width / 3);
        $this->pdf->Cell(0, 5, 'SALESMAN', 0, 0);

        $this->pdf->SetX($width / 3 * 2);
        $this->pdf->Cell(0, 5, 'ADMIN', 0, 0);
    
    }
    protected function generateSpkNote() {

        $tenantInfo = (object) \Setting::where('object_type', 'TENANT_INFO')->first()->data_1;
        $content = $tenantInfo->SPK_NOTE;

        $content = str_replace('**BANK**', $tenantInfo->BANK, $content);
        $content = str_replace('**BANK_ACCOUNT_NUMBER**', $tenantInfo->BANK_ACCOUNT_NUMBER, $content);
        $content = str_replace('**BANK_ACCOUNT_NAME**', $tenantInfo->BANK_ACCOUNT_NAME, $content);
        $content = str_replace('**SPK_ID**', substr($this->salesOrder->id, -5), $content);

        $this->pdf->Ln(6);

        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->MultiCell(0, 5, $content);
        
    }
    protected function upload($content) {

        $data = [
            'name' => 'SPK',
            'description' => \Carbon\Carbon::now()->toDateTimeString(),
            'fileable_type' => 'SalesOrder',
            'fileable_id' => $this->salesOrder->id,
            'mime_type' => 'application/pdf',
        ];

        $fileModel = new \Solumax\FileManager\App\File\FileModel();
        $fileModel->assign()->onCreateOrUpdateManual($data, $content, 'sales-order', $this->salesOrder->id . '/spk', 'SO-' . $this->salesOrder->id . '-' . \Carbon\Carbon::now()->timestamp . '.pdf');
        return $fileModel->action()->onCreateOrUpdate();
    }

}
