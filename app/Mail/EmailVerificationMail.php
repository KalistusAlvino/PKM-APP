<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mahasiswa;
    /**
     * Create a new message instance.
     */
    public function __construct($mahasiswa)
    {
        $this->mahasiswa = $mahasiswa;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Verification Mail',
        );
    }
    public function build()
    {
        return $this->subject('Verifikasi Email Mahasiswa')
            ->view('emails.verifikasi-email')
            ->with([
                'token' => $this->mahasiswa->email_verification_token,
                'email' => $this->mahasiswa->email,
            ]);
    }
    /**
     * Get the message content definition.
     */
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
