<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTicket extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('ADEMC Support Services - New Ticket #' .$this->ticket->id)
                    ->greeting('Hi ADEMC Member,')
                    ->line('A New Ticket has been Created for your concern')
                    ->line('Ticket Number: '.$this->ticket->id)
                    ->line('Ticket Subject: '.$this->ticket->title)
                    ->line('')
                    ->line('Update:')
                    // ->line(Str::limit($this->comment->comment_text, 500))
                    // ->action('View full ticket', route(optional($notifiable)->id ? 'admin.tickets.show' : 'tickets.show', $this->comment->ticket->id))
                    ->line('Thank you')
                    ->line(config('app.name') . ' Operations')
                    ->salutation(' ');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
