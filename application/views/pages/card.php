
<main class="clearfix page-product">
		<div class="container-block">
			<div class="clearfix">

				<div class="box-button-link">
					<p class="change-link">
						<?=$constants['yOwner'][$lang]?><a href="#" data-toggle="modal" data-target="#myModal2"><?=$constants['MakeChanges'][$lang]?>?</a></span>
					</p>

					<div class="button-base ">
					<div><a href="<?=$buttonBackUrl?>" ><?=$constants['BackToSearch'][$lang]?></a></div>
						
						</div>

				</div>
				<h1>
					<?=$h1 = (!empty($h1)) ? $h1 : '' ;?>

				</h1>
			</div>
			<div class="stars-wrapper">
				<?php if (!empty($stars)): ?>
					<? $HowMuchStar = 5; ?>
				<? $tmp = ceil($stars)-1; ?>
				<?php for ($i = 1; $i <= $tmp; $i++): ?>

					<span class="star-reiting star-yellow"></span>
					
				<?php endfor ?>
				<? $HowMuchStar = $HowMuchStar-$tmp; ?>
				
					
				<?php if ($tmp>$stars-1): ?>
					<? $HowMuchStar = $HowMuchStar-1; ?>
					<span class="star-reiting star-pale"></span>
				<?php endif ?>
				<?php for ($i = 1; $i <= $HowMuchStar; $i++): ?>
				
					<span class="star-reiting star-white"></span>
				
				<?php endfor ?>
				<?php endif ?>
			
				
			</div>
			<div class="photogallery-wrapper clearfix">
				<div class="clearfix">
	<?php if (!empty($logo)): ?>
					<div class="large-photo-container">
						<img class="main-image" src="/images/<?=$logo?>" alt="<?=$logo?>" data-image="/images/<?=$logo?>">
				</div>
				<?php endif ?>
					
					<?php if (!empty($map)): ?>
					<div class="map-container">
						<?=$map?>
				</div>
				<?php endif ?>
					
				</div>
				<div class="clear"></div>
				
				
				
				<?php if (!empty($gallery)): ?>
					<div class="small-photo-container clearfix">
					<a class="thumb"><img src="/images/thumb/90X60/<?=$logo?>" alt="<?=$logo?>" data-image="/images/<?=$logo?>"></a>
					<?php foreach ($gallery as $key => $value): ?>
						<? $tekImg = explode('/', $value['url']);
							$count = count($tekImg)-1;
						?>
						<a class="thumb"><img src="/images/thumb/90X60/<?=$tekImg[$count]?>" alt="<?=$value['alt']?>" data-image="/<?=$value['url']?>"></a>
					<?php endforeach ?>
				</div>
				<?php endif ?>
				
			</div>
			<div class="text-block-product clearfix">
				<div class="contacts-product-box">
					<div class="clearfix">
						<div class="address-block">
							<!-- <p><span class="country">Россия</span><span> / </span><span class="city">Москва</span></p> -->

							<p><span class="street"><?=$adress?></span></p>

							<!-- <p><span class="metro-station">Станция метро: </span><span class="name-metro-station">Арбатская
						</span></p> -->
							<p><span class="email"><?=$link?></span></p>
						</div>
						<div class="phone-block">
							<p class="phone-number"><?=$telephone?></p>
						</div>
					</div>
					<?php if (!empty($filters)): ?>
					<div class="other-property">
					<?php foreach ($filters as $key => $value): ?>
						<p><span class="property-name"><?=$key?>:</span>
						<?php foreach ($value as $key => $value2): ?>
							<span class="average-check"><?=$value2['h1']?> <?php if (isset($value[1])): ?>
								/
							<?php endif ?></span>
						<?php endforeach ?></p>
					<?php endforeach ?>
				</div>
				<?php endif ?>
					<!-- <div class="other-property">

						<p><span class="property-name">Средний чек: </span><span class="average-check">от 350 до 500
							рублей</span></p>

						<p><span class="property-name">Время работы: </span><span class="working-hours">пн-пт: 10:00 - 22:00; сб: 11:00 - 17:00; вс: 12:00 - 17:00</span>
						</p>

						<p><span class="property-name">Название параметра: </span><span>значение параметра</span></p>

						<p><span class="property-name">Название параметра: </span><span>значение параметра</span></p>

						<p>Параметр без названия</p>
					</div> -->
				</div>
				<div class="description-product-box">
					<p> <?=$body?></p>
				</div>
			</div>
			<?php if (!empty($staff)): ?>
				
			
			<div class="teachers-block clearfix">
				<h2>
					<?=$constants['Teachers'][$lang]?>
				</h2>
				<script type="text/javascript">console.log(<?=json_encode($staff)?>)</script>
				<?php foreach ($staff as $key => $value): ?>
					<div class="teachers-wrapper col-md-1-5 col-sm-4 col-xs-6">
					<div class="teachers-item">
						<a href="/<?=$lang?>/<?=$value['alias']?>"><div class="ellipse-teacher" style="background: url('/images/thumb/180X240/<?=$value['logo']?>') no-repeat 50% 100%;">
												</div></a>

						<p class="name-teacher"> <a href="/<?=$lang?>/<?=$value['alias']?>"><?=$value['name']?></a></p>
						<p class="description-teacher"><?=$value['description']?></p>
					</div>
				</div>
				<?php endforeach ?>
				
				
			</div>
			<?php endif ?>
			<div class="review-block clearfix">
				<div class="clearfix title-review">
					<h2><?=$constants['Review'][$lang]?></h2>

					<!-- <div class="button-base button-view-reviews">
						<input type="submit" value="Посмотреть все">
					</div> -->
					<div class="give-feedback">
						<img src="/assets/yoga_template/image/book-icon.png" alt="оставить отзыв"><a href="#" data-toggle="modal" data-target="#myModal"><?=$constants['leaveFeedback'][$lang]?></a>
					</div>
				</div>
				
				<?php foreach ($review as $key => $value): ?>
					<? $schet = ($key%2) ? false : true ;?>
					 <?php if ($schet): ?>
					 	<div class="clearfix">
					 <?php endif ?>
					<div class="col-sm-6 col-xs-12 review-item clearfix">
						<div class="avatar-review">
							<img src="<?= (!empty($value['logo'])) ? '/images/thumb/90X90/'.$value['logo'] : '/assets/yoga_template/image/avatar-1.png' ;?>" alt="отзыв">
						</div>
						<div class="content-review">
							<p class="date-review">
								<?=$value['date_create']?>
							</p>

							<p class="name-review">
								<?=$value['h1']?>
							</p>

							<p class="text-review"><span class="small-review">
								<?=$value['body']?></span>
							</p>
						</div>
					</div>
					<?php if (!$schet): ?>
						</div>
					<?php endif ?>
				<?php endforeach ?>
					
					
				
			</div>
			<?php if (!empty($slider_like) and $slider_like != '"status:0"'): ?>
			
			<div class="similar-products-block">
				<div class="clearfix title-similar-products">

					<h2><?=$constants['MayLike'][$lang]?></h2>

					<!-- <div class="button-base button-similar-products">
						<input type="submit" value="Посмотреть все">
					</div> -->
				</div>
				<div class="clearfix wrapper-result-item" id="slider_like">

					<?php foreach ($slider_like as $key => $value): ?>
						<div class="result-item">
							<a href="/<?=$lang.'/'.$value['alias']?>"><img src="/images/thumb/390X255/<?=$value['logo']?>" alt="ресторан"></a>
							<p class="result-item-city"><?=$value['adress']?></p>
							<p class="result-item-name"><a href="/<?=$lang.'/'.$value['alias']?>"><?=$value['h1']?></a>
							</p>
							<p class="result-item-comment"> <span class="small-review"> <?=$value['preview_text']?></span></p>
						</div>
					<?php endforeach ?>
					
					<!-- <div class="col-sm-3 col-xs-6">
						<div class="result-item">
							<a href="#"><img src="/assets/yoga_template/image/Festival_kundalini-yoga.png"
							                 alt="фестиваль кундалини-йоги"></a>

							<p class="result-item-date">21 августа 2016</p>

							<p class="result-item-name"><a href="#">Ежегодный фестиваль кундалини-йоги</a></p>


						</div>
					</div>
					<div class="col-sm-3 col-xs-6">
						<div class="result-item">
							<a href="#"><img src="/assets/yoga_template/image/Restoran_fresh_post.png" alt="вегетарианский ресторан"></a>

							<p class="result-item-name"><a href="#">Вегетарианский ресторан
								Fresh&nbsp;/&nbsp;Post@</a></p>

							<p class="result-item-comment">Ниж.Сыромятническая, 5/7, стр. 9б/20, на территории
								центра дизайна Artplay</p>
						</div>
					</div>
					<div class="col-sm-3 col-xs-6">
						<div class="result-item">
							<a href="#"><img src="/assets/yoga_template/image/Pervyi_moskovskii_ashram.png"
							                 alt="открытие первого московского ашрама"></a>

							<p class="result-item-date">1 сентября 2016</p>

							<p class="result-item-name"><a href="#">Открытие первого московского ашрама. </a></p>
						</div>
					</div> -->
				</div>
				<?php if (count($slider_like)>4): ?>
					
				
				<div class="pagination-wrapper">
					<nav aria-label="Page navigation">
						<ul class="pagination">
							<li>
								<a href="javascript:;" class="btn prev" aria-label="Previous" id="slider_like_prev">
									<span aria-hidden="true">&nbsp;</span>
								</a>
							</li>
							<li>
								<a href="javascript:;" class="btn next" id="slider_like_next" aria-label="Next">
									<span aria-hidden="true">&nbsp;</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
			<?php endif ?>
				</div>
