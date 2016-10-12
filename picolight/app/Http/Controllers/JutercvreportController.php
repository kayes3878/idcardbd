<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use App\JuteReceife;
use App\Jutereceivereport;
use PDF;
use Dompdf\Dompdf;

// define('Siyamrupali',"../fonts/");
// define("DOMPDF_UNICODE_ENABLED", true);

class JutercvreportController extends Controller{


    public function getreportPDF(){


        $dompdf = new DOMPDF();

        // $dompdf->set_option('defaultFont', 'Siyamrupali');


        $jutereceives= JuteReceife::all();



        // mb_convert_encoding($jutemillitems, 'HTML-ENTITIES', 'UTF-8');

        // $pdf = htmlentities($jutemillitems, ENT_QUOTES, "UTF-8");

        // mb_convert_encoding(html_entity_decode($jutemillitems),"UTF-8","ISO-8859-1");

        
        $pdf = PDF::loadView('pdf.jutereceivereport',['jutereceives'=>$jutereceives]);
        $pdf ->setPaper('A4', 'potrait');
        
        return $pdf ->stream('jutereceivereport.pdf');

        // return $pdf ->stream('jutemillitemreport.pdf','HTML-ENTITIES', 'UTF-8' );
        


        


    }
}

?>