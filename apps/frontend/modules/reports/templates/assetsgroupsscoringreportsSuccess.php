Recording Date Report
<br/><br/>
<?php
echo $NoRecordFound = get_slot('my_slot');
?>

<form action="<?php echo url_for('reports/assetsgroupsscoringreports') ?>" method="post">
    <span ><?php echo $form['listUnits_RRD']->renderLabel(); ?></span>
    <br/>
    <br/>
    <?php echo $form['listUnits_RRD']->render(); ?>
    <br/>
    <br/>
    <br/>
    <span><?php echo $form['format_id']->renderLabel(); ?></span>
    <br/>
    <br/>
    <?php echo $form['format_id']->render(); ?>
    <br/>
    <br/>
    <br/>
    <span><?php echo $form['ExportType']->renderLabel(); ?></span>
    <br/>
    <br/>
    <?php echo $form['ExportType']->render(); ?>
    <br/>
    <br/>
    <input type="submit" value="Export" />
</form>

<script type="text/javascript">
    $('#reports_listUnits_RRD').multiselect({
        'height':'auto',
        'multiple':true,
        'height':200
    });
    $('#reports_format_id').multiselect({
        'height':'auto',
        'multiple':true,
        'height':200
        
    });
    
    $('#reports_collectionStatus').multiselect({
        'height':'auto',
        'multiple':true
    });
  
</script>