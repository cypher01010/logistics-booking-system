<?php
/* @var $this yii\web\View */
$this->title = 'Dashboard';
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="index.html">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="<?php echo date("M d, Y")?>">
            <i class="fa fa-calendar"></i>
            <span class="thin uppercase visible-lg-inline-block">&nbsp;&nbsp; <?php echo date(\Yii::$app->controller->dateFormatDisplay())?></span>
        </div>
    </div>
    
</div>

<div class="row">
    <!-- portfolio -->
    <div id="portfolio" class="col-md-6">
        <div class="portlet light bg-inverse">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-green-sharp ">Calendar</span>
                    <span class="caption-helper"></span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <p style="padding-left: 15px">Calendar Here</p>						
                </div>
            </div>
        </div>
    </div>

    <!-- history -->
    <div id="price-change" class="col-md-6">
        <div class="portlet light bg-inverse">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-green-sharp ">Recent Deliveries</span>
                    <span class="caption-helper"></span>
                </div>

            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                        <table class="table table-striped table-hover">

                        <thead>
                        <tr>
                            <th>
                                 Date
                            </th>
                            <th>
                                 Customer
                            </th>
                            <th>
                                 Status
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                     19 Nov 14
                                </td>
                                <td>
                                     Luciano Tarorot
                                </td>
                                <td>
                                    <span class="label label-sm label-success">
                                    Delivered</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     19 Nov 14
                                </td>
                                <td>
                                     James Bang
                                </td>
                                <td>
                                    <span class="label label-sm label-warning">
                                    In Progress</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     19 Nov 14
                                </td>
                                <td>
                                     Lito Lapok
                                </td>
                                <td>
                                    <span class="label label-sm label-danger">
                                    Cancelled</span>
                                </td>
                            </tr>
                                                                <tr>
                                <td>
                                     19 Nov 14
                                </td>
                                <td>
                                     Inday Palad
                                </td>
                                <td>
                                    <span class="label label-sm label-success">
                                    Delivered</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     19 Nov 14
                                </td>
                                <td>
                                     Boy Logro
                                </td>
                                <td>
                                    <span class="label label-sm label-warning">
                                    In Progress</span>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>

                <a href="<?php echo \Yii::$app->getUrlManager()->createUrl("delivery/crud/index"); ?>" style="float:right" class="btn btn-success align-right">View all</a>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>