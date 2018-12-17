<?php
echo $this->Html->css('Admin./plugins/iCheck/square/blue');
echo $this->Html->css('Admin./plugins/croppie/croppie');

/**
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;
?>
<style>

</style>
<ul class="breadcrumb breadcrumb-top">
    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Dashboards', 'action' => 'index']); ?>">Dashboard</a>
    </li>
    <li><a href="<?php echo $this->Url->build(['controller' => 'Patients', 'action' => 'index']); ?>">Manage Patients</a></li>
    <li>Edit Patients</li>
</ul>
<div class="block">
    <!-- Responsive Full Title -->
    <div class="block-title">
        <h2><strong>Edit Patients</strong></h2>
    </div>
    <div class="" id="add_doctor_form">
        <?php echo $this->Form->create($patient, ['id' => 'form-validation', 'enctype' => 'multipart/form-data']); ?>
        <input type="hidden" id="crop_image_hidden" name="crop_image_hidden">
        <div class="row">
            <div class="col-xs-12 form-group" >
                <label for="" class="col-xs-3">Upload profile pic : </label>

                <div class="form-group col-xs-6">
                    <?php
                    echo $this->Form->input('profile_pic_upload', [
                        'type' => 'file',
                        'id' => 'profile_pic_upload',
                        'class' => 'form-control  ',
                        'label' => false
                    ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <div id="upload-demo-i"></div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group" >
                <label for="" class="col-xs-3">Name </label>

                <div class="form-group col-xs-4">
                    <?php
                    echo $this->Form->input('first_name', [
                        'type' => 'text',
                        'id' => 'first_name',
                        'class' => 'form-control required ',
                        'placeholder' => 'Enter first name',
                        'label' => false
                    ]);
                    ?>
                </div>
                <div class="form-group col-xs-4">
                    <?php
                    echo $this->Form->input('last_name', [
                        'type' => 'text',
                        'id' => 'last_name',
                        'class' => 'form-control required ',
                        'placeholder' => 'Enter last name',
                        'label' => false
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label for="" class="col-xs-3">Date Of Birth: </label>
                <div class="form-group col-xs-9">
                    <?php
                    echo $this->Form->input('dob', [
                        'type' => 'text',
                        'id' => 'dob',
                        'class' => 'form-control datetimepicker ',
                        'placeholder' => 'Enter Date-of-Birth',
                        'label' => false
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label for="" class="col-xs-3">Username: </label>
                <div class="form-group col-xs-9">
                    <?php
                    echo $this->Form->input('username', [
                        'type' => 'text',
                        'id' => 'username',
                        'class' => 'form-control required ',
                        'placeholder' => 'Enter username',
                        'label' => false
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 form-group">
                <label for="" class="col-xs-3">Password: </label>
                <div class="form-group col-xs-9">
                    <?php
                    echo $this->Form->input('password', [
                        'type' => 'password',
                        'id' => 'password',
                        'class' => 'form-control required ',
                        'placeholder' => 'Enter password',
                        'label' => false
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label for="" class="col-xs-3">Email: </label>
                <div class="form-group col-xs-9">
                    <?php
                    echo $this->Form->input('email', [
                        'type' => 'text',
                        'id' => 'email',
                        'class' => 'form-control required ',
                        'placeholder' => 'Enter email',
                        'label' => false
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label for="" class="col-xs-3">Contact no: </label>
                <div class="form-group col-xs-9">
                    <?php
                    echo $this->Form->input('contact_no', [
                        'type' => 'text',
                        'id' => 'contact_no',
                        'class' => 'form-control required ',
                        'placeholder' => 'Enter contact no',
                        'label' => false
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label for="gender" class="col-xs-3">Gender</label>
                <div class="form-group col-xs-9">
                    <?php
                    echo $this->Form->input('gender', [
                        'type' => 'radio',
                        'id' => 'gender',
                        'class' => 'form-control required ',
                        'label' => false,
                        'options' => Configure::read("GENDER")
                    ]);
                    ?>
                    <label id="gender-error" class="error" for="gender"></label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label for="" class="col-xs-3">Height</label>
                <div class="form-group col-xs-9">
                    <?php
                    echo $this->Form->input('height', [
                        'type' => 'text',
                        'id' => 'height',
                        'class' => 'form-control required ',
                        'placeholder' => 'Enter Height',
                        'label' => false
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label for="" class="col-xs-3">Weight</label>
                <div class="form-group col-xs-9">
                    <?php
                    echo $this->Form->input('weight', [
                        'type' => 'text',
                        'id' => 'weight',
                        'class' => 'form-control required ',
                        'placeholder' => 'Enter Weight In kg',
                        'label' => false
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label for="" class="col-xs-3">Address</label>
                <div class="form-group col-xs-9">
                    <?php
                    echo $this->Form->input('address', [
                        'type' => 'textarea',
                        'id' => 'address',
                        'rows' => 3,
                        'class' => 'form-control required ',
                        'placeholder' => 'Enter address',
                        'label' => false
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 form-group">
                <label for="" class="col-xs-3">About you</label>
                <div class="form-group col-xs-9">
                    <?php
                    echo $this->Form->input('about', [
                        'type' => 'textarea',
                        'id' => 'about',
                        'rows' => 3,
                        'class' => 'form-control',
                        'placeholder' => 'Write something about you',
                        'label' => false
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="checkbox icheck">
                <?php
                echo $this->Form->input('status', [
                    'id' => 'status',
                    'type' => 'checkbox',
                    'class' => 'form-control',
                    'label' => ['class' => 'no-padding', 'text' => ' <b>Status</b>', 'escape' => false]
                ]);
                ?>
            </div>
        </div>
        <div class="col-xs-offset-2 form-group form-actions">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i> Save
            </button>

        </div>
        <?php echo $this->Form->end(); ?>
    </div>


</div>

<div class="modal fade" id="crop_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="upload-demo" style="width:350px"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" id="crop_image_button">Crop</a>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->script('Admin./plugins/iCheck/icheck.min'); ?>
<?php echo $this->Html->script('Admin./plugins/jquery-validation/jquery.validate.min'); ?>
<?php echo $this->Html->script('Admin./plugins/croppie/croppie'); ?>
<?php echo $this->Html->script('Admin./plugins/jquery-validation/additional-methods.min'); ?>
<?php echo $this->Html->css('Admin./plugins/eonasdanbootstrapdatetimepicker/css/bootstrap-datetimepicker.min'); ?>
<?php echo $this->Html->script('Admin./plugins/eonasdanbootstrapdatetimepicker/js/bootstrap-datetimepicker.min'); ?>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyClHcXgT1Q_ynPKBiGV7b93nFZJl0zSt6g&libraries=places"></script>
<script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
        //$("#form-validation").validate();
                   jQuery.validator.addMethod("phoneno", function(phone_number, element) {
    	    phone_number = phone_number.replace(/\s+/g, "");
    	    return this.optional(element) || phone_number.length > 9 && 
    	    phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
    	}, "<br />Please specify a valid phone number");
        $("#form-validation").validate({
            rules: {
                first_name: {lettersonly: true},
                last_name: {lettersonly: true},
                //password : {maxlength: 15},
                contact_no: {maxlength: 15,phoneno:true},
                email:{email:true}
            }
        });
        initAutocomplete('address');
    });
    $(function() {

        $('#dob ').datetimepicker({
            format: 'MM/DD/YYYY',
            useCurrent: true,
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
        });


    });
        function initAutocomplete(id) {
                var placeSearch, autocomplete;
                // Create the autocomplete object, restricting the search to geographical
                // location types.
                autocomplete = new google.maps.places.Autocomplete(
                        /** @type {!HTMLInputElement} */(document.getElementById(id)),
                        {types: []});
                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    fillInAddress(id, autocomplete)
                });
            }

            function fillInAddress(id, autocomplete) {
                // Get the place details from the autocomplete object.

                var place = autocomplete.getPlace();
                console.log(JSON.stringify(place) + " " + id);
                if (place.geometry != undefined) {
                    $('#' + id + '_lat').val(place.geometry.location.lat());
                    $('#' + id + '_long').val(place.geometry.location.lng());
                }
                if (id != 'address') {
                    var id_split = id.split("_");
                    if (place.name != undefined) {
                        $("#title_" + id_split[1]).val(place.name);
                    }
                }

            }
</script>
<script type="text/javascript">
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });


//    $('#profile_pic').on('change', function() {
//        $("#crop_image").modal('show');
//        var reader = new FileReader();
//        reader.onload = function(e) {
//            $uploadCrop.croppie('bind', {
//                url: e.target.result
//            }).then(function() {
//                console.log('jQuery bind complete');
//            });
//
//        }
//        reader.readAsDataURL(this.files[0]);
//    });


    $('#crop_image_button').on('click', function(ev) {
        $("#crop_image").modal('hide');
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(resp) {
            $("#crop_image_hidden").val(resp);
            var html = '<img src="' + resp + '" style="height:100px;width:100px"/>';
            $("#upload-demo-i").html(html);


        });
    });


</script>

