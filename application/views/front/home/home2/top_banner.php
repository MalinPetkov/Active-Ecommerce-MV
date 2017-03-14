<!-- PAGE -->
<?php
	$this->db->where("place", "after_slider");
	$this->db->where("status", "ok");
	$banners=$this->db->get('banner')->result_array();
	$count=count($banners);
	if($count==1){
		$md=12;
		$sm=12;
		$xs=12;
	}elseif($count==2){
		$md=6;
		$sm=6;
		$xs=6;
	}elseif($count==3){
		$md=4;
		$sm=4;
		$xs=12;
	}
	elseif($count==4){
		$md=3;
		$sm=6;
		$xs=6;
	}
	
	if($count!==0){
?>
<section class="page-section">
    <div class="container">
    	<div class="row">
            <div class="row">
                <?php
                foreach($banners as $row){
                ?>
                <div class="col-md-<?php echo $md; ?> col-sm-<?php echo $sm; ?> col-xs-<?php echo $xs; ?>">
                    <div class="thumbnail no-border no-padding thumbnail-banner size-1x<?php echo $count; ?>">
                        <div class="media">
                            <a class="media-link" href="<?php echo $row['link']; ?>">
                                <div class="img-bg image_delay" data-src="<?php echo $this->crud_model->file_view('banner',$row['banner_id'],'','','no','src','','',$row['image_ext']) ?>" style="background-image: url('<?php echo img_loading(); ?>')"></div>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
	}
?>
<!-- /PAGE -->