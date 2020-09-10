<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceDocumentRequest;
use App\Http\Requests\UpdateInvoiceDocumentRequest;
use App\Http\Resources\InvoiceDocumentResource;
use App\InvoiceDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceDocumentController extends Controller
{
    public function upload(InvoiceDocumentRequest $request)
    {
        $validated = $request->validated();

        $path = 'pdf/patients/'.$validated['patient_id'].'/invoices/';
        $name = $validated['invoice_code'].'-'.$validated['name'];
        $request->file('file')->storeAs($path, $validated['invoice_code'].'-'.$validated['name'].'.pdf');

        $document = new InvoiceDocument($validated);
        $document->path = $path;
        $document->name = $name;
        $document->save();

        $documents = InvoiceDocument::where('invoice_id', $validated['invoice_id'])
            ->orderBy('created_at', 'desc')
            ->get()
        ;

        return InvoiceDocumentResource::collection($documents);
    }

    public function update(UpdateInvoiceDocumentRequest $request)
    {
        $validated = $request->validated();

        $document = InvoiceDocument::findOrFail($validated['document_id']);
        $invoice_id = $document->invoice_id;
        $old_name = $document->name;

        $document->fill($validated);

        $document->save();

        if ($old_name != $document->name) {
            Storage::move($document->path.$old_name.'.pdf', $document->path.$document->name.'.pdf');
        }

        $documents = InvoiceDocument::where('invoice_id', $invoice_id)
            ->orderBy('created_at', 'desc')
            ->get()
        ;

        return InvoiceDocumentResource::collection($documents);
    }

    public function delete(Request $request)
    {
        $document = InvoiceDocument::findOrFail($request['document_id']);
        $invoice_id = $document->invoice_id;
        $path = $document->path;
        $name = $document->name;

        $document->delete();

        Storage::delete($path.$name.'.pdf');

        $documents = InvoiceDocument::where('invoice_id', $invoice_id)
            ->orderBy('created_at', 'desc')
            ->get()
        ;

        return InvoiceDocumentResource::collection($documents);
    }

    public function find(Request $request)
    {
        $document = InvoiceDocument::findOrFail($request['document_id']);

        return new InvoiceDocumentResource($document);
    }

    public function download(InvoiceDocument $document)
    {
        $path = $document->path.$document->name.'.pdf';

        return Storage::download($path);
    }
}