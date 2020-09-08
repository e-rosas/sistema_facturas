<?php

namespace App\Actions;

use Illuminate\Support\Facades\File;
use setasign\Fpdi\Fpdi;

class MergePDFs
{
    private $pages_count = 0;

    public function __construct($pages_count)
    {
        $this->pages_count = $pages_count;
    }

    public function merge($invoice_code, $output)
    {
        $fpdi = new Fpdi();
        for ($i = 0; $i < $this->pages_count; ++$i) {
            $path = 'app/pdf/invoice/newForm'.$i.'.pdf';

            $form = storage_path($path);

            $fpdi->setSourceFile($form);
            $tpl = $fpdi->importPage(1, '/MediaBox');
            $fpdi->addPage();
            $fpdi->useTemplate($tpl);
        }
        $directory = storage_path('app/pdf/invoice');
        File::cleanDirectory($directory);

        return $fpdi->Output($output, $invoice_code.'.pdf');
    }

    public function saveMerge($destination)
    {
        $fpdi = new Fpdi();
        for ($i = 0; $i < $this->pages_count; ++$i) {
            $path = 'app/pdf/invoice/newForm'.$i.'.pdf';

            $form = storage_path($path);

            $fpdi->setSourceFile($form);
            $tpl = $fpdi->importPage(1, '/MediaBox');
            $fpdi->addPage();
            $fpdi->useTemplate($tpl);
        }

        $directory = storage_path('app/pdf/invoice');
        File::cleanDirectory($directory);
        $store = storage_path($destination);

        $fpdi->Output('F', $store);
    }

    public function mergeLetter($invoices, $patient)
    {
        $fpdi = new Fpdi();

        $path = 'app/pdf/'.$patient->id.'/temp/letter.pdf';

        $form = storage_path($path);

        $fpdi->setSourceFile($form);
        $tpl = $fpdi->importPage(1, '/MediaBox');
        $fpdi->addPage();
        $fpdi->useTemplate($tpl);

        $directory = storage_path('app/pdf/'.$patient->id.'/temp');
        File::cleanDirectory($directory);

        foreach ($invoices as $invoice) {
            $path = 'app/pdf/'.$invoice->patient_id.'/forms/'.$invoice->code.'.pdf';

            $form = storage_path($path);

            $fpdi->setSourceFile($form);
            $tpl = $fpdi->importPage(1, '/MediaBox');
            $fpdi->addPage();
            $fpdi->useTemplate($tpl);
        }

        $fpdi->Output('D', $patient->full_name.'-Letter.pdf');
    }
}