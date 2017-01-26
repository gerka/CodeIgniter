	<!-- Begin Хлебные крошки -->
<!-- <ol class="breadcrumb">
<?php if (!empty($breadCrumb)): ?>
	<?php foreach ($breadCrumb as $key => $value): ?>
		<li <?=(!empty($value['class'])) ? 'class="'.$value['class'].'"' : '' ;?>><a href="<?=(!empty($value['link'])) ? $value['link'] : '#'?>"><?=(!empty($value['text'])) ? $value['text'] : '#'?></a></li>
	<?php endforeach ?>
<?php endif ?>
	</ol> -->
<!-- End Хлебные крошки -->
<script type="text/javascript">console.log(<?=json_encode($news)?>)</script>
	<main class="clearfix page-news">
		<div class="container-block">
			<h1>Журнал</h1>

			<div class="wrapper-articles">

				<div class="clearfix subtitle-news-page">
					<h2><?=$item['value']?></h2>
					<a class="button-base button-subtitle" href="/news">
						<div>
							Посмотреть все
						</div>
					</a>

				</div>
				<div class="theme-wrapper">
					<p class="theme-title">Выбрать по темам:</p>
					<?php if (!empty($News_cats)): ?>
						<?php foreach ($News_cats as $key => $value): ?>
							<p class="theme-item"><a href="<?=$value['alias']?>"><?=$value['h1']?></a></p>
						<?php endforeach ?>
					<?php endif ?>
					

				</div>
				<div class="articles-box clearfix">
				<?php if (!empty($news)): ?>
				
				<?php foreach ($news as $key1 => $value1): ?>
					<?php if (!empty($value1['news'])): ?>
						
					
					<?php foreach ($value1['news'] as $key => $value): ?>
						
					
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
							<img src="/images/<?=$value['logo']?>" alt="<?=$value['title']?>">

							<div class="wrapper-theme-date clearfix">
								<p class="theme-item-preview"><?=$value1['cat']?></p>

								<p class="date-item-preview"><?=$day?>/<?=$month?>/<?=$year?></p>
							</div>
							<h3 class="title-item-preview"><a href="/<?=$value['alias']?>"><?=$value['news']?></a></h3>

							<div class="description-item-preview">
								<p><?=$retVal = (strlen($value['preview_text'])>=100) ? substr($value['preview_text'], 0, 100).'...' : $value['preview_text'] ?></p>
								<a class="button-read-full" href="/<?=$value['alias']?>">Читать далее</a>
							</div>
						</div>
					</div>
					<?php endforeach ?>
					<?php endif ?>
					<?php endforeach ?>
			<?php endif ?>
					
				</div>
			</div>

			<!-- <div class="wrapper-blog">

				<div class="clearfix subtitle-news-page">
					<h2>Блоги</h2>
					<a class="button-base button-subtitle">
						<div>
							Посмотреть все
						</div>
					</a>
				</div>
				<div class="theme-wrapper">
					<p class="theme-title">Выбрать:</p>

					<p class="theme-item"><a href="#">Интервью</a></p>

					<p class="theme-item"><a href="#">Личный опыт</a></p>

				</div>
				<div class="articles-box clearfix">
					<div class="wrapper-item-article">
						<div class="box-preview-article">
							<img src="image/preview-example.png" alt="статья">

							<div class="wrapper-theme-date clearfix">
								<p class="theme-item-preview">Блоги / Личный опыт</p>

								<p class="date-item-preview">19 сентября 2016</p>
							</div>
							<h3 class="title-item-preview"><a href="#">Ежегодный фестиваль кундалини-йоги</a></h3>

							<div class="description-item-preview">
								<p>До нашего прекрасного Фестиваля Кундалини Йоги осталось 5 дней! Нам просто не
									верится, что уже так скоро состоится самое радостное и тпо-настоящему йоговское
									событие этого лета.<br>

									Давайте вместе разберемся, что нужно взять с собой, а что лучше оставить дома.</p>
							</div>
						</div>
					</div>
					<div class="wrapper-item-article">
						<div class="box-preview-article">
							<img src="image/preview-example.png" alt="статья">

							<div class="wrapper-theme-date clearfix">
								<p class="theme-item-preview">Блоги / Интервью</p>

								<p class="date-item-preview">1 июня 2016</p>
							</div>
							<h3 class="title-item-preview"><a href="#">Интервью с удивительным йогом Ом Шанти</a></h3>

							<div class="description-item-preview">
								<p>Со времени зарождения рассудочного мышления, как только человек начал делить мир на
									познающего и познаваемое, он начал «разгадывать» тайны природы. С этих пор человек
									стремится понять суть, цель и смысл своего бытия.

								</p>

							</div>
						</div>
					</div>
					<div class="wrapper-item-article">
						<div class="box-preview-article">
							<img src="image/preview-example.png" alt="статья">

							<div class="wrapper-theme-date clearfix">
								<p class="theme-item-preview">Блоги / Личный опыт</p>

								<p class="date-item-preview">7 апреля 2016</p>
							</div>
							<h3 class="title-item-preview"><a href="#">Мария Скатова: Йога для начинающих, без фанатизма
								и самодеятельности</a></h3>

							<div class="description-item-preview">
								<p>Философия йогов тесно связана с понятием прана или психическая энергия. Прана –
									результат взаимодействия человека и продуктов. Прану человек может получить из любой
									пищи, особенно, если будет ее готовить в хорошем настроении.
									Для того чтобы ответить на основные вопросы: «Кто я такой, откуда я пришел, зачем
									я здесь, как мне вернуться домой?» человеку мало было одной земной жизни.</p>

							</div>
						</div>
					</div>

				</div>
			</div> -->
		</div>
	</main>