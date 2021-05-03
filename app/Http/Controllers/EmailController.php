<?php

namespace App\Http\Controllers;

use App\Email;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\UpdateEmailRequest;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::with(['campaign', 'insurance'])->orderBy('date', 'desc')->paginate(30);

        return view('emails.index2', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EmailRequest $request)
    {
        $validated = $request->validated();
        Email::create($validated);

        return redirect()->route('emails.create')->withStatus(__('Correo registrado exitosamente.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        $email->load(['campaign', 'user']);

        return view('emails.show', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        return view('emails.edit', compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmailRequest $request, Email $email)
    {
        $validated = $request->validated();

        $email->fill($validated);
        $email->save();

        return redirect()->route('emails.edit', compact('email'))
            ->withStatus(__('Correo modificado exitosamente.'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
    }
}