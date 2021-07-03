<?php

namespace App\Exports;

use App\Category;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ServicesExport implements FromView, ShouldAutoSize
{
    public $language = "E";
    public function view(): View
    {
        return view('exports.services', [
            'categories' => Category::with('services2')->get(),
            'en' => $this->language == "E" ? true : false,

        ]);
    }
}
