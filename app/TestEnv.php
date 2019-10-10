<?php


namespace App;


class TestEnv
{
    public const HOSTS_PATH = 'C:\\Windows\\System32\\drivers\\etc\\hosts';

    public static function runPowershellElevatedCommand($command)
    {
        // https://superuser.com/a/1202923
        $command = str_replace('"', '"""""""""', $command);
        exec('powershell.exe $p = Start-Process powershell.exe -ArgumentList \'' . $command . '\' -Verb runAs -Wait -PassThru;exit $p.ExitCode;', $ob, $exitCode);
        return 0;
    }

    public static function generateVHostsEntry($publicPath, $domain, $createErrorLog = true)
    {
        $vhc = [];
        $vhc[] = "# " . $domain;
        $vhc[] = "<VirtualHost *:80>";
        $vhc[] = "\tServerAdmin webmaster@$domain";
        $vhc[] = "\tDocumentRoot $publicPath";
        $vhc[] = "\tServerName $domain";
        $vhc[] = "\tServerAlias www.{$domain} *.{$domain}";
        if ($createErrorLog) {
            $vhc[] = "\tErrorLog \"logs/{$domain}-error.log\"";
            $vhc[] = "\tCustomLog \"logs/{$domain}-access.log\" common";
        }
        $vhc[] = "";
        $vhc[] = "\t<Directory \"$publicPath\">";
        $vhc[] = "\t\tOptions Indexes FollowSymLinks Includes ExecCGI";
        $vhc[] = "\t\tAllowOverride All";
        $vhc[] = "\t\tOrder allow,deny";
        $vhc[] = "\t\tAllow from all";
        $vhc[] = "\t\tRequire all granted";
        $vhc[] = "\t</Directory>";
        $vhc[] = "</VirtualHost>";
        $vhc[] = "# END $domain";

        return implode(PHP_EOL, $vhc);
    }

    public static function getApacheExtraFolder()
    {
        $apache_extra_dir = str_replace('php.exe', '', PHP_BINARY);
        $apache_extra_dir .= '..\\apache\\conf\\extra\\';
        return $apache_extra_dir;
    }

}
