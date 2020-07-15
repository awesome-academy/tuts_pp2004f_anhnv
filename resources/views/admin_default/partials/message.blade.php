<div class="message-wrapper">
    <div id="message-modal" class="message fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-content">
            <div class="modal-header"><i class="fa fa-check"></i> Success
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">{{ Session::get('message') }}</div>
        </div>
    </div>
</div>

<script lang="text/javascript">
    $(function(){
        $message = $('#message-modal');
        $message.modal({
            show: true,
            backdrop: false
        });
        setTimeout(function(){
            $message.hide();
        }, 5000);
    })(jQuery);
</script>