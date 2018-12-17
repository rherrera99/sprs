<?php
echo $this->Html->css('Admin./plugins/iCheck/square/blue');
echo $this->Html->css('Admin./plugins/croppie/croppie');

/**
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;
?>
<style>
    fieldset{
        border: 1px groove #ddd !important;
        padding: 0 1.4em 0.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
    }
    fieldset legend{
        width: inherit;
        padding: 0 10px;
        border-bottom: none;
    }
</style>
<ul class="breadcrumb breadcrumb-top">
    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Dashboards', 'action' => 'index']); ?>">Dashboard</a>
    </li>
    <li><a href="<?php echo $this->Url->build(['controller' => 'Forms', 'action' => 'index']); ?>">Manage Forms</a></li>
    <li>Edit Form</li>
</ul>
<div class="block">
    <!-- Responsive Full Title -->
    <div class="block-title">
        <h2><strong>Edit Form</strong></h2>
    </div>
    <div class="" id="add_doctor_form">
        <?php echo $this->Form->create($form, ['id' => 'form-validation', 'enctype' => 'multipart/form-data']); ?>

        <div class="row">
            <input type="hidden" id="total_field" name="total_field" value="<?php echo $total_field; ?>">
            <div class="col-xs-12 form-group">
                <label for="" class="col-xs-2">Form Name: </label>
                <div class="form-group col-xs-10">
                    <?php
                    echo $this->Form->input('form_name', [
                        'type' => 'text',
                        'id' => 'form_name',
                        'class' => 'form-control required ',
                        'placeholder' => 'Enter Form Name',
                        'label' => false
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="row" id="div_add_form_details">
            <?php
            // print_r($form['formdetails']);
            for ($i = 0; $i < $total_field; $i++) {
                //debug($request_data);
                // echo $form['formdetails']["field_name_" . ($i + 1)];
                // exit();
                // if (isset($request_data["field_name_" . ($i + 1)]) && isset($request_data["field_type_" . ($i + 1)]) && $request_data["field_name_" . ($i + 1)] && $request_data["field_type_" . ($i + 1)]) {
//                    $formdetail = $this->Formdetails->newEntity();
//                    $formdetail->form_id = $form_last_id->id;
//                    $formdetail->field_name = $request_data["field_name_" . ($i + 1)];
//                    $formdetail->field_type = $request_data["field_type_" . ($i + 1)];
//                    $save_form_details = $this->Formdetails->save($formdetail);
//                    // debug($formdetail);exit();
//                    if (isset($request_data["no_of_options_" . ($i + 1)]) && $request_data["no_of_options_" . ($i + 1)]) {
//                        for ($j = 0; $j < $request_data["no_of_options_" . ($i + 1)]; $j++) {
//                            if (isset($request_data["form_option_" . ($j + 1)]) && $request_data["form_option_" . ($j + 1)]) {
//                                $formoption = $this->Formoptions->newEntity();
//
//                                $formoption->formdetail_id = $save_form_details->id;
//                                $formoption->option_name = $request_data["form_option_" . ($j + 1)];
//                                $save_formoption = $this->Formoptions->save($formoption);
//                            }
//                        }
//                    }
//                }
            }
            $i = 0;
            foreach ($form['formdetails'] as $formdetails) {
                //print_r($formdetails['formoptions']);exit();
                ?>
                <div class="col-md-12" id="field_<?php echo ($i + 1); ?>">
                    <fieldset>
                        <legend>Field <?php echo ($i + 1); ?></legend>
                        <input type="hidden" id="remove_field_id_<?php echo ($i + 1); ?>" name="remove_field_id_<?php echo ($i + 1); ?>" value="<?php echo $formdetails->id; ?>" >
                        <div class="col-md-3">
                            <input type="text" id="field_name_<?php echo ($i + 1); ?>" name="field_name_<?php echo ($i + 1); ?>" value="<?php echo $formdetails->field_name; ?>" class="form-control required valid" placeholder="Enter field name" aria-required="true" aria-invalid="false">
                        </div>

                        <div class="col-md-3">
                            <?php
                            echo $this->Form->input('field_type_' . ($i + 1), [
                                'id' => 'field_type_' . ($i + 1),
                                'type' => 'select',
                                'options' => Configure::read("FIELDS"),
                                'value' => $formdetails->field_type,
                                'class' => 'form-control pull-right',
                                'label' => false,
                                'empty' => 'Select type',
                                'onchange' => "addOptionsForType(this.id, this.value);"
                            ]);
                            ?>
                        </div>
                        <div class="col-md-4">
                            <?php
                            $units = "";
                            if ($formdetails->units) {
                                $units = json_decode($formdetails->units);
                                $units = implode(",", $units);
                            }
                            ?>
                            <input type="text" name="units_<?php echo ($i + 1); ?>" id="units_<?php echo ($i + 1); ?>" class="form-control" placeholder="Enter coma seperated measurement units if required(eg. m,cm)" value="<?php echo $units; ?>" >
                        </div>
    <?php if ($i != 0) { ?>
                            <div class="col-md-2"><button type="button" class="btn btn-default remove_field" style="float:right" id="remove_field_<?php echo $i + 1; ?>" onclick="remove_button(this.id)">Remove</button></div>
                            <?php } ?>

                        <div class="col-md-12" style="padding-top:10px">
                            <input class="input_req" type="checkbox" name="is_required_<?php echo ($i + 1); ?>" id="is_required_<?php echo ($i + 1); ?>" <?php
                               if ($formdetails->is_required == 1) {
                                   echo'checked';
                               }
                            ?>> Compulsory to fill?
                            <input class="input_des" type="checkbox" name="is_dashboard_<?php echo ($i + 1); ?>" id="is_dashboard_<?php echo ($i + 1); ?>" class="is_display_in_tiles" <?php
                               if ($formdetails->is_dashboard == 1) {
                                   echo'checked';
                               }
                            ?>> Is display in dashboard?
                            <input class="input_table" type="checkbox" name="is_table_<?php echo ($i + 1); ?>" id="is_table_<?php echo ($i + 1); ?>" class="is_disply_table_header" <?php
                               if ($formdetails->is_table == 1) {
                                   echo'checked';
                               }
                               ?>> Is display in table?
                        </div>


                        <input type="hidden" id="no_of_options_<?php echo $i + 1; ?>" name="no_of_options_<?php echo $i + 1; ?>" value="<?php echo count($formdetails['formoptions']); ?>">
                        <?php
                        if ($formdetails['formoptions']) {
                            //print_r($formdetails['formoptions']);
                            $j = 1;
                            ?>
                            <div class="row col-md-12" style="padding-top:10px" id="option_details_<?php echo $i + 1; ?>">
        <?php foreach ($formdetails['formoptions'] as $formoptions) {
            ?>



                                    <div class="col-md-12" id="option_div_<?php echo ($i + 1) . "_" . $j; ?>">
                                        <label class="col-md-2">Option <?php echo $j; ?></label>
                                        <div class="col-md-4">

                                            <input type="hidden" name="optiondel_<?php echo ($i + 1) . "_" . $j; ?>" id="optiondel_<?php echo ($i + 1) . "_" . $j; ?>" value="<?php echo $formoptions->id; ?>">
                                            <input type="text" class="form-control valid" name="form_option_<?php echo ($i + 1) . "_" . $j; ?>" id="form_option_<?php echo ($i + 1) . "_" . $j; ?>" value="<?php echo $formoptions->option_name; ?>" placeholder="Enter option" aria-invalid="false">
                                        </div>
                                        <div class="col-md-3">

                                            <button type="button" class="btn btn-primary" id="add_option_<?php echo ($i + 1) . "_" . $j; ?>" style="padding: 2px 6px;border-radius: 50%;" onclick="addOption(this.id)"><i class="fa fa-plus" aria-hidden="true"></i></button>
            <?php if ($j != 1) { ?>
                                                <button type="button" class="btn btn-danger" id="remove_option_<?php echo ($i + 1) . "_" . $j; ?>" style="padding: 2px 6px;border-radius: 50%;" onclick="removeOption(this.id)"><i class="fa fa-times" aria-hidden="true"></i></button>
            <?php } ?>

                                        </div>
                                    </div>




                                <?php
                                $j++;
                            }
                            ?>
                            </div>
    <?php }
    ?> 

                    </fieldset>
                </div>

                <?php
                //print_r($formdetails);exit();
                $i++;
            }
            ?>
        </div>
        <div class="row">
            <div class="col-md-12"><button type="button" class="btn btn-default" id="add_more_form_field">Add more field</button></div>
        </div>

        <input type="hidden" name="remove_field_user" id="remove_field_user" value="">
        <input type="hidden" name="remove_options_user" id="remove_options_user" value="">








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
<script>
    $(function() {
//        $('input').iCheck({
//            checkboxClass: 'icheckbox_square-blue',
//            radioClass: 'iradio_square-blue',
//            increaseArea: '20%' // optional
//        });
        $('.input_des').on('click', function(event) {

            var maxAllowed = 4;

            var cnt = $(".input_des:checked").length;

            if (cnt > maxAllowed)

            {



                // alert('Select maximum ' + maxAllowed + ' technologies!');
                $(this).prop("checked", "");

                alert('Select maximum ' + maxAllowed + ' Display in Dashboard!');



            }

            //alert(this.id);

        });


        $('.input_table').on('click', function(event) {

            var maxAllowed = 5;

            var cnt = $(".input_table:checked").length;

            if (cnt > maxAllowed)

            {

                $(this).prop("checked", "");

                alert('Select maximum ' + maxAllowed + ' Display in Table!');

            }

            //alert(this.id);

        });

        //$("#form-validation").validate();
        $("#form-validation").validate();
    });


</script>

<script>

    var key = <?php echo $total_field; ?>;
    function addFieldInData(key) {
        var fieldHtml = '<div class="col-md-12" id="field_' + key + '">\n\
                                <fieldset>\n\
                                    <legend>Field ' + key + '</legend>\n\
                                       <div class="col-md-3">\n\
                                            <input type="text" id="field_name_' + key + '" name="field_name_' + key + '" class="form-control required" placeholder="Enter field name">\n\
                                       </div>\n\
                                       <div class="col-md-3">\n\
                                            <select  id="field_type_' + key + '" class="form-control required" name="field_type_' + key + '" onChange="addOptionsForType(this.id,this.value)" class="form-control required">\n\
                                                        <option value="0" > Select type</option>';
<?php
$fields = Configure::read("FIELDS");
foreach ($fields as $key => $value) {
    ?>
            fieldHtml += '<option value="<?php echo $key; ?>" ><?php echo $value; ?></option>';
<?php } ?>

        fieldHtml += '</select></div>' +
                '<div class="col-md-4">' +
                '<input type="text" name="units_' + key + '" id="units_' + key + '" class="form-control" placeholder="Enter coma seperated measurement units if required(eg. m,cm)">' +
                '</div>';
        if (key != 1) {
            fieldHtml += '<div class="col-md-2">' +
                    '<button type="button" class="btn btn-default remove_field" style="float:right" id="remove_field_' + key + '" onclick="remove_button(this.id)">Remove</button>' +
                    '</div>';
        }
        fieldHtml += '<div class="col-md-12" style="padding-top:10px">\n\
                                          <input class="input_req" type="checkbox" name="is_required_' + key + '" id="is_required_' + key + '" > Compulsory to fill?\n\
                                          <input class="input_des" type="checkbox" name="is_dashboard_' + key + '" id="is_dashboard_' + key + '" > Is display in dashboard?\n\
                                          <input class="input_table" type="checkbox" name="is_table_' + key + '" id="is_table_' + key + '" class="is_disply_table_header" > Is display in table?\n\
                                       </div>';
        fieldHtml += '<input type="hidden" id="no_of_options_' + key + '" name="no_of_options_' + key + '" value="0"><div class="row col-md-12" style="padding-top:10px" id="option_details_' + key + '">\n\
                                       </div>\n\
                                </fieldset>\n\
                        </div>';
        $("#total_field").val(key);

        console.log(key);
        $("#div_add_form_details").append(fieldHtml);
        radiodesign();

    }
    $('document').ready(function() {
        //addFieldInData(key);
    });
    $("#add_more_form_field").click(function() {
        key = key + 1;
        addFieldInData(key);
    })
    function remove_button(id) {

        var id_split = id.split("_");
        var remove_field_Id = $('#remove_field_id_' + id_split[2]).val();
        $("#field_" + id_split[2]).remove();
        // alert('#remove_field_id_'+id_split[2]);
        if (remove_field_Id) {
            var value = new Array();
            if ($("#remove_field_user").val() == '') {
                $("#remove_field_user").val(remove_field_Id);
            } else {
                value = $("#remove_field_user").val();

                $("#remove_field_user").val(value + ',' + remove_field_Id);
            }
        }
        //key=key-1;
        //$("#total_field").val(key);
    }

    function addOptionsForType(id, selected_type) {


        var id_split = id.split("_");
        var option_html = "";
        var optionNo = $("#no_of_options_" + id_split[2]).val();
        if (selected_type == 4 || selected_type == 5 || selected_type == 6) {
            var remove_button = "";
            var add_button = "";
            if ((parseInt(optionNo) + 1) != 1) {
                remove_button += "<button type='button' class='btn btn-danger' id='remove_option_" + id_split[2] + "_" + (parseInt(optionNo) + 1) + "' style='padding: 2px 6px;border-radius: 50%;' onClick='removeOption(this.id)'><i class='fa fa-times' aria-hidden='true'></i></button>";
            }
            add_button += "<div class='col-md-3'><button type='button' class='btn btn-primary' id='add_option_" + id_split[2] + "_" + (parseInt(optionNo) + 1) + "' style='padding: 2px 6px;border-radius: 50%;' onClick='addOption(this.id)'><i class='fa fa-plus' aria-hidden='true'></i></button>" + remove_button + "</div>";
            option_html += "<div class='col-md-12' id='option_div_" + id_split[2] + "_" + (parseInt(optionNo) + 1) + "'><label class='col-md-2'>Option " + (parseInt(optionNo) + 1) + "</label><div class='col-md-4'><input type='text' class='form-control' name='form_option_" + id_split[2] + "_" + (parseInt(optionNo) + 1) + "' id='form_option_" + id_split[2] + "_" + (parseInt(optionNo) + 1) + "' placeholder='Enter option'/></div>" + add_button + remove_button + "</div>";

            $("#option_details_" + id_split[2]).append(option_html);
            $("#no_of_options_" + id_split[2]).val((parseInt(optionNo) + 1));

        } else {
            $("#option_details_" + id_split[2]).html("");
        }

    }

    function addOption(id) {
        var id_split = id.split("_");
        var no_of_option = $("#no_of_options_" + id_split[2]).val();
        var remove_button = "";
        var add_button = "";
        if ((parseInt(no_of_option) + 1) != 1) {
            remove_button += "<button type='button' class='btn btn-danger' id='remove_option_" + id_split[2] + "_" + (parseInt(no_of_option) + 1) + "' style='padding: 2px 6px;border-radius: 50%;' onClick='removeOption(this.id)'><i class='fa fa-times' aria-hidden='true'></i></button>";
        }
        add_button += "<div class='col-md-3'><button type='button' class='btn btn-primary' id='add_option_" + id_split[2] + "_" + (parseInt(no_of_option) + 1) + "' style='padding: 2px 6px;border-radius: 50%;' onClick='addOption(this.id)'><i class='fa fa-plus' aria-hidden='true'></i></button>" + remove_button + "</div>";
        var new_option_html = "<div class='col-md-12' id='option_div_" + id_split[2] + "_" + (parseInt(no_of_option) + 1) + "'><label class='col-md-2'>Option " + (parseInt(no_of_option) + 1) + "</label><div class='col-md-4'><input type='text' class='form-control' name='form_option_" + id_split[2] + "_" + (parseInt(no_of_option) + 1) + "' id='form_option_" + id_split[2] + "_" + (parseInt(no_of_option) + 1) + "' placeholder='Enter option'/></div>" + add_button + "</div>";
        $("#option_details_" + id_split[2]).append(new_option_html);
        $("#no_of_options_" + id_split[2]).val((parseInt(no_of_option) + 1));

    }
    function removeOption(id) {
        var id_split = id.split("_");
        var no_of_option = $("#no_of_options_" + id_split[2]).val();

        var optiondel = $('#optiondel_' + id_split[2] + "_" + id_split[3]).val();

        $("#option_div_" + id_split[2] + "_" + id_split[3]).remove();

        if (optiondel) {
            var value = new Array();
            if ($("#remove_options_user").val() == '') {
                $("#remove_options_user").val(optiondel);
            } else {
                value = $("#remove_options_user").val();

                $("#remove_options_user").val(value + ',' + optiondel);
            }
        }
        //alert(id_split[2] + "_" + id_split[3]);


        //remove_option_5_2
        //$("#no_of_options_"+id_split[2]).val((parseInt(no_of_option)-1));
    }

    function radiodesign() {

//        $('input').iCheck({
//            checkboxClass: 'icheckbox_square-blue',
//            radioClass: 'iradio_square-blue',
//            increaseArea: '20%' // optional
//        });

        $('.input_des').on('click', function(event) {

            var maxAllowed = 4;

            var cnt = $(".input_des:checked").length;

            if (cnt > maxAllowed)

            {



                // alert('Select maximum ' + maxAllowed + ' technologies!');
                $(this).prop("checked", "");

                alert('Select maximum ' + maxAllowed + ' Display in Dashboard!');



            }

            //alert(this.id);

        });


        $('.input_table').on('click', function(event) {

            var maxAllowed = 5;

            var cnt = $(".input_table:checked").length;

            if (cnt > maxAllowed)

            {

                $(this).prop("checked", "");

                alert('Select maximum ' + maxAllowed + ' Display in Table!');

            }

            //alert(this.id);

        });

    }

</script>
