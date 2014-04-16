<div class="row">
	<div class="six columns">
		<div class="panel">
			
			<h5>Информация</h5>
			
			<p>
				<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>array(				
						array('label'=>'Компьютеры','url'=>array('/Computers'), 'linkOptions'=>array('class'=>'main')),
						array('label'=>'Сетевое окружение', 'url'=>array('/Computers/scanner'), 'linkOptions'=>array('class'=>'main')),
					),
					'htmlOptions'=>array('class'=>'nav-bar'),
				)); ?>
			</p>
			<div class="row">
				<div class="columns eight">	
					<ul class="tabs-content">
						<li id="simple1Tab" class="active">
							Наименьший объёмом памяти:							
							<p><?php 
								foreach ($topMemory as $id=>$val) {?>
									<div class="row">
										<div class="columns seven"> 
										<?php echo CHtml::link($val['compname'],array('/Computers/view','id'=>$id),array('class'=>'right')); ?>
										</div>
										<div class="columns five">
										<?php echo $val['sizeMemory']?> Мб
										</div>
									</div> <?php									
								} ?>				
							</p>
							
						</li>
						<li id="simple2Tab">
							Наименьшая частота процессора:							
							<p><?php 
								foreach ($topProcessors as $id=>$val) { ?>
									<div class="row">
										<div class="columns seven"> 
										<?php echo CHtml::link($val['compname'],array('/Computers/view','id'=>$id),array('class'=>'right')); ?>
										</div>
										<div class="columns five">
										<?php echo $val['speedProcessors']/1000 ?> Ггц
										</div>
									</div> <?php									
								} ?>				
							</p>
						</li>
					</ul>
				</div>

				<aside class="columns four">
					
					<dl class="tabs DdFloatClear">
						<dd><a href="#simple1" class="active">Память</a></dd>
						<dd><a href="#simple2">Процессор</a></dd>						
					</dl>					
					
				</aside>
			</div>			
			
		</div>		
	</div>
	<div class="six columns">
		<div class="panel">			
			<p><b>Веб сервер: </b></p>
            <p>
            <?php echo php_uname();?></br>		
			<?php
				if (!Yii::app()->user->isGuest) :
					$services = array('http', 'ftp', 'ssh', 'telnet','smtp', 'pop3');
					foreach ($services as $service) {
						$port = getservbyname($service, 'tcp');
						echo $service . ':' . $port . '&nbsp;&nbsp;&nbsp;';
					}
				endif
			?>
			</p>
		</div>
        <div class="panel">
			<h5>Удалённое администрирование</h5>
			<p><b>Выключение и перезагрузка компьютера: </b>
                <form method="POST" action="<?php echo $this->createUrl('Computers/Shotdown') ?>" class="nice">                    
                    <?php 
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        'id'=>'Computers1',
                        'model'=>'Computers',
                        'name'=>'Computers[name]',                        
                        'source'=>$this->createUrl('Computers/FindComputer'),
                        // additional javascript options for the autocomplete plugin
                        'options'=>array(
                                'showAnim'=>'fold',
                                 'minLength'=>'2',
                        ),                        
                        'htmlOptions'=>array('class'=>'input-text left','placeholder'=>'Имя или IP компьютера.'),
                    ));
                    ?>
                    <input type='submit' value="   Выключить   " class="button black nice small" />
                </form>			
                <form method="POST" action="<?php echo $this->createUrl('Computers/Reboot') ?>" class="nice">                    
                    <?php 
                    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                        'id'=>'Computers2',
                        'model'=>'Computers',
                        'name'=>'Computers[name]',                        
                        'source'=>$this->createUrl('Computers/FindComputer'),
                        // additional javascript options for the autocomplete plugin
                        'options'=>array(
                                'showAnim'=>'fold',
                                 'minLength'=>'2',
                        ),                        
                        'htmlOptions'=>array('class'=>'input-text left','placeholder'=>'Имя или IP компьютера.'),
                    ));
                    ?>
                    <input type='submit' value="Перезагрузить" class="button black nice small" />
                </form>
			</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="six columns">
		<div class="panel">
			<h5>Настройки</h5>
			
		</div>
	</div>
	<div class="six columns">
		<div class="panel">
			<h5>Отчёты</h5>
			
		</div>
	</div>
</div>