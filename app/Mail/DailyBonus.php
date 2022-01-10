<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyBonus extends Mailable
{
    use Queueable, SerializesModels;

    private array $summary;
    private array $detail;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct(array $data = [])
    {
        $this->summary = $data['summary'] ?? [];
        $this->detail = $data['detail'] ?? [];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        $summary = [];
        foreach ($this->summary as $item) {
            $summary[] = str_replace(PHP_EOL, '', $item);
        }

        $detail = [];
        foreach ($this->detail as $item) {
            $detail[] = str_replace(PHP_EOL, '', $item);
        }

        return $this->view('mails.DailyBonusMail')
            ->subject('DailyBonus ' . Carbon::today()->toDateString())
            ->with('summary', $summary)
            ->with('detail', $detail);
    }
}
