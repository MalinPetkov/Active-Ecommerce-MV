							<div class="information-title">
                            	<?php echo translate('your_wishlist');?></div>
                            <div class="wishlist">
                                <table class="table" style="background: #fff;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo translate('image');?></th>
                                            <th><?php echo translate('name');?></th>
                                            <th><?php echo translate('price');?></th>
                                            <th><?php echo translate('availability');?></th>
                                            <th><?php echo translate('purchase');?></th>
                                            <th><?php echo translate('remove');?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="result4">
                                    </tbody>
                                </table>
                           </div>


                            <input type="hidden" id="page_num4" value="0" />

                            <div class="pagination_box">

                            </div>

                            <script>                                                                    
                                function wish_listed(page){
                                    if(page == 'no'){
                                        page = $('#page_num4').val();   
                                    } else {
                                        $('#page_num4').val(page);
                                    }
                                    var alerta = $('#result4');
                                    alerta.load('<?php echo base_url();?>index.php/home/wish_listed/'+page,
                                        function(){
                                            //set_switchery();
                                        }
                                    );   
                                }
                                $(document).ready(function() {
                                    wish_listed('0');
                                });

                            </script>