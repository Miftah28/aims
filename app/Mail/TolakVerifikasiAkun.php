<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TolakVerifikasiAkun extends Mailable
{
    use Queueable, SerializesModels;
    public $keterangan;

    /**
     * Create a new message instance.
     */
    public function __construct($keterangan)
    {
        $this->keterangan = $keterangan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tolak Verifikasi Akun',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
    public function build()
    {
        return $this->from('aplikasiaims20@gmail.com')
            ->subject('Aktivasi Akun')
            ->markdown('super admin.konfirmasi akun.tolakverifikasiemail')
            ->with([
                'keterangan' => $this->keterangan
            ]);
    }
}
