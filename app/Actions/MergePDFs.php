<?php

namespace App\Actions;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        //MERGE LETTER
        $datadir = storage_path('app/pdf/patients/'.$patient->id.'/');
        $outputNameLetter = $datadir.'merging/letter.pdf';
        $letter = storage_path('app/pdf/patients/'.$patient->id.'/temp/letter.pdf');

        $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile={$outputNameLetter} {$letter}";
        shell_exec($cmd);
        //
        //PATIENT DOCUMENTS

        $outputNamePatientDocs = $datadir.'merging/patientDocs.pdf';
        Storage::put('pdf/patients/'.$patient->id.'/merging/patientDocs.pdf', '');

        $files = glob($datadir.'*.pdf');

        $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile={$outputNamePatientDocs} ";

        foreach ($files as $file) {
            $cmd .= $file.' ';
        }

        shell_exec($cmd);

        //PATIENT BENEFITS DOCUMENTS

        $outputNamePatientBenefitsDocs = $datadir.'merging/patientBenefitsDocs.pdf';
        Storage::put('pdf/patients/'.$patient->id.'/merging/patientBenefitsDocs.pdf', '');

        $files = glob($datadir.'/benefits/*.pdf');

        $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile={$outputNamePatientBenefitsDocs} ";

        foreach ($files as $file) {
            $cmd .= $file.' ';
        }

        shell_exec($cmd);

        //INVOICE DOCUMENTS
        $outputNamePatientDocs = $datadir.'merging/invoiceDocs.pdf';
        Storage::put('pdf/patients/'.$patient->id.'/merging/invoiceDocs.pdf', '');

        $files = glob($datadir.'/invoices/*.pdf');

        $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile={$outputNamePatientDocs} ";

        foreach ($files as $file) {
            $cmd .= $file.' ';
        }

        shell_exec($cmd);

        //MERGE DOCUMENTS

        $outputNameAll = $datadir.'merges/'.$patient->name.'.pdf';
        Storage::put('pdf/patients/'.$patient->id.'/merges/'.$patient->name.'.pdf', '');

        $files = glob($datadir.'/merging/*.pdf');

        $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile={$outputNameAll} ";

        foreach ($files as $file) {
            $cmd .= $file.' ';
        }

        shell_exec($cmd);
        dd($cmd);

        return Storage::download('pdf/patients/'.$patient->id.'/merges/'.$patient->name.'.pdf');
        /* $fpdi = new Fpdi();

        $path = 'app/pdf/patients/'.$patient->id.'/temp/letter.pdf';

        $form = storage_path($path);

        $fpdi->setSourceFile($form);
        $tpl = $fpdi->importPage(1, '/MediaBox');
        $fpdi->addPage();
        $fpdi->useTemplate($tpl);

        $directory = storage_path('app/pdf/'.$patient->id.'/temp');
        File::cleanDirectory($directory);

        foreach ($invoices as $invoice) {
            $path = 'app/pdf/patients/'.$invoice->patient_id.'/invoices/'.$invoice->code.'/'.$invoice->code.'PaymentForm.pdf';

            $form = storage_path($path);

            $fpdi->setSourceFile($form);
            $tpl = $fpdi->importPage(1, '/MediaBox');
            $fpdi->addPage();
            $fpdi->useTemplate($tpl);
        }

        $fpdi->Output('D', $patient->full_name.'-Letter.pdf'); */
    }

    public function mergePatientDocuments($patient)
    {
    }
}