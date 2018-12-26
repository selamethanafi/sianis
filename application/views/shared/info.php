<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="container-fluid">
    <h2><?php echo $title ?></h2>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Info:</span>
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <?php echo $this->session->flashdata('pesan_info') ?>
            </div>
        </div>
    </div>

</div> <!-- container -->

