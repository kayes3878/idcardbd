<?php
namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use App\Jutemillitem;
use App\Jutemillitemreport;
use PDF;
use Dompdf\Dompdf;

// define('Siyamrupali',"../fonts/");
// define("DOMPDF_UNICODE_ENABLED", true);

class JutemillreportController extends Controller{


    public function getPDF(){


        $dompdf = new DOMPDF();

        // $dompdf->set_option('defaultFont', 'Siyamrupali');


        $jutemillitems= Jutemillitem::all();



        // mb_convert_encoding($jutemillitems, 'HTML-ENTITIES', 'UTF-8');

        // $pdf = htmlentities($jutemillitems, ENT_QUOTES, "UTF-8");

        // mb_convert_encoding(html_entity_decode($jutemillitems),"UTF-8","ISO-8859-1");

        
        $pdf = PDF::loadView('pdf.jutemillitemreport',['jutemillitems'=>$jutemillitems]);
        
        return $pdf ->stream('jutemillitemreport.pdf');

        // return $pdf ->stream('jutemillitemreport.pdf','HTML-ENTITIES', 'UTF-8' );
        


        


}

function convert_to ( $pdf, $target_encoding )
    {
    // detect the character encoding of the incoming file
    $encoding = mb_detect_encoding( $pdf, "auto" );
      
    // escape all of the question marks so we can remove artifacts from
    // the unicode conversion process
    $pdf = str_replace( "?", "[question_mark]", $pdf );
      
    // convert the string to the target encoding
    $pdf = mb_convert_encoding( $pdf, $target_encoding, $encoding);
      
    // remove any question marks that have been introduced because of illegal characters
    $pdf = str_replace( "?", "", $pdf );
      
    // replace the token string "[question_mark]" with the symbol "?"
    $pdf = str_replace( "[question_mark]", "?", $pdf );
  
    return $pdf;
    }


public function encodeToUtf8($jutemillitems) {
     return mb_convert_encoding($jutemillitems, "UTF-8", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));
}

public function encodeToIso($pdf) {
     return mb_convert_encoding($jutemillitems, "ISO-8859-1", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));
}

}

?>
