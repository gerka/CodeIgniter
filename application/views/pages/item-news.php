<main class="clearfix page-item-news">
		<div class="container-block">

			<div class="wrapper-item-news">

				<div class="clearfix subtitle-item-news-page">

					<a class="button-base button-back" href="/news/">
						<div>
							Вернуться к списку
						</div>
					</a>

					<h1><?=$item['h1']?></h1>


				</div>
				<div class="content-item-news clearfix">
					<div class="img-item-news"><img src="/images/<?=$item['logo']?>" alt="<?=$item['title']?>"></div>
						<?=$item['body']?>
					</div>
				<div class="wrapper-additionally-info">
					<p class="title-additionally-info">Еще по теме</p>
					<a>Питание</a>
				</div>

			</div>
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
							<img src="/images/thumb/390X255/<?=$value['logo']?>" alt="<?=$value['title']?>">

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