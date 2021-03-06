<?php  include 'header.php' ?>
<?php
if ($profile->status == 1 || $profile->status == 0) {

    $breadcumb = 'Meter Profile';
    $opr = "Meter type Edit & Delete";
}else if($profile->status == 2){

    $breadcumb = 'Meter Restore Profile';
    $opr = "Restore Meter";
}
?>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                   
                    <!-- END THEME PANEL -->
                   
                    <h1 class="page-title"><?=$breadcumb ?>
                      <!--   <small>statistics, charts, recent events and reports</small> -->
                    </h1>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="<?=base_url().'admin'?>">Dashboard</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <?php
                                if ($profile->status == 1 || $profile->status == 0) {?>
                                    <a href="<?= base_url().'admin/meter'?>">Meter</a>
                                    <i class="fa fa-angle-right"></i>
                                <?php } else if($profile->status == 2){?>
                                    <a href="<?=base_url().'admin/meter_recovery'?>">Meter Restore List</a>
                                    <i class="fa fa-angle-right"></i>
                                <?php }
                                ?>
                            </li>
                            <li>
                                <span><?=$breadcumb?></span>
                            </li>
                        </ul>
                        <!-- <a href="index.php" class="btn btn-warning pull-right">Go to Home</a> -->
                    </div>
                    <!-- END PAGE HEADER-->
                    <div class="row">
                    <!-- substation details -->
                            <div class="col-md-6">
                                <div class="panel-group">
                            <div class="panel panel-default">
                              <div class="panel-heading font-green-seagreen"><b>Details</b></div>
                              <div class="panel-body">
                                  <table class="table">
                                      <tr>
                                          <th>Meter Name</th>
                                          <td><?=$profile->meter_name?></td>
                                      </tr>
                                      <tr>
                                          <th>Meter Short Name</th>
                                          <td><?=$profile->display_name?></td>
                                      </tr>
                                      <tr>
                                          <th>Meter Type</th>
                                          <td><?=$profile->meter_type?></td>
                                      </tr>
                                  </table>
                              </div>
                            </div>

                          </div>
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading font-green-seagreen"><b>Status</b></div>
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <th>Status</th>
                                                    <td> <?php
                                                        if($profile->status == 1){
                                                            echo '<span class="label label-success">Active</span>';
                                                        }else if($profile->status == 0){
                                                            echo '<span class="label label-warning">In Active</span>';
                                                        }else{
                                                            echo '<span class="label label-danger">Delete</span>';
                                                        }
                                                        ?></td>
                                                </tr>
                                                <!-- <tr>
                                                   <th>Alternative Contact No</th>
                                                   <td>123456789</td>
                                               </tr> -->

                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading font-green-seagreen"><b>Dates</b></div>
                                        <div class="panel-body">
                                            <table class="table">
                                                <tr>
                                                    <th>Created On</th>
                                                    <td><?= date('d/m/Y', $profile->created_date) ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Last Updated On</th>
                                                    <td><?php
                                                        if ($profile->updated_date != '') {
                                                            echo date('d/m/Y', $profile->updated_date);
                                                        } else {
                                                            echo date('d/m/Y', $profile->created_date);
                                                        }

                                                        ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- end of the sudstation details -->
                        <div class="col-md-6">
                            <?php
                            $meter_type = $this->admin_model->get_meter_details_by_type($profile->meter_type);
                            ?>

                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading font-green-seagreen"><b>Parameters</b></div>
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th>Active Power</th>
                                                <td><?php
                                                    if($meter_type->act_power == 1){
                                                        echo '<span class="label label-success">Active</span>';
                                                    }else if($meter_type->act_power == 0){
                                                        echo '<span class="label label-warning">In Active</span>';
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Reactive Power</th>
                                                <td><?php
                                                    if($meter_type->rct_power == 1){
                                                        echo '<span class="label label-success">Active</span>';
                                                    }else if($meter_type->rct_power == 0){
                                                        echo '<span class="label label-warning">In Active</span>';
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Live Current</th>
                                                <td><?php
                                                    if($meter_type->lc	 == 1){
                                                        echo '<span class="label label-success">Active</span>';
                                                    }else if($meter_type->lc	 == 0){
                                                        echo '<span class="label label-warning">In Active</span>';
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Live Voltage</th>
                                                <td><?php
                                                    if($meter_type->lv == 1){
                                                        echo '<span class="label label-success">Active</span>';
                                                    }else if($meter_type->lv == 0){
                                                        echo '<span class="label label-warning">In Active</span>';
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Power Factor</th>
                                                <td><?php
                                                    if($meter_type->pf == 1){
                                                        echo '<span class="label label-success">Active</span>';
                                                    }else if($meter_type->pf == 0){
                                                        echo '<span class="label label-warning">In Active</span>';
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Frequency</th>
                                                <td><?php
                                                    if($meter_type->fre == 1){
                                                        echo '<span class="label label-success">Active</span>';
                                                    }else if($meter_type->fre == 0){
                                                        echo '<span class="label label-warning">In Active</span>';
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Units Consumed</th>
                                                <td><?php
                                                    if($meter_type->cp_units == 1){
                                                        echo '<span class="label label-success">Active</span>';
                                                    }else if($meter_type->cp_units == 0){
                                                        echo '<span class="label label-warning">In Active</span>';
                                                    }
                                                    ?></td>
                                            </tr>
                                            <tr>
                                                <th>Apparent Power</th>
                                                <td><?php
                                                    if($meter_type->apr_power == 1){
                                                        echo '<span class="label label-success">Active</span>';
                                                    }else if($meter_type->apr_power == 0){
                                                        echo '<span class="label label-warning">In Active</span>';
                                                    }
                                                    ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading font-green-seagreen"><b><?=$opr?></b></div>
                            <div class="panel-body">
                                <table class="table">
                                    <?php
                                    if ($profile->status == 1 || $profile->status == 0) {
                                        ?>
                                        <a class="btn btn-warning   btn_cls" data-toggle="tooltip"
                                           data-placement="top" title="" data-original-title="Update"
                                           href="<?php echo base_url(); ?>admin/meter_edit/<?php echo $profile->id; ?>"> <i
                                                class="glyphicon glyphicon-pencil"></i>Edit</a>

                                        <a class="btn btn-danger" data-toggle="tooltip"
                                           data-placement="top" title="" data-original-title="Delete"
                                           onclick="return bootboxConfirm('Are you sure delete this Meter ( <?=$this->admin_model->get_meter_name($profile->id)?> )',this.href)"
                                           href="<?php echo base_url(); ?>admin/meter_delete/<?php echo $profile->id; ?>"> <i
                                                class="glyphicon glyphicon-trash"></i>Delete</a>


                                        <?php

                                    } else if ($profile->status == 2) {
                                        ?>
                                        <a class="btn yellow  danger-tooltip" data-toggle="tooltip"
                                           data-placement="top" title="" data-original-title="Restore"
                                           onclick="return bootboxConfirm('Are you sure restore this Meter ( <?=$this->admin_model->get_meter_name($profile->id)?> )',this.href)"
                                           href="<?php echo base_url(); ?>admin/meter_recovery/<?php echo $profile->id; ?>"> <i
                                                class="glyphicon glyphicon-repeat"></i> Restore</a>


                                        <?php

                                    }
                                    ?>
                                    <!-- <tr>
                                       <th>Alternative Contact No</th>
                                       <td>123456789</td>
                                   </tr> -->

                                </table>
                            </div>
                        </div>
                    </div>
                        </div>
                            <!-- sub station status -->

                             <!-- end sub station status -->
                    </div><br>
                              <!-- sub station Contact person -->




              
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <a href="javascript:;" class="page-quick-sidebar-toggler">
                <i class="icon-login"></i>
            </a>
           <!--  -->
            <!-- END QUICK SIDEBAR -->
        </div>

        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php include "footer.php"?>
