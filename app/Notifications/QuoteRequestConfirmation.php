<?php

namespace App\Notifications;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuoteRequestConfirmation extends Notification implements ShouldQueue
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
        $fruitCount = $this->quoteRequest->fruits->count();
        $fruitText = $fruitCount === 1 ? '1 fruit' : $fruitCount . ' fruits';
        
        $message = (new MailMessage)
            ->subject('Your Quote Request Confirmation - #' . $this->quoteRequest->id)
            ->greeting('Hello ' . $this->quoteRequest->name . '!')
            ->line('Thank you for submitting your quote request with our Fruit Shop.')
            ->line('We have received your request for ' . $fruitText . '.')
            ->line('Our team will review your request and get back to you shortly with pricing and availability information.');
            
        // List the requested fruits
        if ($fruitCount > 0) {
            $message->line('Your requested items:');
            
            foreach ($this->quoteRequest->fruits as $fruit) {
                $message->line('- ' . $fruit->name . ' (Quantity: ' . $fruit->pivot->quantity . ')');
            }
        }
        
        return $message
            ->action('Visit Our Website', url('/'))
            ->line('If you have any questions, please feel free to contact us.')
            ->salutation('Best regards,\nThe Fruit Shop Team');
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
            'created_at' => $this->quoteRequest->created_at->format('Y-m-d H:i:s'),
            'fruit_count' => $this->quoteRequest->fruits->count(),
            'type' => 'confirmation',
        ];
    }
}
