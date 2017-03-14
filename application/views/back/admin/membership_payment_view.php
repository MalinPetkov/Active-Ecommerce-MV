<?php
    foreach ($membership_payment_data as $row) {
?>
<div>
    <?php
        echo form_open(base_url() . 'index.php/admin/membership_payment/upgrade/'.$row['membership_payment_id'], array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'membership_payment_view',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <td><?php echo translate('vendor');?></td>
                        <td><?php echo $this->db->get_where('vendor',array('vendor_id'=>$row['vendor']))->row()->display_name; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo translate('amount');?></td>
                        <td><?php echo currency('','def').$row['amount']; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo translate('datetime');?> </td>
                        <td><?php echo date('d M,Y',$row['timestamp']); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo translate('membership_to_upgrade');?> </td>
                        <td><?php echo $this->db->get_where('membership',array('membership_id'=>$row['membership']))->row()->title; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo translate('method');?></td>
                        <td>
                            <?php 
                                if($row['method'] == 'c2'){
                                    echo 'Twocheckout';
                                }
                                else echo $row['method']; 
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo translate('details');?></td>
                        <td><?php echo $row['details']; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo translate('status');?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                </table>
            </div>

            <?php
                if($row['status'] !== 'paid'){
            ?>
            <div class="form-group btm_border">
                <label class="col-sm-4 control-label" for="page_name"><?php echo translate('status');?></label>
                <div class="col-sm-6">
                    <input type="checkbox" name="status" value="paid" class="form-control"> <?php echo translate('paid');?>
                </div>
            </div>

            <div class="form-group btm_border">
                <label class="col-sm-4 control-label" for="page_name"><?php echo translate('details');?></label>
                <div class="col-sm-6">
                    <textarea name="details" id="page_name" class="form-control"></textarea>
                </div>
            </div>
            <?php
                }
            ?>

        </div>
        
    </form>
</div>
<div id="reserve"></div>
<?php
    }
?>

