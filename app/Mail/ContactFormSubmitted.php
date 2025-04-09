<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    /**
     * Create a new message instance.
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('site.emails.contact_form_submitted')
                    ->with([
                        'name' => $this->contact->name,
                        'email' => $this->contact->email,
                        'msg_subject' => $this->contact->msg_subject,
                        'phone_number' => $this->contact->phone_number,
                        'message' => $this->contact->message,
                    ]);
    }

}
