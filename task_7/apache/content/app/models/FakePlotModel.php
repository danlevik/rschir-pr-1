<?php
require_once 'vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

class FakePlotModel extends Model {
    static $imageFolder = "../../images/";

    function draw_plot_bar($bloodTypeCount)
    {
        $__width = 400;
        $__height = 300;
        $graph = new Graph\Graph($__width, $__height, 'auto');
        $graph->SetShadow();
        $graph->title->Set("Blood Type");
        $graph->title->SetFont(FF_FONT1, FS_BOLD);

        $labels_and_values = $bloodTypeCount;
        $labels = $labels_and_values["labels"];
        $values = $labels_and_values["values"];

        $databary = $values;
        $graph->SetScale('textlin');
        $graph->xaxis->SetTickLabels($labels);
        $graph->title->Set($_GET['property']);
        $graph->title->SetFont(FF_FONT1, FS_BOLD);
        $b1 = new Plot\BarPlot($databary);
        $b1->SetLegend($_GET['property']);
        $graph->Add($b1);
        $graph->Stroke('images/plot_bar.png');
    }

    function draw_plot_pie($dayCount)
    {
        $graph = new Graph\PieGraph(400, 300);
        $graph->title->Set("Day choice");
        $graph->title->SetFont(FF_FONT1, FS_BOLD);
        $graph->SetBox(true);

        $labels_and_values = $dayCount;
        $labels = $labels_and_values["labels"];
        $values = $labels_and_values["values"];

        $p1 = new Plot\PiePlot($values);
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetLabels($labels);
        $graph->Add($p1);
        $graph->Stroke("images/plot_pie.png");
    }

    // function draw_plot_scatter($dayBloodTuple)
    // {
    //     $data = $dayBloodTuple;
    //     $datax = $data["day"];
    //     $datay = $data["blood"];

    //     $__width = 400;
    //     $__height = 300;
    //     $graph = new Graph\Graph($__width, $__height);
    //     $graph->SetScale('linlin');

    //     $graph->img->SetMargin(40, 40, 40, 40);
    //     $graph->SetShadow();

    //     $graph->title->Set('Blood and Day');
    //     $graph->title->SetFont(FF_FONT1, FS_BOLD);


    //     $sp1 = new Plot\ScatterPlot($datay, $datax);
    //     $sp1->mark->SetType(MARK_FILLEDCIRCLE);
    //     $sp1->mark->SetFillColor("#ff8800");
    //     $sp1->mark->SetWidth(8);

    //     $graph->Add($sp1);
    //     $graph->Stroke("images/plot_scatter.png");
    // }


    function draw_plot_line($monthCount)
{
    $labels_and_values = $monthCount;

    $__width = 800;
    $__height = 400;

    $graph = new Graph\Graph($__width, $__height, 'auto');
    $graph->SetScale("textlin");
    
    
    $graph->img->SetAntiAliasing(false);
    $graph->title->Set('Months');
    $graph->title->SetFont(FF_FONT2, FS_BOLD);
    $graph->SetBox(false);

    $graph->SetMargin(40,40,40,40);

    $graph->img->SetAntiAliasing();

    $graph->yaxis->HideZeroLabel();
    $graph->yaxis->HideLine(false);
    $graph->yaxis->HideTicks(false,false);

    $graph->xgrid->Show();
    $graph->xgrid->SetLineStyle("solid");
    $graph->xaxis->SetTickLabels($labels_and_values["labels"]);
    $graph->xgrid->SetColor('#E3E3E3');
    
    //??Create??the??first??line
    $p1 = new Plot\LinePlot(array_values($labels_and_values["values"]));
    $p1->SetColor("#6495ED");
    $p1->SetLegend('Month counts');

    $graph->Add($p1);
    $graph->Stroke("images/plot_line.png");
}
}