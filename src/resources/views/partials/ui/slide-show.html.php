<div class="swiper-container">
    <div class="swiper app-feature-swiper1">
        <div class="swiper-wrapper">
            <?php foreach ($list as $val): ?>
                <div class="swiper-slide">
                    <Image src="<?= $this->h($val) ?>" alt="" class="mx-auto" />
                </div>
            <?php endforeach; ?>
        </div>

        <div class="swiper-pagination app-feature-swiper1-pagination"></div>
    </div>
</div>