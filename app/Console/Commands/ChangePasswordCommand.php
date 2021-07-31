<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ChangePasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lieth:change-password {--username=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        if (!$this->option('username') || !$this->option('password')) {
            $this->error('The parameters --username and --password are required.');
            return 0;
        }

        $user = User::where('username', $this->option('username'))->first();
        if (!$user) {
            $this->error('User not found.');
            return 0;
        }

        $user->password = Hash::make($this->option('password'));
        $user->api_token = null;
        $user->save();

        $this->info('Password changed.');
        return 0;
    }
}
