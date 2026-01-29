<?php

namespace App\Http\Controllers\Backend\Enfant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function PdvView()
    {
         $creche = [
            'name' => "Crèche Ali Wa Meriem",
            'address' => "11 Rue Djouhel Boumedien, 1er / 2ème étage , Sidi Bel Abbes",
            'phone1' => "0658718913",
            'phone2' => "0659841210",
        ];

        $client = [
            'nom' => "Benali",
            'prenom' => "Ahmed",
            'address' => "12 Rue De Lamacta, Sidi Bel Abbes",
            'phone' => "0661234567",
        ];

        // البنود: description بالفرنسي كما طلبت
        $items = [
            ['id' => 1, 'description' => 'Abonnement mensuel - 1 Mois', 'quantity' => 1, 'unit_price' => 8000],
            ['id' => 2, 'description' => "Frais d'inscription", 'quantity' => 1, 'unit_price' => 2000],
            ['id' => 2, 'description' => "Frais Des Livres", 'quantity' => 1, 'unit_price' => 1500],
            // أمثلة إضافية
        ];

        // حسابات
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item['quantity'] * $item['unit_price'];
        }
        $tax = 0; // إذا أردت إضافة ضريبة ضع قيمة هنا
        $total = $subtotal + $tax;

        $data = [
            'creche' => $creche,
            'client' => $client,
            'items' => $items,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'receipt_id' => sprintf('RC-%s-%s', date('Ymd'), rand(1000,9999)),
            'date' => Carbon::now()->format('d/m/Y'),
        ];

        $pdf = PDF::loadView('admin.enfant.pdf.invoice', $data)->setPaper('A4', 'portrait');

        // خيار 1: عرض في المتصفح
        return $pdf->stream("recu_{$data['receipt_id']}.pdf");

        // خيار 2: تنزيل
        // return $pdf->download("recu_{$data['receipt_id']}.pdf");

        // خيار 3: حفظ في public
        // $output = $pdf->output();
        // file_put_contents(public_path("recu_{$data['receipt_id']}.pdf"), $output);
        // return response()->json(['saved' => true, 'path' => url("recu_{$data['receipt_id']}.pdf")]);
    }

    public function PdfInscription()
    {
        // Données EXEMPLE (pas depuis la base)
         $eleve = [
            'nom' => 'Ahmed',
            'prenom' => 'Benali',
            'date_naissance' => '2019-03-15',
            'adresse' => 'Rue Emir Abdelkader – Sidi Bel Abbès',
            'section' => 'Moyenne Section',
            'annee_scolaire' => '2025/2026'
        ];

        // Informations de la Crèche
        $creche = [
            'nom' => "Crèche Ali & Meriem",
            'adresse' => "11 Rue Djouhel Boumedien – 1er / 2ème étage – Sidi Bel Abbès",
            'telephone_1' => "0658718913",
            'telephone_2' => "0659841210"
        ];

        $data = [
            'eleve' => $eleve,
            'creche' => $creche,
            'date_generation' => now()->format('d/m/Y')
        ];


        $pdf = Pdf::loadView('admin.enfant.pdf.inscription', $data)
                  ->setPaper('A4', 'portrait');

        return $pdf->stream('attestation_inscription.pdf');
    }
}