<?php endif ?>
			<div class="rewiew-form-wrapper">
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="close-form" data-dismiss="modal">&nbsp;</div>

							<form id="form-review" class="form-review" name="form-review" method="post">
								<p class="title-form-review">Ваш отзыв</p>

								<p class="comment-form-review"><span>*</span>Пункты, обязательные для заполнения.</p>
								<label class="control-label" for="inputMessage">Текст отзыва</label>
								<textarea class="input-review" name="message" rows="12" id="inputMessage"
								          placeholder="* Текст отзыва" minlength="0"
								          aria-invalid="false"></textarea>

								<label for="nameInput" class="control-label">Имя</label>
								<input id="nameInput" class="input-review" name="inpName" placeholder="* Имя"
								       type="text"
								       data-inputmask-regex="[a-zA-ZА-Яа-яЁё]+" autocomplete="off"/>
								<label for="emailInput" class="control-label">Email</label>
								<input id="emailInput" class="input-review" name="emailInput" placeholder="* Email"
								       type="text" autocomplete="off"
								        />

								<label for="phoneInput" class="control-label">Телефон</label>
								<input id="phoneInput" class="input-review input-phone" name="inpPhone"
								       placeholder="Ваш телефон"
								       type="text"
								       data-inputmask-regex="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$"/>
								<div class="wrap-button">
									<p class="comment-form-review confidentiality-comment">Мы заботимся о вашей
									конфиденциальности!</p>
									<p class="comment-form-review confidentiality-comment">Ваши данные не будут
										переданы третьим лицам без вашего согласия.</p>
									<input class="button-send" id="addReview" type="button" value="Отправить отзыв"/>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="rewiew-form-wrapper">
				<div class="modal fade" id="thanksModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="close-form" data-dismiss="modal">&nbsp;</div>

							
								<p class="title-form-review">Спасибо за ваш отзыв</p>

								<p class="comment-form-review">Мы его опубликуем, как только проверим</p>
								
						</div>
					</div>
				</div>
			</div>
			<div class="change-form-wrapper">
				<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="close-form" data-dismiss="modal">&nbsp;</div>

							<form id="form-change" class="form-review" name="form-change" method="post">
								<p class="title-form-change"><?=$constants['Makechanges'][$lang]?></p>

								<p class="comment-form-review"><span>*</span>Пункты, обязательные для заполнения.</p>

								<div class="btn-group">
									<button type="button"
									        class="btn btn-default dropdown-toggle dropdown-base"
									        data-toggle="dropdown"
									        aria-haspopup="true"
									        aria-expanded="false">
										Выберите раздел:<span class="blue-caret"></span>
									</button>
									<ul class="dropdown-menu dropdown-menu-selected">
									<?php foreach ($menu as $key => $value): ?>
										<li><a href="<?=$value['alias']?>"><?=$value['value']?></a></li>
									<?php endforeach ?>
										
									</ul>
								</div>

								<label for="namePlace" class="control-label">Название места</label>
								<input id="namePlace" class="input-review" name="inpPlace"
								       placeholder="* Название места"
								       type="text"
								       autocomplete="off"/>

								<label class="control-label" for="inputChanges">Что изменить?</label>
								<textarea class="input-review" name="changes" id="inputChanges"
								          placeholder="* Что изменить?" minlength="0"
								          aria-invalid="false"></textarea>


								<label for="inputNameSurname" class="control-label">Имя, фамилия</label>
								<input id="inputNameSurname" class="input-review" name="inputNameSurname"
								       placeholder="* Имя, фамилия"
								       type="text" autocomplete="off"/>
								<label for="emailChangeInput" class="control-label">Email</label>
								<input id="emailChangeInput" class="input-review" name="emailChangeInput" placeholder="* Email"
								       type="text" autocomplete="off"
								/>

								<div class="wrap-button">
									<p class="comment-form-review confidentiality-comment">Мы заботимся о вашей
										конфиденциальности!</p>
									<p class="comment-form-review confidentiality-comment">Ваши данные не будут
										переданы третьим лицам без вашего согласия.</p>
									<input class="button-send" type="button" value="Отправить отзыв"/>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<script type="text/javascript">
		var idCards = <?=$id_post?>;
	</script>