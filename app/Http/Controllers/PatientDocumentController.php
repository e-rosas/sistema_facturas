<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientDocumentRequest;
use App\Http\Requests\UpdatePatientDocumentRequest;
use App\Http\Resources\PatientDocumentResource;
use App\PatientDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PatientDocumentController extends Controller
{
    public function upload(PatientDocumentRequest $request)
    {
        $validated = $request->validated();

        $path = 'pdf/patients/'.$validated['patient_id'].'/';
        $name = $validated['name'];
        if (1 == $validated['type']) {
            $path .= 'benefits/';
        }
        $request->file('file')->storeAs($path, $name.'.pdf');

        $document = new PatientDocument($validated);
        $document->path = $path;
        $document->save();

        $documents = PatientDocument::where('patient_id', $validated['patient_id'])
            ->orderBy('created_at', 'desc')
            ->get()
        ;

        return PatientDocumentResource::collection($documents);
    }

    public function update(UpdatePatientDocumentRequest $request)
    {
        $validated = $request->validated();

        $document = PatientDocument::findOrFail($validated['document_id']);
        $patient_id = $document->patient_id;
        $old_name = $document->name;

        $document->fill($validated);

        $document->save();

        if ($old_name != $document->name) {
            Storage::move($document->path.$old_name.'.pdf', $document->path.$document->name.'.pdf');
        }

        $documents = PatientDocument::where('patient_id', $patient_id)
            ->orderBy('created_at', 'desc')
            ->get()
        ;

        return PatientDocumentResource::collection($documents);
    }

    public function delete(Request $request)
    {
        $document = PatientDocument::findOrFail($request['document_id']);
        $patient_id = $document->patient_id;

        $path = $document->path;
        $name = $document->name;

        $document->delete();

        Storage::delete($path.$name.'.pdf');

        $documents = PatientDocument::where('patient_id', $patient_id)
            ->orderBy('created_at', 'desc')
            ->get()
        ;

        return PatientDocumentResource::collection($documents);
    }

    public function find(Request $request)
    {
        $document = PatientDocument::findOrFail($request['document_id']);

        return new PatientDocumentResource($document);
    }

    public function download(PatientDocument $document)
    {
        $path = $document->path.$document->name.'.pdf';

        return Storage::download($path);
    }
}