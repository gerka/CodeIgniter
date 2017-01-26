<body>
<div class="wrapper">
	<header>
		<div class="top-header container-block clearfix row">
			<div class="logo-box col-sm-2"><a href="/<?=$lang?>/home"><img
						src="<?php echo asset_url(); ?>yoga_template/image/logo.png" alt="логотип"></a></div>
			<div>
				<div class="col-sm-2 header-select">
			     <select id="country" class="selectpicker select-template">
			     <option>
					<?=$constants['countrySelect'][$lang]?>
				</option>
			      <?php foreach ($FilterCountry as $key => $value): ?>
                <option value="<?=$value['id_filter']?>" data-alias="<?=$value['alias']?>">
                    <?=$value['h1']?>
                </option>
                <?php endforeach ?>
			     </select>
			    </div>
			    <?php if (!empty($constants)): ?>
				<div class="col-sm-2 header-select">
			     <select id="region" class="selectpicker select-template">
			      <option><?=$constants['regSelect'][$lang]?></option>
			      <?php if (!empty($regionAppend)): ?>
			      <?php foreach ($regionAppend as $key => $value): ?>
			      	<option value="<?=$value['id_filter']?>" data-alias="<?=$value['alias']?>">
                    <?=$value['h1']?>
                	</option>
			      <?php endforeach ?>
			      <?php endif ?>
			     </select>
			    </div>
			    <div class="col-sm-2 header-select">
			     <select id="city" class="selectpicker select-template">
			      <option><?=$constants['citySelect'][$lang]?></option>
					<?php if (!empty($cityAppend)): ?>
			      <?php foreach ($cityAppend as $key => $value): ?>
			      	<option value="<?=$value['id_filter']?>" data-alias="<?=$value['alias']?>">
                    <?=$value['h1']?>
                	</option>
			      <?php endforeach ?>
			      <?php endif ?>
			     </select>
			    </div>
			</div>
			<div class="partner-link col-sm-2">
				<a href="/<?=$lang?>/partners">
					<?=$constants['bePartner'][$lang]?>
				</a>
			</div>
			<div class="partner-link col-sm-1">
				<a href="/<?=$lang?>/about">
					<?=$constants['aboutProject'][$lang]?>
				</a>
			</div>
			<!-- <div class="register-box col-sm-3 clearfix">
				<div>
					<a href="#">
						<p>Регистрация</p>
					</a>
					<a href="#">
						<p>Вход</p>
					</a>
				</div>
			</div> -->
		<?php endif ?>
			<div class="lang-box col-sm-1 pull-right">
			<?php if (!empty($url)): ?>
				<a href="/ru/<?foreach ($url as $key => $value) {if ($key!=0) {echo "$value/";}elseif($value!=$lang){echo "$value/";}}?>" onclick="langSelect('ru')" class="<?=$retVal = ($lang == 'ru') ? 'active' : '' ?>"  ><p>RU</p></a>
				<a href="/eng/<?foreach ($url as $key => $value) {if ($key!=0) {echo "$value/";}elseif($value!=$lang){echo "$value/";}}?>" onclick="langSelect('eng')" class="<?=$retVal = ($lang == 'eng') ? 'active' : '' ?>" ><p>ENG</p></a>
			<?php else: ?>
				<a href="/ru/" onclick="langSelect('ru')" class="<?=$retVal = ($lang == 'ru') ? 'active' : '' ?>"  ><p>RU</p></a>
				<a href="/eng/" onclick="langSelect('eng')" class="<?=$retVal = ($lang == 'eng') ? 'active' : '' ?>" ><p>ENG</p></a>
			<?php endif ?>
				
			</div>
			<div class="burger-menu ">
				<a href="#"><img src="<?php echo asset_url(); ?>yoga_template/image/burger.png" alt="иконка"></a>
			</div>
		</div>
		<?php if (!empty($header_search) and $header_search != 0): ?>

			<div class="background-parallax" data-stellar-background-ratio="0.5">
				<div class="wrapper-search">
					<div>
						<div>
							<img src="<?php echo asset_url(); ?>yoga_template/image/pearl-circle.png" alt="шар">
						</div>
						<form name="search-form" method="post" action="">
							<div class="search-button">
								<input type="submit" value="<?=$constants['wantFound'][$lang]?>" id="search_button">
							</div>

							<p class="inputbox_wrap"><input type="text" class="input-search" name="search" id="search"
							                                value="">
							</p>
						</form>
					</div>
				</div>
			</div>
		<?php endif ?>

		<div class="sticky">
			<nav class="container-block clearfix">
				<ul class="nav navbar-nav menu clearfix">

					<?php if (!empty($menu)): ?>

						<?php foreach ($menu as $key => $value): ?>
							<?php if (isset($value['submenu'])): ?>
								<li class="menu-item-select menu-place" data-target-menu="menu-<?= $value['id_menu'] ?>">
								<a href="/<?=$lang.'/'. $value['alias'] ?>"><span><?= $value['value'] ?></span></a><span
									class="pointer-menu hidden-arrow"
									data-target-menu="menu-<?= $value['id_menu'] ?>"></span>
							<?php else: ?>
								<li><a href="/<?=$lang.'/'. $value['alias'] ?>"><span><?= $value['value'] ?></span></a></li>
							<?php endif ?>
						<?php endforeach ?>
					<?php endif ?>


					<li class="visible-xs-block">
						<div class="container-block">
							<div class="register-box-mobile">
								<div>
									<a href="#">
										<p>Регистрация</p>
									</a>
									<a href="#">
										<p>Вход</p>
									</a>
								</div>
							</div>
							<div class="lang-box-mobile pull-right">
								<?php if (!empty($url)): ?>
									<a href="/ru/<?foreach ($url as $key => $value) {if ($key!=0) {echo "$value/";}elseif($value!=$lang){echo "$value/";}}?>" onclick="langSelect('ru')" class="<?=$retVal = ($lang == 'ru') ? 'active' : '' ?>"  ><p>RU</p></a>
									<a href="/eng/<?foreach ($url as $key => $value) {if ($key!=0) {echo "$value/";}elseif($value!=$lang){echo "$value/";}}?>" onclick="langSelect('eng')" class="<?=$retVal = ($lang == 'eng') ? 'active' : '' ?>" ><p>ENG</p></a>
								<?php else: ?>
									<a href="/ru/" onclick="langSelect('ru')" class="<?=$retVal = ($lang == 'ru') ? 'active' : '' ?>"  ><p>RU</p></a>
									<a href="/eng/" onclick="langSelect('eng')" class="<?=$retVal = ($lang == 'eng') ? 'active' : '' ?>" ><p>ENG</p></a>
								<?php endif ?>
							</div>
						</div>
					</li>
				</ul>
			</nav>

			<div class="submenu">

				<?php if (!empty($menu)): ?>

					<?php foreach ($menu as $key => $value): ?>
						<?php if (isset($value['submenu'])): ?>
							<ul class="nav container-block submenu-place hidden-submenu-place clearfix" data-target-menu="menu-<?= $value['id_menu'] ?>">
							<?php foreach ($value['submenu'] as $key2 => $value2): ?>

								<li><a href="/<?=$lang.'/'.$value['alias']?>/<?=$value2['alias'] ?>"><span><?=$value2['value'] ?></span></a></li>
							<?php endforeach ?>


						<?php endif ?>
						</ul>
					<?php endforeach ?>
				<?php endif ?>


			</div>

		</div>
	</header>
	
