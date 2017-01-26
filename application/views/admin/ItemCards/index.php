<h2><?php echo $title; ?></h2>

<?php foreach ($cards_item as $card_item): ?>

        <h3><?php echo $card_item['title']; ?></h3>
        <div class="main">
                <?php echo $card_item['body']; ?>
        </div>
        <p><a href="<?php echo site_url('cards/'.$card_item['id_post']); ?>">Просмотреть карточку</a></p>

<?php endforeach; ?>

