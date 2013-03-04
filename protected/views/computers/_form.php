<div class="form">

    <?php /** @var $form CActiveForm */
    $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'computers-form',
            'enableAjaxValidation' => true,
            'htmlOptions' => array('class' => 'nice'),
        )
    ); ?>

    <div class="alert-box">Поля отмеченые <span class="highlight">*</span> обязательны к заполнению.</div>

    <?php echo $form->errorSummary($model, null, null, $htmlOptions = array('class' => 'alert-box')); ?>
    <div class="columns five">
        <div class="row">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField(
            $model,
            'name',
            array('size' => 20, 'maxlength' => 20, 'class' => 'input-text')
        ); ?>
            <?php echo $form->error($model, 'name', $htmlOptions = array('class' => 'alert-box error')); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'inventar_number'); ?>
            <?php echo $form->textField($model, 'inventar_number', array('maxlength' => 6, 'class' => 'input-text')); ?>
            <?php echo $form->error($model, 'inventar_number', $htmlOptions = array('class' => 'alert-box error')); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'ip'); ?>
            <?php
            $model->ip = long2ip($model->ip);
            echo $form->textField($model, 'ip', array('maxlength' => 15, 'class' => 'input-text')); ?>
            <?php echo $form->error($model, 'ip', $htmlOptions = array('class' => 'alert-box error')); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'Domain'); ?>
            <?php echo $form->textField(
            $model,
            'Domain',
            array('size' => 60, 'maxlength' => 63, 'class' => 'input-text')
        ); ?>
            <?php echo $form->error($model, 'Domain', $htmlOptions = array('class' => 'alert-box error')); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'Department'); ?>
            <?php
            $this->widget(
                'zii.widgets.jui.CJuiAutoComplete',
                array(
                    'id' => 'Computers_Department',
                    'model' => $model,
                    'name' => 'Computers[Department]',
                    'value' => $model->Department,
                    'source' => $this->createUrl('Computers/SuggestDepartments'),
                    // additional javascript options for the autocomplete plugin
                    'options' => array(
                        'showAnim' => 'fold',
                    ),
                    'htmlOptions' => array('class' => 'input-text'),
                )
            );
            ?>
            <?php echo $form->error($model, 'Department', $htmlOptions = array('class' => 'alert-box error')); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'user'); ?>
            <?php echo $form->textField($model, 'user', array('maxlength' => 100, 'class' => 'input-text')); ?>
            <?php echo $form->error($model, 'user', $htmlOptions = array('class' => 'alert-box error')); ?>
        </div>
    </div>

    <div class="columns five">
        <?php
        if (!$model->isNewRecord) {
            $printers = Printers::model()->findAll('comp_id=' . $model->id);

            echo CHtml::openTag('div', array('class' => ''));
            echo $form->labelEx($model, 'primary_printer');
            echo $form->dropDownList(
                $model,
                'primary_printer',
                array('' => '') + CHtml::listData(
                    Printers::model()->findAll('comp_id=' . $model->id),
                    'id',
                    'printer_name'
                ),
                array('class' => 'input-text')
            );
            echo $form->error($model, 'primary_printer', $htmlOptions = array('class' => 'alert-box error'));
            echo CHtml::closeTag('div');
        } else {
            echo CHtml::openTag('div', array('class' => ''));
            echo $form->labelEx($model, 'primary_printer');
            echo $form->textField($model, 'primary_printer', array('maxlength' => 100, 'class' => 'input-text'));
            echo $form->error($model, 'primary_printer', $htmlOptions = array('class' => 'alert-box error'));
            echo CHtml::closeTag('div');
        }

        echo CHtml::openTag('div', array('class' => ''));

        $cartridgeModel=new Cartridges;
        echo $form->labelEx($cartridgeModel, 'cartridge_name') .
            '<span>Используйте CTRL для выделения нескольких значений</span>';
        if (!empty ($model->primaryPrinter->id)) {
            $cartridges = PrinterCartridge::model()->findAll('id_printer=' . $model->primaryPrinter->id);
        }
        $options = array();
        if (!empty($cartridges)) {
            foreach ($cartridges as $cartridge) {
                $options[$cartridge->id_cartridge] = array('selected' => true);
            }
        }
        echo $form->listBox(
            $cartridgeModel,
            'id',
            CHtml::listData(
                Cartridges::model()->findAll(),
                'id',
                'cartridge_name'
            ),
            array(
                'class' => 'input-text',
                'multiple' => true,
                'size' => 10,
                'empty' => '----- Не выбран -----',
                'options' => $options,
            )
        );
        echo $form->error($model, 'primary_printer', $htmlOptions = array('class' => 'alert-box error'));

        echo CHtml::closeTag('div');
        ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton(
        $model->isNewRecord ? 'Создать' : 'Изменить',
        array('class' => 'button nice white full-width')
    ); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->