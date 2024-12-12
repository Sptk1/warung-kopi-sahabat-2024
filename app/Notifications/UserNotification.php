<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class UserNotification extends Notification
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
        $userUrl = url('/karyawan');

        // Notifikasi untuk Store
        if ($this->action === 'store') {
            $mailMessage->subject('Karyawan baru ditambahkan')
                ->greeting('Halo, Boss!')
                ->line('Karyawan berikut telah ditambahkan:')
                ->line('Nama: ' . $this->data->nama)
                ->line('Username: ' . $this->data->nama)
                ->line('Peran: ' . $this->data->peran->peran)
                ->line('Dibuat oleh: ' . Auth::user()->nama)
                ->action('Lihat Karyawan', $userUrl);
        }

        // Notifikasi untuk Update
        if ($this->action === 'update') {
            $mailMessage->subject('Karyawan Diperbarui')
                ->greeting('Halo, Boss!')
                ->line('Karyawan berikut telah diperbarui:')
                ->line('Nama: ' . $this->data->nama)
                ->line('Username: ' . $this->data->nama)
                ->line('Peran: ' . $this->data->peran->peran)
                ->line('Dibuat oleh: ' . Auth::user()->nama)
                ->action('Lihat Karyawan', $userUrl);
        }

        // Notifikasi untuk Delete
        if ($this->action === 'destroy') {
            $deletedNames = implode(', ', $this->data);
            $mailMessage->subject('Karyawan Dihapus')
                ->greeting('Halo, Boss!')
                ->line('Karyawan berikut telah dihapus:')
                ->line($deletedNames)
                ->line('Dibuat oleh: ' . Auth::user()->nama)
                ->action('Lihat Karyawan', $userUrl);
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
