<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    // Các dữ liệu bạn muốn gửi trong email
    public $order;

    /**
     * Tạo một instance của mailable.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Cấu hình email, subject, và view email
        return $this->subject('Xác Nhận Đơn Hàng #' . $this->order->id)
                    ->view('emails.orderConfirmation')  // Chỉ định view cho email
                    ->with([
                        'order' => $this->order,
                    ]);
    }
}