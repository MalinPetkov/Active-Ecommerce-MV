<!--CONTENT CONTAINER-->
<?php 
		foreach($admin_data as $row)
        { 
?>
<div id="content-container" style="padding-top:0px !important;">
    <div class="text-center pad-all">
        <div class="pad-ver">
            <img 
            	<?php if(file_exists('uploads/admin_image/admin_'.$row['admin_id'].'.jpg')){ ?>
                    src="<?php echo base_url(); ?>uploads/admin_image/admin_<?php echo $row['admin_id']; ?>.jpg"
                <?php } else { ?>
                    src="<?php echo base_url(); ?>template/front/uploads/img/admin.jpg"
                <?php } ?>
             	class="img-md img-border img-circle" alt="Profile Picture">
        </div>
        <h4 class="text-lg text-overflow mar-no"><?php echo $row['name']?></h4>
        <p class="text-sm"><?php echo translate('admin');?></p>
        <hr>
    </div>


<div class="row">
    <div class="col-sm-12">
        <div class="panel-body">
            <table class="table table-striped" style="border-radius:3px;">
                <tr>
                    <th class="custom_td"><?php echo translate('name');?></th>
                    <td class="custom_td"><?php echo $row['name'];?></td>
                </tr>
				<tr>
                    <th class="custom_td"><?php echo translate('address');?></th>
                    <td class="custom_td"><?php echo $row['address'];?></td>
                </tr>
				<tr>
                    <th class="custom_td"><?php echo translate('email');?></th>
                    <td class="custom_td"><?php echo $row['email'];?></td>
                </tr>
				<tr>
                    <th class="custom_td"><?php echo translate('phone_number');?></th>
                    <td class="custom_td"><?php echo $row['phone'];?></td>
                </tr>
				<tr>
                    <th class="custom_td"><?php echo translate('account_role');?></th>
                    <td class="custom_td"><?php echo $this->crud_model->get_type_name_by_id('role',$row['role']); ?></td>
                </tr>
                <tr>
                    <th class="custom_td"><?php echo translate('creation_date');?></th>
                    <td class="custom_td"><?php echo date('Y-m-d',$row['timestamp']);?></td>
                </tr>
            </table>
          </div>
        </div>
    </div>					
</div>					
</div>
</div>
<?php 
	}
?>
            
<style>
.custom_td{
border-left: 1px solid #ddd;
border-right: 1px solid #ddd;
border-bottom: 1px solid #ddd;
}
</style>