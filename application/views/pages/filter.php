<script type="text/javascript">
	UrlJs = <?=json_encode($BaseUrl)?>;
	LANG = <?=json_encode($lang)?>;
	
</script>
<main class="clearfix filter-page">
		<div class="container-block clearfix">
			<div class="button-mobile-filter-box">
				<div class="button-mobile-filter button-filter-open">
					<input id="filter_button" type="submit" value="Фильтр">
				</div>
<!--				<div class="button-mobile-filter button-sorting-open">-->
<!--					<input id="sorting_button" type="submit" value="Сортировка">-->
<!--				</div>-->

			</div>
			<div class="filter-box col-sm-3">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<script type="text/javascript">console.log(<?=json_encode($filter)?>)</script>
				<?php if (!empty($filter)): ?>
					
				
					<?php foreach ($filter as $key => $value): ?>
						<?php if (isset($value['filters'])): ?>
							<?php if (isset($value['type'])): ?>
								
							
							<?php switch($value['type']): 
case 'select': ?>
						<div class="panel panel-default">
						<div class="panel-heading grey-color" role="tab" id="<?=$key?>">
							<a role="button" data-toggle="collapse" href="#cat-<?=$value['id_element']?>" aria-expanded=""
							   aria-controls="cat-<?=$value['id_element']?>">
								<h4 class="panel-title"><span class="accordion-toggle-expanded"></span><?=$value['cat']?>
								</h4>
							</a>

						</div>
						<div id="cat-<?=$value['id_element']?>" class="panel-collapse collapse in" role="tabpanel"
						     aria-labelledby="<?=$key?>">
							
							<div class="box-filter-select">
								<div class="filter-select filter-select-<?=$value['id_element']?>">
								<!-- <form class="form-cat-<?=$value['id_element']?> clearfix">  -->
									<select class="select-category selectpicker select-template" data-id = "<?=$value['id_element']?>">
									<option data-alias="" value="">Выберите <?=$value['cat']?></option>
									<?php foreach ($value['filters'] as $key2 => $value2): ?>
										<option data-alias="/<?=$value2['alias']?>" value="/<?=$value2['alias']?>" id="filter-<?=$value2['id_element']?>" <?php if (in_array($value['alias'],$url) or in_array($value2['alias'],$url) ): ?>selected="selected"<?php endif ?>><?=$value2['filter']?></option>
									<?php endforeach ?>
									</select>
								 <!-- </form> --> 
								</div>
							</div>
						</div>
					</div>
					
					<?php break; ?>
					<?php case 'checkbox': ?>
					<div class="panel panel-default">
						<div class="panel-heading grey-color" role="tab" id="<?=$key?>">

							<a role="button" data-toggle="collapse" href="#cat-<?=$value['id_element']?>" aria-expanded=""
							   aria-controls="cat-<?=$value['id_element']?>"><h4 class="panel-title">
								<span class="accordion-toggle-expanded"></span>
								<?=$value['cat']?></h4>
							</a>
						</div>
						
						<div id="cat-<?=$value['id_element']?>" class="panel-collapse collapse in" role="tabpanel"
						     aria-labelledby="<?=$key?>">
							<div class="panel-body clearfix">
								<form class="form-cat-<?=$value['id_element']?> clearfix">
										<div class="left">
									<?php foreach ($value['filters'] as $key2 => $value2): ?>
										<div class="checkbox">
											<input type="checkbox" data-alias="/<?=$value2['alias']?>" id="filter-<?=$value2['id_element']?>" <?php if (in_array($value['alias'],$url) or in_array($value2['alias'],$url) ): ?>checked<?php endif ?>>
											<label for="filter-<?=$value2['id_element']?>">
												<?=$value2['filter']?>
											</label>
										</div>
									<?php endforeach ?>
									</div>
									
								</form>
							</div>
						</div>
					</div>
					
					<?php break; ?>
<?php endswitch; ?>

<?php endif ?>
					<?php endif ?>
				<?php endforeach ?>
				
					<!-- <div class="box-checkbox-only">
						<div class="panel-body clearfix">
							<form class="form-age">

								<div class="checkbox">
									<input type="checkbox" id="checkbox21">
									<label for="checkbox21">
										Выбранный пункт
									</label>
								</div>
								<div class="find-arrow">
									<span class="quantity-found">Найдено: 295</span>
								<span class="link-show-results">
								<a>Показать</a>
								</span>
								</div>

							</form>
						</div>
					</div> -->
					
					
					<div class="button-mobile-filter-box">
						<div class="button-mobile-filter button-filter-reset">
							<input type="submit" value="Сбросить">
						</div>
						<div class="button-mobile-filter button-filter-show">
							<input type="submit" value="Показать" id="button-filter-show-mobile">
						</div>

					</div>
					<div class="button-filter-box">
						<div class="button-sorting button-sorting-list">
							<input type="submit" value="Показать" id="button-filter-show">
						</div>
						<!-- <div class="button-sorting button-sorting-list">
							<input type="submit" value="Показать списком">
						</div>
						<div class="button-sorting button-sorting-map">
							<input type="submit" value="Показать на карте">
						</div> -->
					</div>
				
			
