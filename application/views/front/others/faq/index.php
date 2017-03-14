<!-- BREADCRUMBS -->
<section class="page-section breadcrumbs">
    <div class="container">
        <div class="page-header">
            <h2 class="section-title section-title-lg">
                <span>
                    <?php echo translate('frequently_asked_questions');?>
                </span>
            </h2>
        </div>
    </div>
</section>
<!-- /BREADCRUMBS -->

<!-- PAGE -->
<section class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<div class="panel-group accordion" id="faq-accordion" role="tablist" aria-multiselectable="true">
                	<?php
                    	foreach($faqs as $i=>$row){
					?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="faq-heading<?php echo $i; ?>">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#faq-accordion" href="#faq-collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
                                    <span class="dot"></span>
									<?php echo $row['question'] ?>
                                </a>
                            </h4>
                        </div>
                        <div id="faq-collapse<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="faq-heading<?php echo $i; ?>">
                            <div class="panel-body">
                                <?php echo $row['answer'] ?>
                            </div>
                        </div>
                    </div>
                    <?php
						}
					?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->