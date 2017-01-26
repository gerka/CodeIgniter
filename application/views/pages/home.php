<script type='text/javascript'>
		function setCookie(name, value, options) {
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires * 1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for (var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
    }
  }

  document.cookie = updatedCookie;
}
function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}
setCookie()
</script>
	<main class="clearfix index-page">
		<div class="container-block">
			<div>

			<?php if (!empty($slider_top) and is_array($slider_top)): ?>
				
			
				<div class="important-event-box clearfix row" id="slider_top">
				
				<?php foreach ($slider_top as $key => $value): ?>

					<div class="item">
						<div class="col-xs-12 col-sm-6 col-md-4">
						<a href="/<?=$lang.'/'.$value['alias']?>"><h2><span><?=$value['h1']?></span></h2></a>

						<p class="date-important-event"><?
						if ($value['event']!='') {

							$newdate = json_decode($value['event']);
							if(!empty($newdate->Start)){
							$NewdateStart = $newdate->Start;
							$NewdateEnd = $newdate->End;
							
							$date_explodeStart = explode(" ", $NewdateStart);
							$date_explodeEnd = explode(" ", $NewdateEnd);

							$dateStart = explode("-", $date_explodeStart[0]);
							$timeStart = explode(":", $date_explodeStart[1]);
							$dateEnd = explode("-", $date_explodeEnd[0]);
							$timeEnd = explode(":", $date_explodeEnd[1]);

							$yearStart = $dateStart[0];
							$dayStart = $dateStart[2];
							$monthStart = $dateStart[1];
							$yearEnd = $dateEnd[0];
							$dayEnd = $dateEnd[2];
							$monthEnd = $dateEnd[1];

							// $hours = $time[0];
							// $minutes = $time[1];
							// $seconds = $time[2];
							
							if($NewdateStart==$NewdateEnd){
							echo $dayStart.'.'.$monthStart.'.'.$yearStart;}
							else{
								echo $dayStart.'.'.$monthStart.'-'.$dayEnd.'.'.$monthEnd.'.'.$yearEnd;
							}
						}
						}else{echo $value['telephone'];}?></p>

						<p class="place-important-event"><?=$value['adress']?></p>

						<p class="text-important-event">
							<?=$value['preview_text']?>
						</p>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-8">
						<a href="/<?=$lang.'/'.$value['alias']?>"><img src="http://globe.yoga/images/thumb/745X460/<?=$value['logo']?>" alt="<?=$value['h1']?>"></a>
					</div>
					</div>
				<?php endforeach ?>
				
				</div>
				
				<div class="pagination-wrapper">
					<nav aria-label="Page navigation">
						<ul class="pagination">
							<li>
								<a href="javascript:;" class="btn prev" aria-label="Previous" id="slider_top_prev">
									<span aria-hidden="true">&nbsp;</span>
								</a>
							</li>
							<li>
								<a href="javascript:;" class="btn next" id="slider_top_next" aria-label="Next">
									<span aria-hidden="true">&nbsp;</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
