<?php
function bs_input_url($name, $value = null, $required = false)
{
    ?>
<div class="form-group">
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">
        <?=__("$name")?>
    </label>
    <div class="col-sm-6">
        <input type="text" name="url[]" placeholder='<?=__("$name")?>' id="<?=$name?>" class="form-control"
            <?=$required ? 'required' : ''?> value="<?=old($name) ?? $value ?? ''?>">
    </div>
</div>

<?php
}

function bs_input($name,$ar_name, $value = null, $required = false)
{
    ?>
<div class="form-group">
    <label class="col-lg-5 control-label" for="<?=$name?>" style="text-align:right">
    <?=$ar_name?>
    </label>
    <div class="col-lg-6">
        <input type="text" name="<?=$name?>" placeholder='<?=$ar_name?>' id="<?=$name?>" class="form-control"
            <?=$required ? 'required' : ''?> value="<?=old($name) ?? $value ?? ''?>">
    </div>
</div>

<?php
}

function bs_tag($name, $value = null, $required = false)
{
    ?>
<div class="form-group">
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">
        <?=__("dashboard.$name")?>
    </label>
    <div class="col-sm-6">
        <input type="text" name="<?=$name?>" placeholder='<?=__("dashboard.$name")?>' id="tags_1" class="form-control tags"
            <?=$required ? 'required' : ''?> value="<?=old($name) ?? $value ?? ''?>">
    </div>
</div>

<?php
}

function bs_disabled($name, $value = null, $required = false)
{
    ?>
<div class="form-group">
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">
        <?=__("dashboard.$name")?>
    </label>
    <div class="col-sm-6">
        <input type="text" name="<?=$name?>" placeholder='<?=__("dashboard.$name")?>' id="<?=$name?>" class="form-control" disabled
            <?=$required ? 'required' : ''?> value="<?=old($name) ?? $value ?? ''?>">
    </div>
</div>

<?php
}

function bs_password($name, $value = null, $required = false, $leave_empty = false)
{
    ?>
<div class="form-group "  >
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">
        <?=__("dashboard.$name")?>
    </label>
    <div class="col-sm-6">
        <input type="password" name="<?=$name?>" placeholder='<?=__("dashboard.$name")?>' id="<?=$name?>" class="form-control tooltips" <?=$leave_empty ? 'data-placement="top" data-original-title="' . __("dashboard.leaveItEmpty") . '"' : ""?>
            <?=$required ? 'required' : ''?> value="<?=old($name) ?? $value ?? ''?>">
    </div>
</div>

<?php
}
function bs_date($name, $value = null, $required = false)
{
    ?>

<div class="form-group">
    <label class="col-lg-4 control-label" for="<?=$name?>" style="text-align:right">
        <?=__("$name")?>
    </label>
    <div class="col-sm-8">
        <input type="date" name="<?=$name?>" placeholder='<?=__("$name")?>' id="<?=$name?>" class="form-control"
            <?=$required ? 'required' : ''?> value='<?=old($name) ?? $value ?? ""?>'>
    </div>
</div>

<?php
}
function bs_number($name, $value = null, $required = false)
{
    ?>

<div class="form-group">
    <label class="col-lg-4 control-label" for="<?=$name?>" style="text-align:right">
        <?=__("$name")?>
    </label>
    <div class="col-sm-6">
        <input type="number" name="<?=$name?>" placeholder='<?=__("$name")?>' id="<?=$name?>" class="form-control"
            <?=$required ? 'required' : ''?> value='<?=old($name) ?? $value ?? ""?>'>
    </div>
</div>

<?php
}
function bs_text($name, $value = null, $required = false)
{
    ?>

<div class="form-group">
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">
        <?=__("dashboard.$name")?>
    </label>
    <div class="col-sm-6">
        <textarea name="<?=$name?>" placeholder='<?=__("dashboard.$name")?>' class="form-control ckeditor" <?=$required ? 'required' : ''?> ><?=old($name) ?? $value ?? ""?></textarea>
    </div>
</div>

<?php
}
function bs_email($name, $value = null, $required = false)
{
    ?>

<div class="form-group">
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">
        <?=__("dashboard.$name")?>
    </label>
    <div class="col-sm-6">
        <input type="email" name="<?=$name?>" placeholder='<?=__("dashboard.$name")?>' id="<?=$name?>" class="form-control"
            <?=$required ? 'required' : ''?> value="<?=old($name) ?? $value ?? ''?>">
    </div>
</div>

<?php
}
function bs_image2($name, $value = null, $required = false)
{
    ?>

<div class="form-group">
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">
        <?=__("dashboard.$name")?>
    </label>
    <div class="col-sm-6">
        <input type="file" accept="image/*" name="image[]" id="<?=$name?>" class="form-control" <?=$required ?
    'required' : ''?> >
    </div>
</div>

<?php if ($value): ?>
<div class="form-group">
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">
    </label>
    <div class="col-sm-6">
        <img src="<?=url('/' . $value)?>" width="50%">
    </div>
</div>
<?php endif;?>

<?php
}

function bs_image($name, $value = null, $required = false)
{
    ?>

<div class="form-group">
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">
        <?=__("dashboard.$name")?>
    </label>
    <div class="col-sm-6">
        <input type="file" accept="image/*" name="<?=$name?>" id="<?=$name?>" class="form-control" <?=$required ?
    'required' : ''?> >
    </div>
</div>

<?php if ($value): ?>
<div class="form-group">
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">
    </label>
    <div class="col-sm-6">
        <img src="<?=url('/' . $value)?>" width="50%">
    </div>
</div>
<?php endif;?>

<?php
}
function bs_video($name, $value = null, $required = false)
{
    ?>

<div class="form-group">
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">
        <?=__("dashboard.$name")?>
    </label>
    <div class="col-sm-6">
        <input type="file" accept="video/*" name="<?=$name?>" id="<?=$name?>" class="form-control" <?=$required ?
    'required' : ''?> >
    </div>
</div>

<?php if ($value): ?>
<div class="form-group">
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">
    </label>
    <div class="col-sm-6">
        <video width="50%" controls>
            <source src="<?=url('/' . $value)?>">
        </video>
    </div>
</div>
<?php endif;?>

<?php
}
function bs_multiple_files($name, $value = null, $required = false)
{
    ?>

<div class="form-group">
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">
        <?=__("dashboard.$name")?>
    </label>
    <div class="col-sm-6">
        <input type="file" accept="video/*" name="<?=$name?>" id="<?=$name?>" class="form-control" <?=$required ?
    'required' : ''?> >
    </div>
</div>



<?php
}

function bs_save($name)
{
    ?>
<div class="form-group">
    <label class="col-sm-1 control-label" for="<?=$name?>" style="text-align:right">

    </label>
    <div class="col-sm-6">
        <button class="btn btn-success" type="submit" style="">
            <?=$name?></button>
    </div>
</div>

<?php
}
function alert_box($type, $value, $with_circle = false)
{
    ?>

<div class="alert alert-<?=$type?>">
    <button data-dismiss="alert" class="close" style="float:left">
        ×
    </button>

    <?php if ($with_circle): ?>

    <i class="fa fa-info-circle"></i> &nbsp;
    <?php endif;?>
    <?=$value?>
</div>


<?php
}
