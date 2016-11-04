<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\SalesConnect\Helpers\Commands\EventTextReminderCommandHelper; 

class TextEventReminder extends Command
{
    protected $helper;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sconnect:text-event-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Text an event reminder an hour before appointment.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EventTextReminderCommandHelper $helper)
    {
        parent::__construct();

        $this->helper = $helper;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->helper->text();
    }
}
