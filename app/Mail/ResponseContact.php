<?php

namespace AVDPainel\Mail;

use AVDPainel\Models\Admin\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResponseContact extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Contact
     */
    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Re: '.$this->contact->subject.' #'.$this->contact->id)
            ->markdown('backend.emails.contacts.response');
    }
}
