<?php
	echo form_open('', array(
		'method' => 'post',
		'class' => 'sky-form',
	));
?>
    <div class="order fix-length">	
        <div class="buttons">
            <?php
                $all_op = json_decode($row['options'],true);
                $all_c = json_decode($row['color']);
                    if($all_c){
            ?>
            <div class="options">
                <h3 class="title"><?php echo translate('color_:');?></h3>
                <div class="content">
                    <ul class="list-inline colors">
                        <?php
                            $n = 0;
                            foreach($all_c as $i => $p){
                                $c = '';
                                $n++;
                                if($a = $this->crud_model->is_added_to_cart($row['product_id'],'option','color')){
                                    if($a == $p){
                                        $c = 'checked';
                                    }
                                } else {
                                    if($n == 1){
                                        $c = 'checked';
                                    }
                                }
                        ?>
                            <li>
                                <input type="radio" style="display:none;" id="c-<?php echo $i; ?>" value="<?php echo $p; ?>" <?php echo $c; ?> name="color">
                                <label style="background:<?php echo $p; ?>;" for="c-<?php echo $i; ?>"></label>
                            </li>  
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <?php 
				}
			?>
            <?php
                if(!empty($all_op)){
                    foreach($all_op as $i=>$row1){
                        $type = $row1['type'];
                        $name = $row1['name'];
                        $title = $row1['title'];
                        $option = $row1['option'];
            ?>
            <div class="options">
                <h3 class="title"><?php echo $title.' :';?></h3>
                <div class="content">
                <?php
                    if($type == 'radio'){
                ?>
                    <div class="custom_radio">
                    <?php
                        $i=1;
                        foreach ($option as $op) {
                    ?>
                      <input type="radio" class="optional" name="<?php echo $name;?>" value="<?php echo $op;?>" <?php if($this->crud_model->is_added_to_cart($row['product_id'], 'option', $name) == $op){ echo 'checked'; } ?> id="<?php echo 'red_'.$i; ?>">
                      <label class="radio circle" for="<?php echo 'red_'.$i; ?>">
                        <span class="big">
                          <span class="small"></span>
                        </span>
                        <?php echo $op;?>
                      </label>
                    <?php
                        $i++;
                        }
                    ?>
                    </div>
                <?php
                    } else if($type == 'text'){
                ?>
                    <label class="textarea">
                        <textarea class="optional" rows="5" cols="30" name="<?php echo $name;?>"><?php echo $this->crud_model->is_added_to_cart($row['product_id'], 'option', $name); ?></textarea>
                    </label>
                <?php
                    } else if($type == 'single_select'){
                ?>
                    <label class="select">
                        <select name="<?php echo $name; ?>" class="optional selectpicker input-price" data-live-search="true" >
                            <option value=""><?php echo translate('choose_one'); ?></option>
                            <?php
                                foreach ($option as $op) {
                            ?>
                            <option value="<?php echo $op; ?>" <?php if($this->crud_model->is_added_to_cart($row['product_id'], 'option', $name) == $op){ echo 'selected'; } ?> ><?php echo $op; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <i></i>
                    </label>
                    <?php
                        } else if($type == 'multi_select') {
                    ?>
                    <div class="checkbox">
                    <?php
                        $j=1;
                        foreach ($option as $op){
                    ?>
                    <label for="<?php echo 'check_'.$j; ?>" onClick="check(this)" >
                        <input type="checkbox" id="<?php echo 'check_'.$j; ?>" class="optional" name="<?php echo $name;?>[]" value="<?php echo $op;?>" <?php if(!is_array($chk = $this->crud_model->is_added_to_cart($row['product_id'], 'option', $name))){ $chk = array(); } if(in_array($op, $chk)){ echo 'checked'; } ?>>
                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                        <?php echo $op;?>
                    </label>
                    <?php
                        $j++;
                        }
                    ?>
                    </div>
                <?php
                    }
                ?>
                </div>
            </div>
            <?php
                    }
                }
            ?>
            <div class="item_count">
                <div class="quantity product-quantity">
                    <span class="btn" name='subtract' onclick='decrease_val();'>
                        <i class="fa fa-minus"></i>
                    </span>
                    <input  type="number" class="form-control qty quantity-field cart_quantity" min="1" max="<?php echo $row['current_stock']; ?>" name='qty' value="<?php if($a = $this->crud_model->is_added_to_cart($row['product_id'],'qty')){echo $a;} else {echo '1';} ?>" id='qty'/>
                    <span class="btn" name='add' onclick='increase_val();'>
                        <i class="fa fa-plus">
                    </i></span>
                </div>
                <?php
                    if($row['current_stock'] > 0){
                ?>
                <div class="stock">
                    <?php echo $row['current_stock'].' '.$row['unit'].translate('_available');?>
                </div>
                <?php
                    }else{
                ?>
                <div class="out_of_stock">
                    <?php echo translate('out_of_stock');?>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="buttons" style="display:inline-flex;">
        <span class="btn btn-add-to cart" onclick="to_cart(<?php echo $row['product_id']; ?>,event)">
            <i class="fa fa-shopping-cart"></i>
			<?php if($this->crud_model->is_added_to_cart($row['product_id'])=="yes"){ 
                echo translate('added_to_cart');  
                } else { 
                echo translate('add_to_cart');  
                } 
            ?>
        </span>
        <?php 
            $wish = $this->crud_model->is_wished($row['product_id']); 
        ?>
        <span class="btn btn-add-to <?php if($wish == 'yes'){ echo 'wished';} else{ echo 'wishlist';} ?>" onclick="to_wishlist(<?php echo $row['product_id']; ?>,event)">
            <i class="fa fa-heart"></i>
            <span class="hidden-xs hidden-sm">
				<?php if($wish == 'yes'){ 
                    echo translate('_added_to_wishlist'); 
                    } else { 
                    echo translate('_add_to_wishlist');
                    } 
                ?>
            </span>
        </span>
        <?php 
            $compare = $this->crud_model->is_compared($row['product_id']); 
        ?>
        <span class="btn btn-add-to compare btn_compare"  onclick="do_compare(<?php echo $row['product_id']; ?>,event)">
            <i class="fa fa-exchange"></i>
            <span class="hidden-xs hidden-sm">
				<?php if($compare == 'yes'){ 
                    echo translate('_compared'); 
                    } else { 
                    echo translate('_compare');
                    } 
                ?>
            </span>
        </span>
    </div> 
</form>
<div id="pnopoi"></div>
<div class="buttons">
	<div id="share"></div>
</div>
<hr class="page-divider small"/>
<script>
$(document).ready(function() {
	$('#popup-7').find('.closeModal').on('click',function(){
		$('#pnopoi').remove();
	});
	check_checkbox();
	set_select();
	$('#share').share({
		urlToShare: '<?php echo $this->crud_model->product_link($row['product_id']); ?>',
		networks: ['facebook','googleplus','twitter','linkedin','tumblr','in1','stumbleupon','digg'],
		theme: 'square'
	});
});
function check_checkbox(){
	$('.checkbox input[type="checkbox"]').each(function(){
        if($(this).prop('checked') == true){
			$(this).closest('label').find('.cr-icon').addClass('add');
		}else{
			$(this).closest('label').find('.cr-icon').addClass('remove');
		}
    });
}
function check(now){
	if($(now).find('input[type="checkbox"]').prop('checked') == true){
		$(now).find('.cr-icon').removeClass('remove');
		$(now).find('.cr-icon').addClass('add');
	}else{
		$(now).find('.cr-icon').removeClass('add');
		$(now).find('.cr-icon').addClass('remove');
	}
}
function decrease_val(){
	var value=$('.quantity-field').val();
	if(value > 1){
		var value=--value;
	}
	$('.quantity-field').val(value);
}
function increase_val(){
	var value=$('.quantity-field').val();
	var max_val =parseInt($('.quantity-field').attr('max'));
	if(value < max_val){
		var value=++value;
	}
	$('.quantity-field').val(value);
}
</script>