<div>
    <?php
		echo form_open(base_url() . 'index.php/admin/language_settings/do_add_word/' . $lang, array(
			'class' => 'form-horizontal',
			'method' => 'post',
			'id' => 'word_add'
		));
	?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="word"><?php echo translate('new_word');?></label>
                <div class="col-sm-6">
                    <input type="text" name="word" id="word" class="form-control required" placeholder="<?php echo translate('new_word'); ?>" >
                </div>
            </div>
        </div>
	</form>
</div>

<div style="display:none;">
    <div id="checker"></div>
</div>

<script type="text/javascript">
    $('body').on('keyup', '#word', function() {
        var word = $('#word').val();
        ajax_load(base_url + 'index.php/' + user_type + '/' + module + '/check_existed/' + word, 'checker', 'other');
    });

    function other() {
        var mark = $('#checker').html();
        if (mark == 1) {
            $('#checker').closest('.modal-content').find('.modal-footer').find('.btn-purple').attr("disabled", "disabled");
            $('#word').closest('div').append('<span style="color:red;">* <?php echo translate('already_exists!'); ?></span>');
        } else if (mark == 0) {
            $('#checker').closest('.modal-content').find('.modal-footer').find('.btn-purple').removeAttr("disabled");
            $('#word').closest('div').find('span').remove();
        }
    }
    $(document).ready(function() {
        $("form").submit(function(e) {
            return false;
        });
    });
</script>

