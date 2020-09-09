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

        $path = 'pdf/patients/'.$validated['patient_id'].'/invoices/'.$validated['invoice_code'].'/';
        $stored = $request->file('file')->storeAs($path, $validated['name'].'.pdf');

        $document = new InvoiceDocument($validated);
        $document->path = $stored;
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

        $document->fill($validated);

        $document->save();

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
        $document->delete();

        Storage::delete($path);

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
}