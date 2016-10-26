<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SalesConnect\Helpers\Commands\EventEmailReminderCommandHelper as Helper;

class EmailEventReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sconnect:email-event-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will email a reminder a day before the event.';

    public $command_helper;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Helper $command_helper)
    {
        parent::__construct();
        $this->command_helper = $command_helper;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->command_helper->emailReminder();
    }
}