<?php endif ?>
			</div>
			<?php if (!empty($slider_mesta) and is_array($slider_mesta) and count($slider_mesta[0])>1): ?>
				<div class="places-wrapper">
					<div class="clearfix subtitle-index-page">
						<h2><?=$slider_mesta[0]['menuTitle']?></h2>

						<div class="button-base button-subtitle">
							<a class="button-base button-subtitle" href="/<?=$lang.'/'.$slider_mesta[0]['menuLink'].'/'?>"><div><?=$constants['buttonShowAll'][$lang]?></div></a>
						</div>
					</div>
					<p class="description-subtitle"><?=$constants['sliderMestaText'][$lang]?></p>
					
					<div class="clearfix wrapper-result-item" id="slider_mesta">
					<?php foreach ($slider_mesta as $key => $value): ?>
						

							<div class="result-item">
								<a href="/<?=$lang.'/'.$value['alias']?>"><img src="/images/thumb/390X255/<?=$value['logo']?>" alt="<?=$value['title']?>"></a>

								<p class="result-item-city"><?=$value['adress']?></p>

								<p class="result-item-name"><a href="/<?=$lang.'/'.$value['alias']?>"><?=$value['h1']?></a>
								</p>

								<p class="result-item-comment"><?=$value['preview_text']?></p>
							</div>
						

					<?php endforeach ?>
						
						

					</div>

					<div class="pagination-wrapper">
						<nav aria-label="Page navigation">
							<ul class="pagination">
								<li>
									<a href="javascript:;" class="btn slider_mesta_prev" aria-label="Previous" id="slider_mesta_prev">
										<span aria-hidden="true">&nbsp;</span>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="btn slider_mesta_next" id="slider_mesta_next" aria-label="Next">
										<span aria-hidden="true">&nbsp;</span>
									</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			<?php endif ?>
			
			
			<?php if (!empty($slider_trip) and is_array($slider_trip) and count($slider_trip)>1): ?>
				<div class="travels-wrapper">
				<div class="clearfix subtitle-index-page">
					<h2><?=$slider_trip[0]['menuTitle']?></h2>

					<a href="/<?=$lang.'/'.$slider_trip[0]['menuLink'].'/'?>" class="button-base button-subtitle">
						<div>
							<?=$constants['buttonShowAll'][$lang]?>
						</div>
					</a>
				</div>
				<?=$constants['quoteSliderTrip'][$lang]?>
				

				<p class="description-subtitle"><?=$slider_trip[rand (0,count($slider_trip)-1)]['description']?></p>
				<?php if (count($slider_trip)>=3): ?>
					
				
				<div class="clearfix">
				<?php for ($i=0; $i < 3 ; $i++):  ?>
					
						<div  <?= ($i==0) ? 'class="col-sm-6 col-xs-12"' : 'class="col-sm-3 col-xs-6"' ;?> >
						<div class="travels-item">
							<a href="<?=$slider_trip[$i]['alias']?>">
								<div class="shadow-image">
									<img src="/images/thumb/<?=($i==0 ||$i ==5) ? '720X446': '355X446' ;?>/<?=$slider_trip[$i]['logo']?>"
								                 alt="<?=$slider_trip[$i]['h1']?>">

									<p class="box-country"><?=$slider_trip[$i]['filters'][0]['value']?></p>

									<div class="box-info">
										<div>
											<p class="date-travel">
											<? if ($slider_trip[$i]['event']!='') {

							$newdate = json_decode($slider_trip[$i]['event']);
							if(!empty($newdate->Start)){
							$NewdateStart = $newdate->Start;
							$NewdateEnd = $newdate->End;
							
							$date_explodeStart = explode(" ", $NewdateStart);
							$date_explodeEnd = explode(" ", $NewdateEnd);

							$dateStart = explode("-", $date_explodeStart[0]);
							$timeStart = explode(":", $date_explodeStart[1]);
							$dateEnd = explode("-", $date_explodeEnd[0]);
							$timeEnd = explode(":", $date_explodeEnd[1]);

							$yearStart = $dateStart[0];
							$dayStart = $dateStart[2];
							$monthStart = $dateStart[1];
							$yearEnd = $dateEnd[0];
							$dayEnd = $dateEnd[2];
							$monthEnd = $dateEnd[1];

							// $hours = $time[0];
							// $minutes = $time[1];
							// $seconds = $time[2];
							
							if($NewdateStart==$NewdateEnd){
							echo $dayStart.'.'.$monthStart.'.'.$yearStart;}
							else{
								echo $dayStart.'.'.$monthStart.'-'.$dayEnd.'.'.$monthEnd.'.'.$yearEnd;
							}
						}
						} ?>
												
											</p>

											<p class="name-travel">
												<?=$slider_trip[$i]['h1']?>
											</p>

											<p class="place-travel">
												<?=$slider_trip[$i]['adress']?>
											</p>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<?php endfor ?>
				
			</div>
			<?php endif ?>
				<?php if (count($slider_trip)<=6 and count($slider_trip)>3): ?>
					
				
				<div class="clearfix">
				<?php   for ($i=3; $i <  count($slider_trip); $i++): ?>
					
						<div  <?= ($i==5) ? 'class="col-sm-6 col-xs-12"' : 'class="col-sm-3 col-xs-6"' ;?> >
						<div class="travels-item">
							<a href="<?=$slider_trip[$i]['alias']?>">
								<div class="shadow-image">
									<img src="/images/thumb/<?=($i==0 ||$i ==5) ? '720X446': '355X446' ;?>/<?=$slider_trip[$i]['logo']?>"
								                 alt="<?=$slider_trip[$i]['h1']?>">

									<p class="box-country"><?=$slider_trip[$i]['filters'][0]['value']?></p>

									<div class="box-info">
										<div>
											<p class="date-travel">
											<? if ($slider_trip[$i]['event']!='') {

							$newdate = json_decode($slider_trip[$i]['event']);
							if(!empty($newdate->Start)){
							$NewdateStart = $newdate->Start;
							$NewdateEnd = $newdate->End;
							
							$date_explodeStart = explode(" ", $NewdateStart);
							$date_explodeEnd = explode(" ", $NewdateEnd);

							$dateStart = explode("-", $date_explodeStart[0]);
							$timeStart = explode(":", $date_explodeStart[1]);
							$dateEnd = explode("-", $date_explodeEnd[0]);
							$timeEnd = explode(":", $date_explodeEnd[1]);

							$yearStart = $dateStart[0];
							$dayStart = $dateStart[2];
							$monthStart = $dateStart[1];
							$yearEnd = $dateEnd[0];
							$dayEnd = $dateEnd[2];
							$monthEnd = $dateEnd[1];

							// $hours = $time[0];
							// $minutes = $time[1];
							// $seconds = $time[2];
							
							if($NewdateStart==$NewdateEnd){
							echo $dayStart.'.'.$monthStart.'.'.$yearStart;}
							else{
								echo $dayStart.'.'.$monthStart.'-'.$dayEnd.'.'.$monthEnd.'.'.$yearEnd;
							}
						}
						} ?>
												
											</p>

											<p class="name-travel">
												<?=$slider_trip[$i]['h1']?>
											</p>

											<p class="place-travel">
												<?=$slider_trip[$i]['adress']?>
											</p>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
						
					<?php endfor ?>
				
			</div>
			<?php endif ?>

				<div class="clearfix"></div>
			<?php endif ?>
			<?php if (!empty($slider_knowledge) and is_array($slider_knowledge) and count($slider_knowledge[0])>1): ?>
				<div class="events-wrapper">
					<div class="clearfix subtitle-index-page">
						<h2><?=$slider_knowledge[0]['menuTitle']?> </h2>

						<div class="button-base button-subtitle">
							<a class="button-base button-subtitle" href="/<?=$lang.'/'.$slider_knowledge[0]['menuLink'].'/'?>"><div><?=$constants['buttonShowAll'][$lang]?></div></a>
						</div>
					</div>
					<?=$constants['quoteSliderKnowledge'][$lang]?>
					
					<?=$constants['descriptionSliderKnowledge'][$lang]?>
					

					<div class="clearfix wrapper-result-item" id='slider_knowledge'>
					<?php foreach ($slider_knowledge as $key => $value): ?>
						
							<div class="result-item">
								<a href="<?=$value['alias']?>"><img src="/images/thumb/390X255/<?=$value['logo']?>"
								                 alt="<?=$value['h1']?>"></a>
								
								<p class="result-item-date">
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
								<?=$day.'-'.$month.'-'.$year?></p>

								<p class="result-item-city"><?=$value['adress']?></p>

								<p class="result-item-name"><a href="<?=$value['alias']?>"><?=$value['h1']?></a></p>


							</div>
						
					<?php endforeach ?>
						
					</div>
					<div class="pagination-wrapper">
						<nav aria-label="Page navigation">
							<ul class="pagination">
								<li>
									<a href="javascript:;" class="btn slider_knowledge_prev" aria-label="Previous" id="slider_knowledge_prev">
										<span aria-hidden="true">&nbsp;</span>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="btn slider_knowledge_next" id="slider_knowledge_next" aria-label="Next">
										<span aria-hidden="true">&nbsp;</span>
									</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			<?php endif ?>
			
			<?php if (!empty($slider_moms)): ?>
			<div class="mothers-wrapper">
				<div class="clearfix subtitle-index-page">
					
					<h2><?=$slider_moms[0]['value']?></h2>

					
						<a class="button-base button-subtitle" href='/<?=$lang?>/<?=$slider_moms[0]['alias']?>'><div><?=$constants['buttonShowAll'][$lang]?></div></a>
					
				</div>
				<div class="clearfix">

					
				
				<?php foreach ($slider_moms[0]['submenu'] as $key => $value): ?>
					<div class="col-sm-3 col-xs-6">
						<div class="mothers-item">
							<a href="/<?=$lang?>/<?=$slider_moms[0]['alias']?>/<?=$value['alias']?>">
								<div class="shadow-image">
									<img src="/images/thumb/355X446/<?=$value['logo']?>"
									     alt="<?=$value['description']?>">

									<div class="box-info-mothers">
										<div>
											<p class="name-mothers">
												<?=$value['value']?>
											</p>

										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				<?php endforeach ?>
					
				</div>
			</div>
			<?php endif ?>
			<?php if (!empty($slider_kids[0])): ?>
			<div class="child-wrapper">
				<div class="clearfix subtitle-index-page">
					<h2><?=$slider_kids[0]['value']?></h2>
					
						<a class="button-base button-subtitle" href='/<?=$lang?>/<?=$slider_kids[0]['alias']?>'><div><?=$constants['buttonShowAll'][$lang]?></div></a>
					
				</div>
				<div class="clearfix">
				<?php foreach ($slider_kids[0]['submenu'] as $key => $value): ?>
					<div class="col-sm-3 col-xs-6">
						<div class="child-item">
							<a href="/<?=$lang?>/<?=$slider_kids[0]['alias']?>/<?=$value['alias']?>">
								<div class="shadow-image">
									<img src="/images/thumb/355X446/<?=$value['logo']?>"
									     alt="<?=$value['description']?>">

									<div class="box-info-child">
										<div>
											<p class="name-child">
												<?=$value['value']?>
											</p>

										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				<?php endforeach ?>
				</div>
			</div>
			<?php endif ?>
			<?php if (!empty($slider_merop) and is_array($slider_merop) and count($slider_merop[0])>1): ?>
				<div class="events-wrapper">
					<div class="clearfix subtitle-index-page">
						<h2><?=$slider_merop[0]['menuTitle']?></h2>

						<div class="button-base button-subtitle">
							<a class="button-base button-subtitle" href="/<?=$lang.'/'.$slider_merop[0]['menuLink'].'/'?>"><div><?=$constants['buttonShowAll'][$lang]?></div></a>
						</div>
					</div>
					<p class="quote"><span>“Жизнь во время путешествия — мечта в чистом виде.”</span> (Агата Кристи)</p>

					<p class="description-subtitle">Отправляйся в путешествие, globe.yoga подскажет интересные:</p>

					<div class="clearfix wrapper-result-item" id='slider_merop'>
					<?php foreach ($slider_merop as $key => $value): ?>
						
							<div class="result-item">
								<a href="<?=$value['alias']?>"><img src="/images/thumb/390X255/<?=$value['logo']?>"
								                 alt="<?=$value['h1']?>"></a>
								
								<p class="result-item-date">
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
								<?=$day.'-'.$month.'-'.$year?></p>

								<p class="result-item-city"><?=$value['adress']?></p>

								<p class="result-item-name"><a href="<?=$value['alias']?>"><?=$value['h1']?></a></p>


							</div>
						
					<?php endforeach ?>
						
					</div>
					<div class="pagination-wrapper">
						<nav aria-label="Page navigation">
							<ul class="pagination">
								<li>
									<a href="javascript:;" class="btn slider_merop_prev" aria-label="Previous" id="slider_merop_prev">
										<span aria-hidden="true">&nbsp;</span>
									</a>
								</li>
								<li>
									<a href="javascript:;" class="btn slider_merop_next" id="slider_merop_next" aria-label="Next">
										<span aria-hidden="true">&nbsp;</span>
									</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			<?php endif ?>
			
			<?php if (!empty($gallery_bottom)): ?>
		
			<div class="subtitle-photogallery-wrap">
				<div class="clearfix subtitle-index-page">
					<h2>Фото-галерея</h2>

					<!-- <div class="button-base button-subtitle">
						<input type="submit" value="<?=$constants['buttonShowAll'][$lang]?>">
					</div> -->
				</div>

			</div>
		</div>
	<?php endif ?>

	</main>
	
	<? $reverse = true;?>

	<div id="owl-example" class="owl-carousel">
	<?php foreach ($gallery_bottom as $key => $value): ?>
	<?$del = $key%3;?>
	<?php if ($del==0 and !empty($gallery_bottom[$key-3])): ?>
		<?php $reverse= !$reverse; ?>

			<?php switch ($reverse) {
		case true:
		?>
		<div class="item">
			<div class="photogallery-item-wide">
				<a class="fancybox" rel="gallery" href="/<?=$gallery_bottom[$key-3]['url']?>">
					<img src="<?=(file_exists('/images/thumb/390X255/'.substr($gallery_bottom[$key-3]['url'],7)))? '/images/thumb/390X255/'.substr($gallery_bottom[$key-3]['url'],7) : '/'.$gallery_bottom[$key-3]['url']?>"
					     alt="<?=$gallery_bottom[$key-3]['alt']?>">
				</a>
			</div>
			<div class="clearfix"></div>
			<div class="photogallery-item-narrow">
				<a class="fancybox" rel="gallery" href="/<?=$gallery_bottom[$key-2]['url']?>">
					<img src="<?=(file_exists('/images/thumb/180X240/'.substr($gallery_bottom[$key-2]['url'],7)))? '/images/thumb/180X240/'.substr($gallery_bottom[$key-2]['url'],7) : '/'.$gallery_bottom[$key-2]['url']?>"
					     alt="<?=$gallery_bottom[$key-2]['alt']?>">
				</a>
			</div>
			<div class="photogallery-item-narrow">
				<a class="fancybox" rel="gallery" href="/<?=$gallery_bottom[$key-1]['url']?>">
					<img src="<?=(file_exists('/images/thumb/180X240/'.substr($gallery_bottom[$key-1]['url'],7)))? '/images/thumb/180X240/'.substr($gallery_bottom[$key-1]['url'],7) : '/'.$gallery_bottom[$key-1]['url']?>"
					     alt="<?=$gallery_bottom[$key-1]['alt']?>">
				</a>
			</div>
	</div>
	<?php break;
	case false:
					?>
<div class="item">

			<div class="photogallery-item-narrow">
				<a class="fancybox" rel="gallery" href="/<?=$gallery_bottom[$key-3]['url']?>">
					<img src="<?=(file_exists('/images/thumb/390X255/'.substr($gallery_bottom[$key-3]['url'],7)))? '/images/thumb/390X255/'.substr($gallery_bottom[$key-3]['url'],7) : '/'.$gallery_bottom[$key-3]['url']?>"
					     alt="<?=$gallery_bottom[$key-3]['alt']?>">
				</a>
			</div>
				<div class="photogallery-item-narrow">
				<a class="fancybox" rel="gallery" href="/<?=$gallery_bottom[$key-2]['url']?>">
					<img src="<?=(file_exists('/images/thumb/180X240/'.substr($gallery_bottom[$key-2]['url'],7)))? '/images/thumb/180X240/'.substr($gallery_bottom[$key-2]['url'],7) : '/'.$gallery_bottom[$key-2]['url']?>"
					     alt="<?=$gallery_bottom[$key-2]['alt']?>">
				</a>
			</div>
					<div class="clearfix"></div>
			<div class="photogallery-item-wide">
				<a class="fancybox" rel="gallery" href="/<?=$gallery_bottom[$key-1]['url']?>">
					<img src="<?=(file_exists('/images/thumb/180X240/'.substr($gallery_bottom[$key-1]['url'],7)))? '/images/thumb/180X240/'.substr($gallery_bottom[$key-1]['url'],7) : '/'.$gallery_bottom[$key-1]['url']?>"
					     alt="<?=$gallery_bottom[$key-1]['alt']?>">
				</a>
			</div>
			
			</div>
	
	<?php break; 
	}?>

	<?php endif ?>
<?php endforeach ?>

</div>
	<div class="wrapper-arrows-carousel">
		<a>
			<div class="prev">
				<div></div>
			</div>
		</a>
		<a>
			<div class="next">
				<div></div>
			</div>
		</a>
	</div>
</div>
