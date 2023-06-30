<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\User;

class PDFController extends Controller
{
    public function generatePDF(Request $request, $certificationId)
    {
        $certification = Certification::find($certificationId);

        if (!$certification) {
            abort(404);
        }

        $firstname = ucfirst($request->input('first_name'));
        $lastname = ucfirst($request->input('last_name'));


        $data = [
            'title' => $certification->name,
            'date' => date('m/d/Y'),
            'description' => $certification->description,
            'first_name' => $firstname,
            'last_name' => $lastname
        ];

        $pdf = PDF::loadView('provider.myPDF', $data);

        return $pdf->download('certification.pdf');
    }
}
