<?php
echo $this->Html->css('Admin./plugins/iCheck/square/blue');
?>
<!-- Table Responsive Header -->
<ul class="breadcrumb breadcrumb-top">
    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Dashboards', 'action' => 'index']); ?>">Dashboard</a>
    </li>
    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>">Manage Users</a>
    </li>
    <li>Add User</li>
</ul>
<!-- END Table Responsive Header -->

<!-- Responsive Full Block -->
<div class="block">
    <!-- Responsive Full Title -->
    <div class="block-title">
        <h2><strong>Add User</strong></h2>
    </div>
    <!-- END Responsive Full Title -->

    <?php echo $this->Form->create($user, ['id' => 'form-validation']); ?>
    <?php
    echo $this->Form->input('get_location', [
        'type' => 'hidden',
        'id' => 'get_location',
        'value' => '0'
    ]);
    ?>
    <div class="form-group">
        <label for="username">Username</label>
        <div class="form-group">
            <?php
            echo $this->Form->input('username', [
                'type' => 'text',
                'id' => 'username',
                'class' => 'form-control',
                'placeholder' => 'Enter Username',
                'label' => false
            ]);
            ?>
        </div>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <div class="form-group">
            <?php
            echo $this->Form->input('email', [
                'type' => 'email',
                'id' => 'email',
                'class' => 'form-control',
                'placeholder' => 'Enter Email',
                'label' => false
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <div class="form-group">
            <?php
            echo $this->Form->input('password', [
                'type' => 'password',
                'id' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Enter Password',
                'label' => false,
                'value' => ''
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname">First Name</label>
        <div class="form-group">
            <?php
            echo $this->Form->input('firstname', [
                'type' => 'text',
                'id' => 'firstname',
                'class' => 'form-control',
                'placeholder' => 'Enter First Name',
                'label' => false
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="example-nf-password">Last Name</label>
        <div class="form-group">
            <?php
            echo $this->Form->input('lastname', [
                'type' => 'text',
                'id' => 'lastname',
                'class' => 'form-control',
                'placeholder' => 'Enter Last Name',
                'label' => false
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="contact_no">Contact No.</label>
        <div class="form-group">
            <?php
            echo $this->Form->input('contact_no', [
                'type' => 'text',
                'id' => 'contact_no',
                'class' => 'form-control',
                'placeholder' => 'Enter Contact No.',
                'label' => false
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <div class="form-group">
            <?php
            echo $this->Form->input('address', [
                'type' => 'text',
                'id' => 'address',
                'class' => 'form-control',
                'placeholder' => 'Enter Address',
                'label' => false
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="country_id">Select Country</label>
        <div class="form-group">
            <?php
            echo $this->Form->input('country_id', [
                'type' => 'select',
                'id' => 'country_id',
                'options' => $countries,
                'value'=>$selectedCountryId,
                'class' => 'form-control required',
                'label' => false,
                'empty' => true,
                'onchange' => "onChangeLocations()"
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="state_id">Select State</label>
        <div class="form-group">
            <?php
            echo $this->Form->input('state_id', [
                'type' => 'select',
                'id' => 'state_id',
                'options' => $states,
                'value'=>$selectedStateId, 
                'class' => 'form-control required',
                'label' => false,
                'empty' => true,
                'onchange' => "onChangeLocations()"
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label for="city_id">Select City</label>
        <div class="form-group">
            <?php
            echo $this->Form->input('city_id', [
                'type' => 'select',
                'id' => 'city_id',
                'options' => $cities,
                'class' => 'form-control required',
                'label' => false,
                'empty' => true
            ]);
            ?>
        </div>
    </div>
    <?php
    echo $this->Form->input('role_id', [
        'type' => 'hidden',
        'id' => 'role_id',
        
    ]);
   /* echo $this->Form->input('is_active', [
        'type' => 'hidden',
        'id' => 'is_active',
        
    ]);*/
    ?>
<div class="form-group">
        <div class="checkbox icheck">
            <?php
            echo $this->Form->input('is_active', [
                'id' => 'is_active',
                'type' => 'checkbox',
                'class' => 'form-control',
                'label' => ['class' => 'no-padding', 'text' => ' <b>Is Active?</b>', 'escape' => false]
            ]);
            ?>
        </div>
    </div>
    <!--div class="form-group">
        <label for="example-nf-password">Role</label>
        <div class="form-group">
            <select id="val_skill" name="val_skill" class="form-control">
                <option value="">Please select</option>
                <option value="html">Super User</option>                        
                <option value="html">User</option>                        
            </select>
        </div>
    </div-->
    <!--div class="form-group">
        <label for="photo">Photo</label>
        <div class="">
            <?php
            echo $this->Form->input('photo', [
                'type' => 'file',
                'id' => 'photo',
                'class' => '',
                'label' => false
            ]);
            ?>
            <span class="help-block">Ideal size will be 160 x 160 </span>
        </div>
    </div-->
    <div class="form-group form-actions">
        <button type="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-plus"></i> Save
        </button>
        <button type="reset" class="btn btn-sm btn-warning">
            <i class="fa fa-repeat"></i> Reset
        </button>
    </div>
    <?php echo $this->Form->end(); ?>

</div>
<?php echo $this->Html->script('Admin./plugins/iCheck/icheck.min'); ?>
<?php echo $this->Html->script('Admin./plugins/jquery-validation/jquery.validate.min'); ?>
<script>
    $(function(){
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        }); 
        $("#form-validation").validate({
            rules: {
                email: {
                    email: true,
                    remote: "<?php echo $this->Url->build(['prefix' => false, 'controller' => 'common', 'action' => 'checkUniqueEmail', '?' => ['ignore' => $user->id]], true); ?>"
                },
                
                firstname: {
                    lettersonly: true
                }
            },
            messages: {
                email: {
                    remote: "This value is already in use"
                }
            }
        });
    });
    function onChangeLocations(id) {
        if (id == 'country_id') {
            $("#state_id").val("");
        }
        if ($("#country_id").val() || $("#state_id").val()) {
            $("#get_location").val(1);
            $("form")[0].submit();
        } else if ($("#country_id").val() == "" || $("#country_id").val() == null) {
            alert("Please Select Country");
        }
        else if ($("#state_id").val() == "" || $("#state_id").val() == null) {
            alert("Please Select State");
        }
    }
</script>
<!-- END Responsive Full Block -->