<?php
/* @var $user */

use morphos\Russian;

$this->title = $user->name;
$stars = 5;
?>
<section class="content-view">
    <div class="user__card-wrapper">
        <div class="user__card">
            <?php if ($user->profile->avatar): ?>
                <img src="<?php echo $user->profile->avatar ?>" width="65" height="65" alt="<?php echo $user->name ?>">
            <?php else: ?>
                <img src="/img/man-hat.png" width="120" height="120" alt="Аватар пользователя">
            <?php endif ?>

            <div class="content-view__headline">
                <h1><?php echo $user->name ?></h1>
                <p><?php echo $user->district ?>,
                    <?php
                    echo $user->getYear($user->profile->birthday);
                    ?>
                </p>
                <div class="profile-mini__name five-stars__rate">
                    <?php for ($i = 0; $i < $stars; $i++): ?>
                        <?php if (round($user->profile->rating) > $i): ?>
                            <span></span>
                        <?php else: ?>
                            <span class="star-disabled"></span>
                        <?php endif ?>
                    <?php endfor ?>
                    <b><?php echo floatval($user->profile->rating) ?></b>
                </div>
                <b class="done-task">
                    <?php
                    echo Russian\pluralize(5, 'заказ');
                    ?>
                </b>
                <b class="done-review">
                    Получил
                    <?php
                    echo Russian\pluralize(count($user->reviews), 'отзыв');
                    ?>
                </b>
            </div>
            <div class="content-view__headline user__card-bookmark user__card-bookmark--current">
                <span>
                    Был на сайте
                    <?php
                    echo $user->getFullDate($user->profile->last_active_at);
                    ?>
                    назад</span>
                </span>
                <a href="#"><b></b></a>
            </div>
        </div>
        <div class="content-view__description">
            <p><?php echo $user->profile->biography ?></p>
        </div>
        <div class="user__card-general-information">
            <div class="user__card-info">
                <h3 class="content-view__h3">Специализации</h3>
                <div class="link-specialization">
                    <?php foreach ($user->categories as $category): ?>
                        <a href="/tasks?FilterForm%5Bcategories%5D=&FilterForm%5Bcategories%5D%5B%5D=<?php echo $category->id ?>"
                           class="link-regular"><?php echo $category->name ?></a>
                    <?php endforeach ?>
                </div>
                <h3 class="content-view__h3">Контакты</h3>
                <div class="user__card-link">
                    <a class="user__card-link--tel link-regular" href="#"><?php echo $user->profile->phone ?></a>
                    <a class="user__card-link--email link-regular" href="#"><?php echo $user->email ?></a>
                    <a class="user__card-link--skype link-regular" href="#"><?php echo $user->profile->skype ?></a>
                </div>
            </div>
            <?php if ($user->photos): ?>
                <div class="user__card-photo">
                    <h3 class="content-view__h3">Фото работ</h3>
                    <?php foreach ($user->photos as $photo): ?>
                        <a href="<?php echo $photo->link ?>"><img src="<?php echo $photo->link ?>" width="85"
                                                                  height="86" alt="Фото работы"></a>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <?php if (count($user->reviews) > 0): ?>
        <div class="content-view__feedback">
            <h2>Отзывы<span>(<?php echo count($user->reviews) ?>)</span></h2>
            <div class="content-view__feedback-wrapper reviews-wrapper">
                <?php foreach ($user->reviews as $review): ?>
                    <div class="feedback-card__reviews">
                        <p class="link-task link">Задание <a href="#"
                                                             class="link-regular"><?php echo $review->task->name ?></a>
                        </p>
                        <div class="card__review">

                            <a href="/task/view/<?php echo $review->task->id ?>">
                                <?php if ($review->sender->profile->avatar): ?>
                                    <img src="<?php echo $review->sender->profile->avatar ?>" width="55" height="54">
                                <?php else: ?>
                                    <img src="/img/man-glasses.jpg" width="55" height="54">
                                <?php endif ?>
                            </a>

                            <div class="feedback-card__reviews-content">
                                <p class="link-name link"><a href="#"
                                                             class="link-regular"><?php echo $review->sender->name ?></a>
                                </p>
                                <p class="review-text">
                                    <?php echo $review->message ?>
                                </p>
                            </div>
                            <div class="card__review-rate">
                                <p class="big-rate <?php echo (intval($review->evaluation) > 3) ? 'five' : 'three' ?>-rate"><?php echo $review->evaluation ?>
                                    <span></span></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    <?php endif ?>
</section>
<section class="connect-desk">
    <div class="connect-desk__chat">

    </div>
</section>