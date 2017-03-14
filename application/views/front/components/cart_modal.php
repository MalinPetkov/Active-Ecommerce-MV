<div class="modal fade popup-cart" id="popup-cart" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="container">
            <div class="cart-items">
                <div class="cart-items-inner">
                    <span class="top_carted_list">
                    </span>
                    <div class="media">
                        <p class="pull-right item-price shopping-cart__total">$450.00</p>
                        <div class="media-body">
                            <h4 class="media-heading item-title summary">
                                <?php echo translate('subtotal');?>
                            </h4>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <div>
                                <span class="btn btn-theme-dark" data-dismiss="modal">
                                    <?php echo translate('close');?>
                                </span><!--
                                -->
                                <a href="<?php echo base_url(); ?>index.php/home/cart_checkout" class="btn  btn-theme-transparent btn-call-checkout">
                                    <?php echo translate('checkout');?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>