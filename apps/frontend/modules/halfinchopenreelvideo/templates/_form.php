<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('halfinchopenreelvideo/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $("#half_inch_open_reel_video_reelSize").multiselect({
            'height':'auto',
            'minWidth':145
        });
       
        
        
    });

    $(function(){
        $("#format_type_off_brand").parents(".row").hide();
        $("#format_type_off_brand").prop('checked', false);
    });
    
</script>