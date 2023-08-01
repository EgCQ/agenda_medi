<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPJasper\PHPJasper;

class ReportController extends Controller
{
    public function getDatabaseConfig()
    {
        $jdbc_dir = 'C:\xampp\htdocs\agenda_medica\vendor\cossou\jasperphp\src\JasperStarted\jdbc';
        return [
            'driver' => 'generic',
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'database' => env('DB_DATABASE'),
            'jdbc_driver' => 'com.microsoft.sqlserver.jdbc.SQLServerDriver',
            'jdbc_url' => 'jdbc:sqlserver://192.168.1.250:1433;databaseName='.env('DB_DATABASE').'',
            'jdbc_dir' => $jdbc_dir
        ];
    }
    public function generateReport(){
        // $input = 'C:/xampp/htdocs/agenda_medica/vendor/lavela/phpjasper/examples/hello_world.jrxml';

        // $jasper = new PHPJasper;
        // $jasper->compile($input)->execute();

        $input =  'C:/xampp/htdocs/agenda_medica/vendor/lavela/phpjasper/examples/hello_world.jasper';
        $output =  'C:/xampp/htdocs/agenda_medica/vendor/lavela/phpjasper/examples';
        $options = [
            'format' => ['pdf', 'rtf']
        ];

        $jasper = new PHPJasper;
        $ext = "pdf";
        $jasper->process(
            $input,
            $output,
            $options
        )->execute();
        $doc = str_replace(".jasper", ".pdf", $input);
        return response()->file($doc);
    }
}
