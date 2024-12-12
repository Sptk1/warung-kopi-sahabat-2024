<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class MenuNotification extends Notification
{
    use Queueable;

    public $action;
    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($action, $data)
    {
        $this->action = $action;
        $this->data = $data;
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
        $menurUrl = url('/menu');

        // Notifikasi untuk Store
        if ($this->action === 'store') {
            $mailMessage->subject('Menu baru ditambahkan')
                ->greeting('Halo, Boss!')
                ->line('Menu berikut telah ditambahkan:')
                ->line('Nama: ' . $this->data->nama)
                ->line('Harga Modal: ' . $this->data->harga_modal)
                ->line('Harga Jual: ' . $this->data->harga_jual)
                ->line('Kategori: ' . $this->data->kategori->nama)
                ->line('Dibuat oleh: ' . Auth::user()->nama)
                ->action('Lihat Menu', $menurUrl);
        }

        // Notifikasi untuk Update
        if ($this->action === 'update') {
            $mailMessage->subject('Menu Diperbarui')
                ->greeting('Halo, Boss!')
                ->line('Menu berikut telah diperbarui:')
                ->line('Nama: ' . $this->data->nama)
                ->line('Harga Modal: ' . $this->data->harga_modal)
                ->line('Harga Jual: ' . $this->data->harga_jual)
                ->line('Kategori: ' . $this->data->kategori->nama)
                ->line('Dibuat oleh: ' . Auth::user()->nama)
                ->action('Lihat Menu', $menurUrl);
        }

        // Notifikasi untuk Delete
        if ($this->action === 'destroy') {
            $mailMessage->subject('Menu Dihapus')
                ->greeting('Halo, Boss!')
                ->line('Menu berikut telah dihapus:')
                ->line('Nama: ' . $this->data->nama)
                ->line('Dibuat oleh: ' . Auth::user()->nama)
                ->action('Lihat Menu', $menurUrl);
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
