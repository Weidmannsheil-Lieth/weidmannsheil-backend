<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AddUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lieth:add-user {--username=} {--abbreviation=} {--name=} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new user';

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
        $options = $this->options();
        if (!Arr::has($options, [
            'abbreviation',
            'name',
            'username',
            'email',
            'password'
        ])) {
            $this->error('The parameters --abbreviation, --name, --username, --email and --password are required.');
            return 0;
        }

        if (User::where('username', $options['username'])->exists()) {
            $this->error('A user with this username already exists.');
            return 0;
        }

        User::create([
            'name'         => $options['name'],
            'abbreviation' => $options['abbreviation'],
            'username'     => $options['username'],
            'email'        => $options['email'],
            'password'     => Hash::make($options['password'])
        ]);

        $this->info('User created.');
        return 0;
    }
}
