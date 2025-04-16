<?php

// PaiementConfirmationMail.php

namespace App\Mail;

use App\Models\Paiement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaiementConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $paiement;

    public function __construct(Paiement $paiement)
    {
        $this->paiement = $paiement;
    }

    public function build()
    {
        return $this->subject('Confirmation de votre paiement')
            ->view('emails.paiement_confirmation');
    }
}

