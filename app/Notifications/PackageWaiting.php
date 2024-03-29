<?php

namespace App\Notifications;

use App\Mail\PackageWaitingMail;
use App\Models\Package;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PackageWaiting extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        private readonly User $user,
        private readonly Package $package
    ) { }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return PackageWaitingMail
     */
    public function toMail(mixed $notifiable): PackageWaitingMail
    {
        return (new PackageWaitingMail($this->user, $this->package))
            ->to($this->user->email)
            ->subject(__('[STOCK]: Package is waiting over 24h'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray(mixed $notifiable): array
    {
        return [
            'code' => $this->package->code,
            'position' => $this->package->position,
            'state' => $this->package->state,
        ];
    }
}
