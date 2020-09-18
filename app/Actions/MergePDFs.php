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

    public function mergeInvoice($invoice, $patient)
    {
        $datadir = storage_path('app/pdf/patients/'.$patient->id.'/');

        $directory = storage_path('app/pdf/'.$patient->id.'/merging');
        File::cleanDirectory($directory);

        $this->patientDocuments($datadir, $patient);
        $this->invoiceDocuments($datadir, $patient, $invoice->code.'*');
        $this->mergeDocuments($datadir, $patient, $invoice->code);

        return Storage::download('pdf/patients/'.$patient->id.'/merges/'.$invoice->code.'.pdf');
    }

    public function mergeSimpleLetter($patient)
    {
        $datadir = storage_path('app/pdf/patients/'.$patient->id.'/');

        $outputNameLetter = $datadir.'merging/letter/'.$patient->name.'.pdf';
        Storage::put('pdf/patients/'.$patient->id.'/merging/letter/'.$patient->name.'.pdf', '');

        $letter = storage_path('app/pdf/patients/'.$patient->id.'/temp/letter.pdf');
        $letter2 = storage_path('app/pdf/1letter.pdf');

        $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile={$outputNameLetter} {$letter} {$letter2}";
        shell_exec($cmd);

        $directory = storage_path('app/pdf/patients/'.$patient->id.'/temp');
        File::cleanDirectory($directory);

        return Storage::download('pdf/patients/'.$patient->id.'/merging/letter/'.$patient->name.'.pdf');
    }

    public function mergeLetter($patient)
    {
        $datadir = storage_path('app/pdf/patients/'.$patient->id.'/');

        $directory = storage_path('app/pdf/patients/'.$patient->id.'/merging');
        File::cleanDirectory($directory);

        $this->patientDocuments($datadir, $patient);
        $this->invoiceDocuments($datadir, $patient, '*');
        $this->letterDocuments($datadir, $patient);
        $this->mergeDocuments($datadir, $patient, $patient->name);

        return Storage::download('pdf/patients/'.$patient->id.'/merges/'.$patient->name.'.pdf');
    }

    public function mergeDocuments($datadir, $patient, $docName)
    {
        $directory = storage_path('app/pdf/patients/'.$patient->id.'/merges');
        File::cleanDirectory($directory);

        //MERGE DOCUMENTS

        $files = glob($datadir.'/merging/*.pdf');

        $count = count($files);

        if ($count > 0) {
            $outputNameAll = $datadir.'merges/'.$docName.'.pdf';
            Storage::put('pdf/patients/'.$patient->id.'/merges/'.$docName.'.pdf', '');

            $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile={$outputNameAll} ";

            foreach ($files as $file) {
                $cmd .= $file.' ';
            }

            shell_exec($cmd);
        }

        $directory = storage_path('app/pdf/patients/'.$patient->id.'/merging');
        File::cleanDirectory($directory);
    }

    private function letterDocuments($datadir, $patient)
    {
        //MERGE LETTER

        $outputNameLetter = $datadir.'merging/0letter.pdf';
        Storage::put('pdf/patients/'.$patient->id.'/merging/0letter.pdf', '');

        $letter = storage_path('app/pdf/patients/'.$patient->id.'/temp/letter.pdf');
        $letter2 = storage_path('app/pdf/1letter.pdf');

        $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile={$outputNameLetter} {$letter} {$letter2}";
        shell_exec($cmd);

        $directory = storage_path('app/pdf/'.$patient->id.'/temp');
        File::cleanDirectory($directory);
    }

    private function invoiceDocuments($datadir, $patient, $name)
    {
        //INVOICE DOCUMENTS

        $files = glob($datadir.'/invoices/'.$name.'.pdf');

        $count = count($files);

        if ($count > 0) {
            $outputNamePatientDocs = $datadir.'merging/4invoiceDocs.pdf';
            Storage::put('pdf/patients/'.$patient->id.'/merging/4invoiceDocs.pdf', '');

            $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile={$outputNamePatientDocs} ";

            foreach ($files as $file) {
                $cmd .= $file.' ';
            }

            shell_exec($cmd);
        }
    }

    private function patientDocuments($datadir, $patient)
    {
        //PATIENT DOCUMENTS

        $files = glob($datadir.'*.pdf');

        $count = count($files);

        if ($count > 0) {
            $outputNamePatientDocs = $datadir.'merging/2patientDocs.pdf';
            Storage::put('pdf/patients/'.$patient->id.'/merging/2patientDocs.pdf', '');

            $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile={$outputNamePatientDocs} ";

            foreach ($files as $file) {
                $cmd .= $file.' ';
            }

            shell_exec($cmd);
        }

        //PATIENT BENEFITS DOCUMENTS

        $files = glob($datadir.'/benefits/*.pdf');

        $count = count($files);

        if ($count > 0) {
            $outputNamePatientBenefitsDocs = $datadir.'merging/3patientBenefitsDocs.pdf';
            Storage::put('pdf/patients/'.$patient->id.'/merging/3patientBenefitsDocs.pdf', '');

            $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile={$outputNamePatientBenefitsDocs} ";

            foreach ($files as $file) {
                $cmd .= $file.' ';
            }
            shell_exec($cmd);
        }
    }
}