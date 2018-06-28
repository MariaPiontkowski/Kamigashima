<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Agenda extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var $return
     */
    public $return;

    /**
     * Create a new message instance.
     * @var array $return
     *
     * @return void
     */
    public function __construct(array $return)
    {
        $this->return = $return;
    }

    /**
     * Build the message.
     *
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mail')
            ->with([
                'return' => $this->return
            ]);
    }
}
