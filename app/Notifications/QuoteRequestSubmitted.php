<?php

namespace App\Notifications;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuoteRequestSubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The quote request instance.
     *
     * @var \App\Models\QuoteRequest
     */
    protected $quoteRequest;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\QuoteRequest $quoteRequest
     */
    public function __construct(QuoteRequest $quoteRequest)
    {
        $this->quoteRequest = $quoteRequest;
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
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/admin/quotes/' . $this->quoteRequest->id);
        $fruitCount = $this->quoteRequest->fruits->count();
        $fruitText = $fruitCount === 1 ? '1 fruit' : $fruitCount . ' fruits';
        
        $message = (new MailMessage)
            ->subject('New Quote Request Submitted - #' . $this->quoteRequest->id)
            ->greeting('Hello!')
            ->line('A new quote request has been submitted by ' . $this->quoteRequest->name . '.')
            ->line('The request includes ' . $fruitText . '.')
            ->line('Customer Details:')
            ->line('Name: ' . $this->quoteRequest->name)
            ->line('Email: ' . $this->quoteRequest->email);
            
        if ($this->quoteRequest->phone) {
            $message->line('Phone: ' . $this->quoteRequest->phone);
        }
        
        if ($this->quoteRequest->message) {
            $message->line('Message: ' . $this->quoteRequest->message);
        }
        
        return $message
            ->action('View Quote Request', $url)
            ->line('Thank you for using our Pinvegan application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->quoteRequest->id,
            'name' => $this->quoteRequest->name,
            'email' => $this->quoteRequest->email,
            'phone' => $this->quoteRequest->phone,
            'status' => $this->quoteRequest->status,
            'created_at' => $this->quoteRequest->created_at->format('Y-m-d H:i:s'),
            'fruit_count' => $this->quoteRequest->fruits->count(),
        ];
    }
}
