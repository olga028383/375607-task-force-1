<?php
/* @var $task */

/* @var $responses */

use morphos\Russian;

$this->title = $task->name;
$stars = 5;
?>
    <section class="content-view">
        <div class="content-view__card">
            <div class="content-view__card-wrapper">
                <div class="content-view__header">
                    <div class="content-view__headline">
                        <h1><?php echo $task->name ?></h1>
                        <span>Размещено в категории
                        <a href="/tasks?FilterForm%5Bcategories%5D=&FilterForm%5Bcategories%5D%5B%5D=<?php echo $task->category->id ?>"
                           class="link-regular"><?php echo $task->category->name ?></a>

                            <?php
                            echo $task->getFullDate($task->created);
                            ?>

                            назад</span>
                    </div>
                    <b class="new-task__price new-task__price--<?php echo $task->category->icon ?> content-view-price"><?php echo $task->sum ?>
                        <b> ₽</b></b>
                    <div class="new-task__icon new-task__icon--<?php echo $task->category->icon ?> content-view-icon"></div>
                </div>
                <div class="content-view__description">
                    <h3 class="content-view__h3">Общее описание</h3>
                    <p>
                        <?php echo $task->description ?>
                    </p>
                </div>

                <?php if (!empty($task->taskFiles)): ?>
                    <div class="content-view__attach">
                        <h3 class="content-view__h3">Вложения</h3>
                        <?php foreach ($task->taskFiles as $file): ?>
                            <a href="#"><?php echo $file->link ?></a>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>

                <div class="content-view__location">
                    <h3 class="content-view__h3">Расположение</h3>
                    <div class="content-view__location-wrapper">
                        <div class="content-view__map">
                            <a href="#"><img src="/img/map.jpg" width="361" height="292"
                                             alt="Москва, Новый арбат, 23 к. 1"></a>
                        </div>
                        <div class="content-view__address">
                            <span class="address__town">Москва</span><br>
                            <span>Новый арбат, 23 к. 1</span>
                            <p>Вход под арку, код домофона 1122</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-view__action-buttons">
                <button class=" button button__big-color response-button open-modal"
                        type="button" data-for="response-form">Откликнуться
                </button>
                <button class="button button__big-color refusal-button open-modal"
                        type="button" data-for="refuse-form">Отказаться
                </button>
                <button class="button button__big-color request-button open-modal"
                        type="button" data-for="complete-form">Завершить
                </button>
            </div>
        </div>
        <div class="content-view__feedback">
            <h2>Отклики <span>(<?php echo count($task->responses) ?>)</span></h2>
            <?php foreach ($task->responses as $response): ?>
                <div class="content-view__feedback-wrapper">

                    <div class="content-view__feedback-card">
                        <div class="feedback-card__top">

                            <a href="/user/view/<?php echo $response->user->id ?>">
                                <?php if ($response->user->profile->avatar): ?>
                                    <img src="<?php echo $response->user->profile->avatar ?>" width="55" height="54">
                                <?php else: ?>
                                    <img src="/img/man-glasses.jpg" width="55" height="55">
                                <?php endif ?>

                            </a>

                            <div class="feedback-card__top--name">
                                <p><a href="" class="link-regular"><?php echo $response->user->name ?></a></p>

                                <?php for ($i = 0; $i < $stars; $i++): ?>
                                    <?php if (round($response->user->profile->rating) > $i): ?>
                                        <span></span>
                                    <?php else: ?>
                                        <span class="star-disabled"></span>
                                    <?php endif ?>
                                <?php endfor ?>
                                <b><?php echo floatval($response->user->profile->rating) ?></b>
                            </div>
                            <span class="new-task__time">
                        <?php
                        echo $response->getFullDate($response->created);
                        ?>
                                назад
                    </span>
                        </div>
                        <div class="feedback-card__content">
                            <p>
                                <?php echo $response->message ?>
                            </p>
                            <span><?php echo $response->sum ?> ₽</span>
                        </div>
                        <div class="feedback-card__actions">
                            <a class="button__small-color request-button button"
                               type="button">Подтвердить</a>
                            <a class="button__small-color refusal-button button"
                               type="button">Отказать</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
<?php if ($task->executor_id !== null): ?>
    <section class="connect-desk">
        <div class="connect-desk__profile-mini">
            <div class="profile-mini__wrapper">
                <h3>Заказчик</h3>
                <div class="profile-mini__top">
                    <?php if ($task->customer->profile->avatar): ?>
                        <img src="<?php echo $task->customer->profile->avatar ?>" width="62" height="62"
                             alt="Аватар заказчика">
                    <?php else: ?>
                        <img src="/img/man-brune.jpg" width="62" height="62" alt="Аватар заказчика">
                    <?php endif ?>
                    <div class="profile-mini__name five-stars__rate">
                        <p><?php echo $task->customer->name ?></p>
                    </div>
                </div>
                <p class="info-customer">
                <span>
                    <?php //echo $task->count?>
                </span>
                    <span class="last-">
                    <?php

                    if ($task->customer->getYear($task->customer->profile->last_active_at)) {
                        echo Russian\pluralize($task->customer->getYear($task->customer->profile->last_active_at), 'год') . ' ';
                    }

                    if ($task->customer->getMonth($task->customer->profile->last_active_at)) {
                        echo Russian\pluralize($task->customer->getMonth($task->customer->profile->last_active_at), 'месяц') . ' ';
                    }
                    if ($task->customer->getDay($task->customer->profile->last_active_at)) {
                        echo Russian\pluralize($task->customer->getDay($task->customer->profile->last_active_at), 'день') . ' ';
                    }

                    if ($task->customer->getHour($task->customer->profile->last_active_at)) {
                        echo Russian\pluralize($task->customer->getHour($task->customer->profile->last_active_at), 'час') . ' ';
                    }
                    if ($task->customer->getMinutes($task->customer->profile->last_active_at)) {
                        echo Russian\pluralize($task->customer->getMinutes($task->customer->profile->last_active_at), 'минута') . ' ';
                    }
                    if ($task->customer->getSecond($task->customer->profile->last_active_at)) {
                        echo Russian\pluralize($task->customer->getSecond($task->customer->profile->last_active_at), 'секунда') . ' ';
                    }
                    ?>

                        на сайте</span></p>
                <a href="/user/view/<?php echo $task->customer->id ?>" class="link-regular">Смотреть профиль</a>
            </div>
        </div>
        <div class="connect-desk__chat">
            <h3>Переписка</h3>
            <div class="chat__overflow">
                <div class="chat__message chat__message--out">
                    <p class="chat__message-time">10.05.2019, 14:56</p>
                    <p class="chat__message-text">Привет. Во сколько сможешь
                        приступить к работе?</p>
                </div>
                <div class="chat__message chat__message--in">
                    <p class="chat__message-time">10.05.2019, 14:57</p>
                    <p class="chat__message-text">На задание
                        выделены всего сутки, так что через час</p>
                </div>
                <div class="chat__message chat__message--out">
                    <p class="chat__message-time">10.05.2019, 14:57</p>
                    <p class="chat__message-text">Хорошо. Думаю, мы справимся</p>
                </div>
            </div>
            <p class="chat__your-message">Ваше сообщение</p>
            <form class="chat__form">
            <textarea class="input textarea textarea-chat" rows="2" name="message-text"
                      placeholder="Текст сообщения"></textarea>
                <button class="button chat__button" type="submit">Отправить</button>
            </form>
        </div>
    </section>
<?php endif ?>