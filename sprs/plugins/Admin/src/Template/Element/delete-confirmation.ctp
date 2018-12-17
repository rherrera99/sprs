<?php 
use Cake\Routing\Router;
?>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Are you sure ?
            </div>
            <div class="modal-body">
                It will flush all the data.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="coconfirm-to_stop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Are you sure to stop this service?</h4>
            </div>
<?php echo $this->Form->create("", ['id' => 'form-validation', 'enctype' => 'multipart/form-data','url'=>['controller' => 'BookingInfo', 'action' => 'index']]); ?>
            <div class="modal-body">
                <div class="row">
                        <input type="hidden" name="id" id="booking_id" />
                        <label class="col-md-3" style="margin-top:10px">Stop Service Date</label>
                        <div class="col-md-4">
                            <?php
                                echo $this->Form->input('stop_date', [
                                    'type' => 'text',
                                    'id' => 'stop_date',
                                    'class' => 'form-control required datepicker',
                                    'placeholder' => 'Select Stop Date',
                                    'label' => false,
                                    'required' => true,
                                    'readonly'=>true
                                ]);
                             ?>
                        </div>
                    
                </div>    
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-ok" type="submit">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
<?php echo $this->Form->end(); ?>    
        </div>
    </div>
</div>

<script type="text/javascript">
	$('#confirm-delete').on('show.bs.modal', function(e) {
	    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	});

        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('#stop_date').datepicker('setDate', today);

        $('.datepicker').datepicker({
            format: 'dd M yyyy',
            endDate: "+0d",
            todayHighlight: true,
        });

        $('.datepicker').each(function() {
            $(this).datepicker("setDate", $(this).val());
        });

        $(".stop_service").click(function() {
            var id = this.id;
            var booking_id = id.split("_");
            $("#booking_id").val(booking_id[2]);
            $("#stop_date").datepicker("setStartDate", $("#start_date_" + booking_id[2]).val());
            $("#coconfirm-to_stop").modal("show");
        })
</script>