<?php endif ?>
	</div>
				</div>

			<div class="col-sm-9">
				<!-- <div class="sorting-wrapper">
					<div class="sorting-box clearfix">
						<div class="subsections-link clearfix">
							<p><a href="#">Подраздел 1</a></p>

							<p><a href="#">Подраздел 2</a></p>

							<p><a href="#">Подраздел 3</a></p>

							<p><a href="#">Подраздел 4</a></p>
						</div>

						<div class="accurate-sorting-box clearfix">
							<div class="clearfix">
								<p class="col-sm-2">Точнее:</p>

								<div class="accurate-select col-sm-10 col-xs-12 clearfix">
									<div>
										<div class="btn-group sorting-select btn-metro col-sm-3 col-xs-6">
												<select id="metro" class="">
													<option>Невский проспект</option>
													<option>Ладожская</option>
													<option>Технологический институт</option>
												</select>
										</div>
										<div class="btn-group sorting-select btn-city col-sm-3 col-xs-6">
											<select id="city-sorting" class="">
												<option>Москва</option>
												<option>Санкт-Петербург</option>
												<option>Новосибирск</option>
											</select>
										</div>
									</div>
									<div>
										<div class="btn-group sorting-select btn-region col-sm-3 col-xs-6">
											<select id="region-sorting">
												<option>Москва</option>
												<option>Санкт-Петербург</option>
												<option>Новосибирск</option>
											</select>
										</div>
										<div class="btn-group sorting-select btn-country col-sm-3 col-xs-6">
											<select id="country-sorting">
												<option>Россия</option>
												<option>Бразилия</option>
												<option>Канада</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="button-sorting-box clearfix">
								<div>

									<div class="button-sorting button-sorting-map">
										<input type="submit" value="Показать на карте">
									</div>


									<div class="button-sorting button-sorting-list">
										<input type="submit" value="Показать списком">
									</div>

								</div>
							</div>
						</div>
					</div>
				</div> -->
				<div class="result-wrapper">
					<div class="clearfix wrapper-result-item">
					<?php if (!empty($elements)): ?>
						
					<?php foreach ($elements as $key => $value): ?>
						<?php if ($value['alias']): ?>
							
						
						<div class="col-sm-4 col-xs-6">
							<div class="result-item">
								<a href="<?=$lastFilter?>/<?=$value['alias']?>"><img src="/images/thumb/390X255/<?=$value['logo']?>" alt="<?=$value['description']?>"></a>
									
								<!-- <p class="result-item-city">Москва</p>
								<p class="result-item-date">21 августа 2016</p> -->
								<p class="result-item-name"><a href="<?=$lastFilter?>/<?=$value['alias']?>"><?=$value['h1']?></a>
								</p>
								<p class="result-item-comment"><?=$value['preview_text']?></p>
							</div>
						</div>
						<?php endif ?>
					<?php endforeach ?>
						
						
					</div>
					<?php if ($pagination['on']): ?>
						<div class="pagination-wrapper">
						<nav aria-label="Page navigation">
						<ul class="pagination">
						<li>
									<a href="?page=<?=$pagination['pageNum']-1?>" aria-label="Previous">
										<span aria-hidden="true">&nbsp;</span>
									</a>
								</li>
						<?
						for ($i=0; $i < $pagination['countPages']; $i++) { ?>
							<li><a href="?page=<?=$i?>" <?php if ($pagination['pageNum'] == $i): ?>
								class="disabled mobile-hidden"
							<?php endif ?>><?=$i+1?></a></li>
							<?
						}
						?>
						

								<li>
									<a href="?page=<?=$pagination['pageNum']+1?>" aria-label="Next">
										<span aria-hidden="true">&nbsp;</span>
									</a>
								</li>
							</ul>
						</nav>
					</div>
					<?php endif ?>
					
					<?php else: ?>

						Ничего не найдено

					<?php endif ?>
					<?php if (!empty($body)): ?>
						<div class="col-sm-12 col-xs-12 col-md-12 body"><?=$body?></div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</main>