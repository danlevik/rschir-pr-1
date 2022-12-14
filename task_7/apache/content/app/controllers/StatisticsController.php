<?php
require_once "app/models/FakeDataModel.php";
require_once "app/models/FakePlotModel.php";
require_once "app/models/WatermarkModel.php";

class StatisticsController extends Controller {

    private FakeDataModel $fakerDataModel;
    private FakePlotModel $fakePlotModel;
    private WatermarkModel $watermarkModel;

    function __construct()
    {
        parent::__construct();
        $this->fakerDataModel = new FakeDataModel();
        $this->fakePlotModel = new FakePlotModel();
        $this->watermarkModel = new WatermarkModel();
    }

    function index() {
        $this->fakerDataModel->generateData();
        $data = $this->fakerDataModel->getRawData();
        $bloodTypeCount = $this->fakerDataModel->getBloodTypeCount($data);
        $dayCount = $this->fakerDataModel->getDayCount($data);
        $monthCount = $this->fakerDataModel->getMonthCount($data);
        $this->fakePlotModel->draw_plot_pie($dayCount);
        $this->fakePlotModel->draw_plot_bar($bloodTypeCount);
        $this->fakePlotModel->draw_plot_line($monthCount);
//
        $images = array("images/plot_pie.png", "images/plot_bar.png", "images/plot_line.png");
        // $images = array("images/plot_pie.png", "images/plot_bar.png");
        foreach ($images as $image) {
            $this->watermarkModel->addWatermark($image);
        }

        $this->view->generate("StatisticsView.php", $data);
    }
}