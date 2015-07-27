<?php use yii\helpers\Html; ?>

<div class="h30"></div>
<h2>
	Все предложения от магазинов
</h2>
<div class="clearfix"></div>
<div class="h130"></div>


<div class="obj-proposals">
	<table class="table_block">
		<?php $i = 0; ?>
		<?php foreach ($data->goods_array as $key => $goods): ?>
			<?php $i++; ?>
			<?php $visible = ($i > 5) ? 'class="additional-proposal  display-none"' : ''; ?>
			<tr <?= $visible ?>>
				<td class="obj-proposals-title">
					<?= $goods->title; ?>
				</td>
				<td class="obj-proposals-shop">
					<div class="obj-proposals-shop-name">
						<?= Html::a($goods->shop_name, 'http://' . $goods->shop_name); ?>
					</div>
					<div class="obj-proposals-shop-contacts">
						<div class="contacts">Контакты:</div>
						<ul>
							<?php if (isset($goods->telephone)): ?>
								<li class="phone">
									<?= $goods->telephone; ?>
								</li>
							<?php endif ?>
							<?php if (isset($goods->email)): ?>
								<li class="email">
									<?= $goods->email; ?>
								</li>
							<?php endif ?>
						</ul>
						<?php if (isset($goods->icq) || isset($goods->skype)): ?>
							<div class="online">Онлайн консультация:</div>
							<ul>
								<?php if (isset($goods->icq)): ?>
									<li class="skype-icq">
										ICQ: <span><?= $goods->icq; ?></span>
									</li>
								<?php endif ?>
								<?php if (isset($goods->skype)): ?>
									<li class="skype-icq">
										Skype: <span><<?= $goods->skype; ?><span>
									</li>
								<?php endif ?>
								<?php if (isset($goods->video)): ?>
									<li class="video-chat">
										<span><<?= $goods->video; ?><span>
									</li>
								<?php endif ?>
								<?php if (isset($goods->chat)): ?>
									<li class="video-chat">
										<span><<?= $goods->chat; ?><span>
									</li>
								<?php endif ?>
							</ul>
						<?php endif ?>
					</div>
				</td>
				<td class="obj-proposals-warehouse">
					<div class="obj-proposals-warehouses">Склады:</div>
					<?php $warehouses = explode(" ", $goods->shop_warehouse); ?>
					<ul>
						<?php foreach ($warehouses as $warehouse): ?>
							<li class="warehous">
								<?= $warehouse; ?>
							</li>
						<?php endforeach ?>
					</ul>
				</td>
				<td class="obj-proposals-shop-price">
					<div class="obj-proposal-price"><?= $goods->price; ?></div>
					<?php if (isset($goods->last_parse)): ?>
					<div class="obj-proposal-price-check">Цена проверена:<br/> <?= $goods->last_parse; ?></div>
					<?php endif ?>
					<div class="obj-proposal-price-site">
						<?= Html::a('Перейти<br/>на сайт', 'http://' . $goods->shop_name); ?>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>

<div class="obj-proposal-display">
	Смотреть все предложения в регионах
</div>

<script type="application/javascript">
	$(document).ready(function () {
		$('.obj-proposal-display').click(function () {
			if ($(".display-none").is(":visible") == true) {
				$(".display-none").hide();
				$(".obj-proposal-display").html('Смотреть все предложения в регионах');
			} else {
				$(".display-none").show();
				$(".obj-proposal-display").html('Скрыть дополнительные предложения в регионах');
			}
		});
	});
</script>

