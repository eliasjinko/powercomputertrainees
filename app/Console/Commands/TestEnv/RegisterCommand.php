<?php

namespace App\Console\Commands\TestEnv;

use App\TestEnv;
use Illuminate\Console\Command;

class RegisterCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testenv:register {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register the testenv';

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
        if (PHP_OS != "WINNT") {
            $this->error("This command can only be run on windows for now");
            return;
        }
        $basepath = str_replace('\\', '/', base_path());
        $pubpath =  str_replace('\\', '/', public_path());
        $domain =   $this->input->getArgument('path');

        $hostsvalue = '127.0.0.1`t' . $domain . '`t# ' . $domain;

        $fgc = explode(PHP_EOL, file_get_contents(TestEnv::HOSTS_PATH));

        if ($fgc[count($fgc)-1] != "") // ending with new line check
            $hostsvalue = '`r`n' . $hostsvalue;

        $errorcode = TestEnv::runPowershellElevatedCommand('Add-Content -Path ' . TestEnv::HOSTS_PATH . ' -Value "' . $hostsvalue . '" -Force');
        if ($errorcode != 0) {
            $this->error('Error: Powershell exited with non-zero exit code ' . $errorcode);
        }
        file_put_contents(TestEnv::getApacheExtraFolder() . "httpd-vhosts.conf", PHP_EOL . PHP_EOL . TestEnv::generateVHostsEntry($pubpath, $domain), FILE_APPEND);

        $this->info('Please restart your apache webserver for changes to take effect.');
    }
}
