<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class ShortlistedCandidateNotification extends Notification implements shouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $url = "https://student-amnesty.wufpbk.edu.ng/";

        return (new MailMessage)
            ->from('info@wufpbk.edu.ng', 'WUFPBK')
            ->subject('Congratulations! You have been shortlisted.')
            ->markdown('emails.shortlisted-candidate', [
                'candidateName' => $notifiable->surname . ' ' . $notifiable->firstname . ' ' . $notifiable->m_name,
                'url' => $url,
                'programme_name' => $notifiable->application->program->name,
                'department_name' => $notifiable->application->department->name,


            ]);
    }
    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content('You have been shortlisted.')
            ->from('WUFPBKPOLY');
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
