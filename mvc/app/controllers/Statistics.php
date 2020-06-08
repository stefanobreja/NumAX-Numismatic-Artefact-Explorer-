<?php

class Statistics extends Controller
{
    private $list = [];
    
    function __construct()
    {
        parent::__construct();

        if (Session::get("isLogged") == false || Session::get("isLogged") == null) {
            header("location: /numax/mvc/public/login");
        }
    }
    
    public function index()
    {
        $this->view('statistics/statistics');
    }

    function getList()
    {
        return $this->list;
    }

    function manageButtonClick()
    {
        if (isset($_POST['most-popular'])) {
            $this->getMostPopular();
        }
        if (isset($_POST['rarest'])) {
            $this->getRarest();
        }
        if (isset($_POST['smallest'])) {
            $this->getSmallest();
        }
        if (isset($_POST['rss_file'])) {
            $this->createRSS();
        }
    }

    function getMostPopular()
    {
        $this->list = $this->model->getMostPopularCoins();
    }

    function getRarest()
    {
        $this->list = $this->model->getRarestCoins();
    }

    function getSmallest() {
        $this->list = $this->model->getSmallestCoins();
    }


    function output()
    {
        // $data = $_SESSION['list_coins_download'];
        if(isset($_POST['coins'])) {
            $data = unserialize(base64_decode($_POST['coins']));
        }
        if (isset($_POST['download-csv'])) {
           $this->generateCSV($data);
        }
        if (isset($_POST['download-pdf'])) {
            // print_r($data);
            $this->generatePDF($data);
         }
    }

    function generatePDF($data) {

        ob_end_clean();

        $pdf = new FPDF();
        $pdf->AddPage();

        $start_x=$pdf->GetX(); //initial x (start of column position)
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();

        $cell_width = 30;  //define cell width
        $cell_height= 10;    //define cell height

        $pdf->SetFont('Arial','B',16);

        $pdf->Cell(70,10,'Name');
        $pdf->Cell(30,10,'Year');
        $pdf->Cell(30,10,'Country');
        $pdf->Cell(30,10,'Size');
        $pdf->Cell(30,10,'Weight');
        $pdf->Ln(10);

        $current_x=$start_x;           //set x to start_x (beginning of line)
        $current_y+=$cell_height;
        $pdf->SetXY($current_x, $current_y);

        $pdf->SetFont('Arial','',10);
        foreach($data as $coin){
            $mult = 1+ floor(strlen($coin['name'])/40);

            $pdf->MultiCell(70,10, utf8_decode($coin['name']));
            $current_x+=$cell_width+40;
            $pdf->SetXY($current_x, $current_y); 

            if($mult <= 1) {
                $mult = 1 + strlen($coin['years'])/15;
            }
            $pdf->MultiCell(30,10,$coin['years']);
            $current_x+=$cell_width;
            $pdf->SetXY($current_x, $current_y); 

            $pdf->MultiCell(30,10, utf8_decode($coin['country']));
            $current_x+= $cell_width;
            $pdf->SetXY($current_x, $current_y); 

            if($coin['size'] == 0) {
                $pdf->MultiCell(30,10,"Unkown");
            } else {
                $pdf->MultiCell(30,10,$coin['size'] . "mm");
            }
            $current_x+=$cell_width;
            $pdf->SetXY($current_x, $current_y);

            $pdf->MultiCell(30,10,$coin['weight'] . "g");
            $current_x+=$cell_width;
            $pdf->SetXY($current_x, $current_y);

            // $photo_name = "photo". $coin["id"] .".png";
            // $result =  file_put_contents($photo_name, $coin['back_picture']);
            // // print_r($result);
            // if($result != False) {
            //     $pdf->Image($photo_name, $current_x, $current_y, 10,10,'PNG');
            // }
            // unlink($photo_name);

            $current_x+= $cell_width;
            $pdf->SetXY($current_x, $current_y); 

            $pdf->Ln(10);

            $current_x=$start_x;           //set x to start_x (beginning of line)
            $current_y+= $mult*$cell_height;
            $pdf->SetXY($current_x, $current_y);
        }
        $file_name = "Stats_pdf.pdf";

        $pdf->Output('F',$file_name);

        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=$file_name");

        readfile($file_name);
    }

    function generateCSV($data) {
        // print_r($data);
        $file_name = "Stats_csv.csv";

        ob_end_clean();

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$file_name");

        $output = fopen("php://output", "w");

        $fields = array('Name', 'Year', 'Country', 'Shape', 'Size', 'Weight', 'Material');
        fputcsv($output, $fields, ",");

        foreach ($data as $coin) {
            $arr = [
                $coin['name'], $coin['years'],$coin['country'], $coin['shape'], $coin['size'], 
                $coin['weight'], $coin['material']
            ];
            
            fputcsv($output, $arr);
        }
        
        // fseek($output, 0);
        
        # Close the stream off
        // fpassthru($output);
        // fclose($output);
        exit();
    }

    function createRSS()
    {
        $start = "<?xml version='1.0' encoding='UTF-8'?>
        <rss version='2.0'>
        <channel> 
        <title> Coins feed </title>
        <link> http://localhost/numax/mvc/public/allcoins </link>
        <description> This is just a description for the Coins Feed </description>
        <language>en-us </language>
        <item>
        <title> Most popular coins up so far  </title>
        <link>http://localhost/tw/Resources/public/allcoins </link>
        <description>";

        $popular_coins = $this->model->getMostPopularCoins();
        $body = "";
        // print_r($popular_coins);
        foreach ($popular_coins as $coin) {
            $body .= '<span>';
            $body .= '<span>' . $coin['name'] . "</span>";
            if ($coin['years'] == 0) {
                $year = "Unkown";
            } else $year = $coin['years'];
            $body .= '<span>' . $year . '</span>';
            $body .= '<span>' . $coin['country'] . '</span>';
            // if ($coin['size'] != 0)
            //     $size = $coin['size'];
            // else $size = "Unkown";
            // if ($coin['weight'] != 0)
            //     $weight = $coin['weight'];
            // else $weight = "Unkown";
            // $body .= '<span>' . $coin['material'] . " | " . $size . "mm | " . $weight . 'g</span>';
            $body .= '</span>';
        }

        $end = "</description>
        </item>
        </channel>
        </rss>";

        $rss_content = $start . $body . $end;

        file_put_contents("D:\\rss.xml", $rss_content);
    }
}
