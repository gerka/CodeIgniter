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
<script type="text/javascript">console.log(<?=json_encode($news_new_tag)?>)</script>
	<main class="clearfix page-news">
		<div class="container-block">
			<h1>Журнал</h1>

			<div class="wrapper-articles">


	<div class="clearfix subtitle-news-page">
					<h2><?=$news_new_tag['value']?></h2>
					
				</div>
				<div class="theme-wrapper">
					
					

				</div>
				<div class="articles-box clearfix">
				<?php if (!empty($news_new_tag['news'])): ?>
						<?php foreach ($news_new_tag['news'] as $key2 => $valueNews): ?>
					<?
					$newdate = $valueNews['date_create'];

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



		</div>
	</main>