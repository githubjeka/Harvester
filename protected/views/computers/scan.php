<?php
$this->breadcrumbs=array(
	'Компьютеры'=>array('index'),
	'Сеть',
);

$this->menu=array(
	array('label'=>'Создать компьютер', 'url'=>array('create')),
	array('label'=>'Управление БД', 'url'=>array('admin')),		
	array('label'=>'Cканировать', 'url'=>'#', 'linkOptions'=>array(
		'onclick'=>'$("#mydialog").dialog("open"); return false;'
	)),		
);
?>


<div class="row">
	<h4>Онлайн (<?php echo $online; ?>)</h4>
	<div class="alert-box">
		Здесь отображены компьютеры, которые сейчас подключены в сеть с сервером (Зелёным отмечены компьютеры, которые отсутствуют в базе данных).<br/> Выберите компьютер, чтобы получить данные о нём. Если нужно просканировать несколько одновременно компьютеров, нажмите "Cканировать" на панели операций.	
	</div>
</div>

<div class="row">
<?php	
	foreach ($DomainWithComp as $DomainName=>$ArrayComp) { ?>		 
		<h5><?php echo $DomainName.' ('.count($ArrayComp).')';	?> </h5>
		<p class="button white "><?
		foreach ($ArrayComp as $CompName) {			
			$temp=FALSE;
			foreach ($NotBDComputers as $NotBDC) {				
				if ($NotBDC==$CompName){
					$temp=TRUE;
				}				
			}
			if ($temp) {
				echo CHtml::link($CompName,array('/Computers/ScanComputer','name'=>$CompName),$htmlOptions=array('class'=>'button nice green'));
			} else {
				echo CHtml::link($CompName,array('/Computers/ScanComputer','name'=>$CompName),$htmlOptions=array('class'=>'button nice'));
			}
			$Computers[]=$CompName;
		} ?>		
		</p> <?php
	}	 
?>
</div>

<p>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
							'id'=>'mydialog',
							// additional javascript options for the dialog plugin
							'options'=>array(
							'title'=>'Сканирование всех компьютеров',
							'minWidth'=>600,
							'minHeight'=>250,
							'autoOpen'=>false,
							'draggable'=>false,
							'resizable'=>false,
							'modal'=>true,
							),
		)); ?>
	<p>Во время сканирования <b>не перезагружайте и не закрывайте</b> страницу.</p>
	<p>В зависимости от количества доступных компьютеров - процесс может занять несколько минут.</p>
	<p>Чтобы начать сканирование всех  компьютеров (<?php echo count($Computers) ?> шт.) нажмите	<a id="GoScanAll" class="label white" href="#">начать</a>. </p>
	<p>Также есть возможность просканировать только те компьютеры, которых нет в базе данных (<?php echo count($NotBDComputers) ?> шт.). Для этого нажмите <a id="GoScan" class="label white" href="#">тут</a>	</p>
	
	<?php $this->widget('zii.widgets.jui.CJuiProgressBar', array(
	'htmlOptions'=>array(
	'style'=>'height:22px;',
	'id' => 'bar',
	),
	));?>
		
	<p id="Comment">Проверенно: <span id="count"></span></p>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</p>

<?php
$ComputersAll=json_encode($Computers); 
$NotBDComputers=json_encode($NotBDComputers); 
Yii::app()->clientScript->registerScript('IndexScript2', <<<Script
	
	$('a.button').width(100);
	
	var recursionStack
	var lengthStack
	$('#bar').hide(); 
	$('#Comment').hide(); 
	
	function postFunction() {
		$('#bar').progressbar("value", 100) 
		$('#count').text(lengthStack+' из '+lengthStack);
		alert("Успешно закончено");
		$('#bar').hide();
		$('#Comment').hide();
	}

	function recursionFunc(postFunc) {
		if (recursionStack.length<=0){
			eval(postFunc);
			return;
		}

		jQuery.ajax({					
			'cache':false,				
			'url':'/inventar/index.php?r=computers/ScanComputer&name='+recursionStack[0],		
			'complete':function (){
				recursionStack.splice(0, 1);
				recursionFunc(postFunc);
				$('#bar').progressbar("value", Math.ceil(100-recursionStack.length*100/lengthStack)); 
				$('#count').text(lengthStack-recursionStack.length+' из '+lengthStack);
			},
		});	
	}

	jQuery(function($) {
		$('body').on('click','#GoScanAll',function(){
			$('#bar').show();
			$('#Comment').show();
			$('#bar').progressbar("value", 2); 
			recursionStack = JSON.parse('$ComputersAll');
			lengthStack=recursionStack.length;
			recursionFunc("postFunction();");			
			return false;
		});
	});	

	jQuery(function($) {
		$('body').on('click','#GoScan',function(){
			$('#bar').show(); 
			$('#Comment').show(); 
			$('#bar').progressbar("value", 2);
			recursionStack = JSON.parse('$NotBDComputers');
			lengthStack=recursionStack.length;
			recursionFunc("postFunction();");			
			return false;
		});
	});	
Script
);
?>