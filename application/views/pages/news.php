	<!-- Begin Хлебные крошки -->
<!-- <ol class="breadcrumb">
<?php if (!empty($breadCrumb)): ?>
	<?php foreach ($breadCrumb as $key => $value): ?>
		<li <?=(!empty($value['class'])) ? 'class="'.$value['class'].'"' : '' ;?>><a href="<?=(!empty($value['link'])) ? $value['link'] : '#'?>"><?=(!empty($value['text'])) ? $value['text'] : '#'?></a></li>
	<?php endforeach ?>
<?php endif ?>
	</ol> -->
<!-- End Хлебные крошки -->
<script type="text/javascript">console.log(<?=json_encode($news_new)?>)</script>
	<main class="clearfix page-news">
		<div class="container-block">
			<h1>Журнал</h1>

			<div class="wrapper-articles">

<?php foreach ($news_new as $key => $value): ?>
	<div class="clearfix subtitle-news-page">
					<h2><?=$value['h1']?></h2>
					
				</div>
				<div class="theme-wrapper">
					<p class="theme-title">Выбрать по тегам:</p>

					<?php if (!empty($value['news'])): ?>
						<?php foreach ($value['news'] as $key2 => $valueNews): ?>
							<?php if (!empty($valueNews['tags'])): ?>
							<?php foreach ($valueNews['tags'] as $key3 => $valueTags): ?>
							<p class="theme-item"><a href="/news/tag/<?=$valueTags['alias']?>"><?=$valueTags['value']?></a></p>
						<?php endforeach ?>
						
						
					<?php endif ?>
					<?php endforeach ?>
					<?php endif ?>
					

				</div>
				<div class="articles-box clearfix">
				<?php if (!empty($value['news'])): ?>
					
						<?php foreach ($value['news'] as $key2 => $valueNews): ?>
					<?
					$newdate = $valueNews['date_create'];

					$date_explode = explode(" ", $newdate);
					if(!empty($date_explode[1])){
					$date = explode("-", $date_explode[0]);
					$time = explode(":", $date_explode[1]);

					$year = $date[0];
					$day = $date[1];
					$month = $date[2];

					$hours = $time[0];
					$minutes = $time[1];
					$seconds = $time[2];
				}
				else{
					$date_explode = explode("/", $newdate);
					$month = $date_explode[0];
					$day = $date_explode[1];
					$year = $date_explode[2];
				}
					?>
					<div class="wrapper-item-article">
						<div class="box-preview-article">
							<img src="/images/thumb/480X259/<?=$valueNews['logo']?>" alt="<?=$valueNews['title']?>">

							<div class="wrapper-theme-date clearfix">
								<p class="theme-item-preview">Статьи / События</p>

								<p class="date-item-preview"><?=$day?>/<?=$month?>/<?=$year?></p>
							</div>
							<h3 class="title-item-preview"><a href="/<?=$lang.'/'.$valueNews['alias']?>"><?=$valueNews['h1']?></a></h3>

							<div class="description-item-preview">
								<p><?=$retVal = (strlen($valueNews['preview_text'])>=100) ? substr($valueNews['preview_text'], 0, 100).'...' : $valueNews['preview_text'] ?></p>
								<a class="button-read-full" href="/<?=$lang.'/'.$valueNews['alias']?>">Читать далее</a>
							</div>
						</div>
					</div>
					<?php endforeach ?>
			<?php endif ?>
					
				</div>
			</div>
<?php endforeach ?>

<?php if (!empty($otherNews)): ?>
			<div class="wrapper-blog">

				<div class="clearfix subtitle-news-page">
					<h2>Также вас может заинтересовать:</h2>
					<!-- <a class="button-base button-subtitle">
						<div>
							Посмотреть все
						</div>
					</a> -->
				</div>
				<div class="articles-box clearfix">
				<?php foreach ($otherNews as $key => $value): ?>
					<?
					$newdate = $value['date_create'];

					$date_explode = explode(" ", $newdate);

					$date = explode("-", $date_explode[0]);
					$time = explode(":", $date_explode[1]);

					$year = $date[0];
					$day = $date[1];
					$month = $date[2];

					$hours = $time[0];
					$minutes = $time[1];
					$seconds = $time[2];
					?>
					<div class="wrapper-item-article">
						<div class="box-preview-article">
							<img src="/images/thumb/480X259/<?=$value['logo']?>" alt="<?=$value['title']?>">

							<div class="wrapper-theme-date clearfix">
								<p class="theme-item-preview">Блоги / Личный опыт</p>

								<p class="date-item-preview"><?=$day?>/<?=$month?>/<?=$year?></p>
							</div>
							<h3 class="title-item-preview"><a href="/<?=$lang.'/'.$value['alias']?>"><?=$value['h1']?></a></h3>

							<div class="description-item-preview">
								<?=$retVal = (strlen($value['preview_text'])>=100) ? substr($value['preview_text'], 0, 100).'...' : $value['preview_text'] ?>
							</div>
						</div>
					</div>
					<?endforeach;?>
				</div>
			</div>
		<?php endif ?>
		</div>
	</main>