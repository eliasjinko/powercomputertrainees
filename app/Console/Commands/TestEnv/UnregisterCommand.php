<?php

namespace App\Console\Commands\TestEnv;

use App\TestEnv;
use Illuminate\Console\Command;

class UnregisterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testenv:unregister {domain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes a test enviroment';

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
     * @return mixed
     */
    public function handle()
    {
        $domain = $this->input->getArgument('domain');

        TestEnv::runPowershellElevatedCommand('Set-Content -Path ' . TestEnv::HOSTS_PATH . ' -Value (get-content -Path '. TestEnv::HOSTS_PATH .' ^| Select-String -Pattern "# ' . $domain . '" -NotMatch)');

        $vhosts = explode(PHP_EOL, file_get_contents(TestEnv::getApacheExtraFolder() . "httpd-vhosts.conf"));
        $opens = array_search("# {$domain}", $vhosts);
        $closes = array_search("# END {$domain}", $vhosts);

        array_splice($vhosts, $opens, $closes - $opens + 1);

        file_put_contents(TestEnv::getApacheExtraFolder() . "httpd-vhosts.conf", rtrim(implode(PHP_EOL, $vhosts), PHP_EOL));

        $this->info('Please restart your apache webserver for changes to take effect.');
    }
}
