<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JadwalPejemputanMail extends Mailable
{
    use Queueable, SerializesModels;
    public $lokasijemput;
    // public $koordinatjemput;

    /**
     * Create a new message instance.
     */
    public function __construct($lokasijemput)
    {
        $this->lokasijemput = $lokasijemput;
        // $this->$koordinatjemput = $koordinatjemput;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Jadwal Pejemputan Mail',
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
            ->subject('Jadwal Lokasi Penjemputan')
            ->markdown('admin.manajemen sampah.kelola petugas penjemputan.jadwallokasiemail')
            ->with([
                'lokasijemput' => $this->lokasijemput,
                // 'koordinatjemput' => $this->koordinatjemput
            ]);
    }
}
