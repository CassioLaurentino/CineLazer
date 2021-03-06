<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\ReportsRequest;
use JasperPHP\JasperPHP;
use App\Sessoes;

class ReportController extends Controller {
    /**
     * Reporna um array com os parametros de conexão
     * @return Array
     */
    public function getDatabaseConfig() {
        return [
            'driver'   => env('DB_CONNECTION'),
            'host'     => env('DB_HOST'),
            'port'     => env('DB_PORT'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'database' => env('DB_DATABASE'),
            'jdbc_dir' => '/home/cassio.laurentino/CineLazer/vendor/copam/phpjasper/src/JasperStarter/jdbc/',
        ];
    }

    public function sessoes(ReportsRequest $request) {
        $report = '/reports/Sessoes.jrxml';
        $file_name = 'sessoes';
        $params = array('STARTDATE' =>  date('Ymd', strtotime($request['data_inicial'])), 'ENDDATE' => date('Ymd', strtotime($request['data_final'])));
        return $this->process($report, $file_name, $params);
    }

    public function reservas_mensal(ReportsRequest $request) {
        $report = '/reports/Reservas_mensal.jrxml';
        $file_name = 'reservas_mensal';
        $params = array('STARTDATE' =>  date('Ymd', strtotime($request['data_inicial'])), 'ENDDATE' => date('Ymd', strtotime($request['data_final'])));
        return $this->process($report, $file_name, $params);
    }

    public function process($report, $file_name, $params) {
        // coloca na variavel o caminho do novo relatório que será gerado
        $output = public_path() . '/reports/' . time() . '_' . $file_name;
        $file_path = public_path() . $report;
        
        $report = new JasperPHP;
        $report->process(
            $file_path,
            $output,
            ['pdf'],
            $params,
            $this->getDatabaseConfig()
        )->execute();
        $file = $output . '.pdf';
        $path = $file;

        // caso o arquivo não tenha sido gerado retorno um erro 404
        if (!file_exists($file)) {
            abort(404);
        }
        //caso tenha sido gerado pego o conteudo
        $file = file_get_contents($file);
        //deleto o arquivo gerado, pois iremos mandar o conteudo para o navegador
        unlink($path);
        // retornamos o conteudo para o navegador que íra abrir o PDF
        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename=report.pdf');
    }
}