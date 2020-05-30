<?php

class Statistics extends Controller
{
    private $list = array();
    public function index()
    {
        $this->view('statistics/statistics');
    }

    function getList() {
        return $this->list;
    }

    function manageButtonClick()
    {
        if (isset($_POST['most-popular'])) {
            $this->getMostPopular();
        }
        if (isset($_POST['Size'])) {
        }
        if (isset($_POST['Newest and oldest'])) {
        }
        if(isset($_POST['rss_file'])) {
            $this->createRSS();
        }
        // if (isset($_GET['download'])) {
        //     $this->outputCSV($this->model->list);
        // }
    }

    function getMostPopular()
    {
        $this->list = $this->model->getMostPopularCoins();
        $_SESSION['list_coins_download'] = $this->list;
    }


    function outputCSV($file_name = 'file.csv')
    {
        $data = $_SESSION['list_coins_download'];
        if (isset($_POST['download'])) {

            # output headers so that the file is downloaded rather than displayed
            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename=$file_name");
            # Disable caching - HTTP 1.1
            header("Cache-Control: no-cache, no-store, must-revalidate");
            # Disable caching - HTTP 1.0
            header("Pragma: no-cache");
            # Disable caching - Proxies
            header("Expires: 0");

            # Start the ouput
            $output = fopen("php://output", "w");

            # Then loop through the rows
            foreach ($data as $row) {
                # Add the rows to the body
                fputcsv($output, $row); // here you can change delimiter/enclosure
            }
            # Close the stream off
            fclose($output);
        }
    }


    function getBySize()
    {

        header("location: /numax/mvc/public/statistics");
    }

    function getByNewest()
    {

        header("location: /numax/mvc/public/statistics");
    }

    function createRSS() {
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
