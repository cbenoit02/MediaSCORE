<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('characteristicsconstraints/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('characteristicsconstraints/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'characteristicsconstraints/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['constraint_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['constraint_name']->renderError() ?>
          <?php echo $form['constraint_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['constraint_value']->renderLabel() ?></th>
        <td>
          <?php echo $form['constraint_value']->renderError() ?>
          <?php echo $form['constraint_value'] ?>
        </td>
      </tr>
<!--      <tr>
        <th><?php // echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php // echo $form['created_at']->renderError() ?>
          <?php // echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php // echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php // echo $form['updated_at']->renderError() ?>
          <?php // echo $form['updated_at'] ?>
        </td>
      </tr>-->
    </tbody>
  </table>
</form>
