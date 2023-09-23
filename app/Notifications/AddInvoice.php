<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AddInvoice extends Notification
{
    use Queueable;
    private $invoice;
    /**
     * Create a new notification instance.
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice=$invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        $url = 'http://127.0.0.1:8000/invoiceDetails/'.$this->invoice;
        return (new MailMessage)
                    ->subject("add")
                    ->line('adding new invoice.')
                    ->action('show invoice', $url)
                    ->line('Thank you for using our application!');

                    // return (new MailMessage)
                    //             ->subject('اضافة فاتورة جديدة')
                    //             ->line('اضافة فاتورة جديدة')
                    //             ->action('عرض الفاتورة', $url)
                    //             ->line('شكرا لاستخدامك مورا سوفت لادارة الفواتير');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'id'=>$this->invoice->id,
            'title'=>"invoice has been added by:",
            "user"=>Auth::user()->name,
        ];
    }
}
