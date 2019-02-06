<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactoResponseEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The objResponseData object instance.
     *
     * @var ObjResponseData
     */
    public $objResponseData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($objResponseData)
    {
        $this->objResponseData = $objResponseData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->objResponseData->from_email)
                    ->view('admin.emails.contacto-respuesta')
                    ->text('admin.emails.contacto-respuesta_plain');
    }
}
