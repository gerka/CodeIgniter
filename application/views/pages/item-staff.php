<main class="clearfix page-item-news">
		<div class="container-block">

			<div class="wrapper-item-news">

				<div class="clearfix subtitle-item-news-page">

					

<!--					<h1>--><!--</h1>-->


				</div>
				<div class="content-item-news clearfix">
				
					<div class="img-staff"><img src="/images/<?=$item['logo']?>" alt="<?=$item['name']?>"></div>
                    <div class="info-staff">
                        <?php if (!empty($item['name'])): ?>
                            <p class="name-staff"><span class="info-staff__title">Фамилия, Имя</span> <span><?=$item['name']?></span> </p>
                        <?php endif ?>
                        <?php if (!empty($item['etc'])): ?>
                            <p><span class="info-staff__title">Духовное имя</span> <span> <?=$item['etc']?></span> </p>
                        <?php endif ?>
                        <?php if (!empty($item['site'])): ?>
                            <p><span class="info-staff__title">Сайт </span> <span><?=$item['site']?></span> </p>
                        <?php endif ?>
                        <?php if (!empty($item['email'])): ?>
                            <p><span class="info-staff__title">E-mail </span> <span><?=$item['email']?></span> </p>
                        <?php endif ?>
                        <?php if (!empty($item['telephone'])): ?>
                            <p><span class="info-staff__title">Телефон </span> <span><?=$item['telephone']?></span> </p>
                        <?php endif ?>
                        <?php if (!empty($item['filters'])): ?>
                        <?php foreach ($item['filters'] as $key => $value): ?>
                        <p><span class="info-staff__title"> 
                        
                                <?=$value['cat']['h1']?> </span> 
                                <span><?=$value['value']?></span> </p>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
				</div>

			</div>
		
		</div>
	</main>