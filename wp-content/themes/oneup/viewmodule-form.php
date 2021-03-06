<?php
/**
 * The template for displaying a form page builder block
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php list($contact,$bid) = $t->template->data(); ?>
<form method="post" class="peThemeContactForm">
	<div class="bay form-horizontal">

		<?php echo $contact->content; ?>
		
<div class="mappa">

<iframe src="https://mapsengine.google.com/map/embed?mid=zqJKKIIR0Ig8.kJK59K_uwJjM" width="340" height="380"></iframe>

</div>
<div class="contatto">	
		<?php foreach ($contact->fields as $field): ?>
		<?php $field = (object) $field; ?>
		<?php $name = esc_attr($field->name); ?>
		<?php $fid = "$name-$bid"; ?>
		<?php $required = empty($field->required) ? "" : "required"; ?>

		<!--name field-->
		<div class="control-group">
			<label for="<?php echo $fid; ?>" class="control-label"><?php echo $field->label; ?></label>
			<div class="controls">
				<?php if ($field->type === "text"): ?>
				<input id="<?php echo $fid; ?>" class="<?php echo $required ?> span9" type="text" name="<?php echo $name; ?>" />
				<?php else: ?>
				<textarea id="<?php echo $fid; ?>" name="<?php echo $name ?>" rows="12" class="<?php echo $required ?> span9"></textarea>
				<?php endif; ?>
				<?php if ($required): ?>
				<span class="help-inline">*</span>
				<?php endif; ?>
			</div>
		</div>
		
		<?php endforeach; ?>
					
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="contour-btn red"><?php echo $contact->submit; ?></button>
			</div>
		</div>
	</div>	
	</div>
						
	<div class="notifications">
		<div id="contactFormSent" class="formSent alert alert-success">
			<?php echo $contact->msgOK; ?>
		</div>	
		<div id="contactFormError" class="formError alert alert-error">
			<?php echo $contact->msgKO; ?>
		</div>
	</div>
	
</form><!--end form-->
