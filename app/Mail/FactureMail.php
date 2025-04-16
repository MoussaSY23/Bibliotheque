<?php
namespace App\Mail;


use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class FactureMail extends Mailable
{
    use SerializesModels;

    public $commande;
    public $paiement;

    public function __construct($commande,$paiement)
    {
        $this->commande = $commande;
        $this->paiement = $paiement;
    }

    public function build()
    {
        $pdf = PDF::loadView('factures.facture_pdf', ['commande' => $this->commande]);

        return $this->subject('Votre facture')
            ->view('emails.paiement_confirmation')
            ->attachData($pdf->output(), 'facture_' . $this->commande->id . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
