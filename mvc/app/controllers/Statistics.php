<?php

class Statistics extends Controller
{
    public function index()
    {
        $this->model->list = $this->model->getMostPopularCoins();
        $this->view('statistics/statistics');
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
        // if (isset($_GET['download'])) {
        //     $this->outputCSV($this->model->list);
        // }
    }

    function getMostPopular()
    {
        $this->model->list = $this->model->getMostPopularCoins();
        $_SESSION['list_coins_download'] = $this->model->list;
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
}
