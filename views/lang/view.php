<?php
use yii\helpers\Html;

?>
<div id="lang">
	<ul id="langs">
		<?php
		foreach ($langs as $key => $lang) {
			$active = 'non-active';
			$separator = '';
			if ($current == $lang) {
				$active = 'active';
			}
			if ($key) {
				$separator = '<apan class="separator">|</apan>';
			}
			?>
			<li class="item-lang">
				<?= $separator . Html::a($lang, [
					Yii::$app->getRequest()->getLangUrl(),
					'lang' => $lang
				], ['class' => $active]) ?>
			</li>
		<?php } ?>
	</ul>
</div>
