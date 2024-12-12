<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class TransaksiNotification extends Notification
{
    public $action; // Jenis notifikasi (store atau update)
    public $transaksi; // Data transaksi

    public function __construct($action, $transaksi)
    {
        $this->action = $action;
        $this->transaksi = $transaksi;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $mailMessage = new MailMessage();
        $mailMessage->greeting('Halo, Boss!')
            ->line('Informasi transaksi baru telah diterima.');

        $transaksinUrl = url('/transaksi/show/' . $this->transaksi->id);

        // Notifikasi untuk pembuatan transaksi
        if ($this->action === 'store') {
            $mailMessage->subject('Transaksi Baru Dibuat')
                ->line('Detail transaksi:')
                ->line('ID Transaksi: ' . $this->transaksi->id)
                ->line('Total Transaksi: Rp ' . number_format($this->transaksi->total_transaksi, 0, ',', '.'))
                ->line('Status: Belum Dibayar')
                ->line('Nama Kasir: ' . Auth::user()->nama)
                ->action('Lihat Transaksi', $transaksinUrl);
        }

        // Notifikasi untuk pembaruan transaksi
        if ($this->action === 'update') {
            $mailMessage->subject('Transaksi Diperbarui')
                ->line('Detail transaksi:')
                ->line('ID Transaksi: ' . $this->transaksi->id)
                ->line('Total Pembayaran: Rp ' . number_format($this->transaksi->total_pembayaran, 0, ',', '.'))
                ->line('Total Kembalian: Rp ' . number_format($this->transaksi->total_kembalian, 0, ',', '.'))
                ->line('Status: Lunas')
                ->line('Nama Kasir: ' . Auth::user()->nama)
                ->action('Lihat Transaksi', $transaksinUrl);
        }

        $mailMessage->line('Terima kasih telah menggunakan aplikasi kami!');

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
