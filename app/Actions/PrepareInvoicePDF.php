<?php

namespace App\Actions;

use App\Insuree;
use App\Invoice;

class PrepareInvoicePDF
{
    public $patient;
    public $insured;
    private $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->patient = $invoice->patient;
        if ($this->invoice->patient->insured) {
            $this->insured = $this->invoice->patient->insuree;
        } else {
            $this->insured = Insuree::where('patient_id', $this->invoice->patient->dependent->insuree_id)->first();
        }
    }

    public function serviceCategories()
    {
        $this->invoice->load('services2.service.category', 'services2.items');
        $services = $this->invoice->services2;
        $categories = $services->pluck('service.category')->unique();
        foreach ($services as $service) {
            $category = $categories->firstWhere('id', $service->service->category_id);
            $category->services[] = $service;
            $category->total += $service->total_discounted_price;
        }

        return $categories->values();
    }
}