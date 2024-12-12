<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class KategoriNotification extends Notification
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
        $kategorirUrl = url('/kategori');



        // Notifikasi untuk Store
        if ($this->action === 'store') {
            $mailMessage->subject('Kategori baru ditambahkan')
                ->greeting('Halo, Boss!')
                ->line('Kategori berikut telah ditambahkan:')
                ->line('Nama: ' . $this->data->nama)
                ->line('Deskripsi: ' . ($this->data->deskripsi ?: 'Tidak ada deskripsi'))
                ->line('Dibuat oleh: ' . Auth::user()->nama)
                ->action('Lihat Kategori', $kategorirUrl);
        }

        // Notifikasi untuk Update
        if ($this->action === 'update') {
            $mailMessage->subject('Kategori Diperbarui')
                ->greeting('Halo, Boss!')
                ->line('Kategori berikut telah diperbarui:')
                ->line('Nama: ' . $this->data->nama)
                ->line('Deskripsi: ' . ($this->data->deskripsi ?: 'Tidak ada deskripsi'))
                ->line('Dibuat oleh: ' . Auth::user()->nama)
                ->action('Lihat Kategori', $kategorirUrl);
        }

        // Notifikasi untuk Delete
        if ($this->action === 'destroy') {
            $deletedNames = implode(', ', $this->data);
            $mailMessage->subject('Kategori Dihapus')
                ->greeting('Halo, Boss!')
                ->line('Kategori berikut telah dihapus:')
                ->line($deletedNames)
                ->line('Dibuat oleh: ' . Auth::user()->nama)
                ->action('Lihat Kategori', $kategorirUrl);
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
