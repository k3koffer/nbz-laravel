<script setup>
import AppLayout from '@/Main/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    educators: Array,
});

</script>

<template>
    <Head title="О нас" />
    
    <AppLayout>
        <div class="index-body">
            <section class="section-about">
                <div class="text-wrap">
                    <h1>О нас</h1>
                    <p>Все началось с того, что мы сами дико скучали на лекциях! Ну правда, открываешь учебник физики, а там
                        сплошные формулы и заумные определения. Или биология – куча сложных терминов, от которых голова кругом.
                        И вроде бы понимаешь, что это важно и интересно, но… скучно! Вот мы и подумали: а что, если крутые
                        молодые спецы расскажут о своих любимых предметах так, чтобы было понятно и увлекательно? Возьмут, да и
                        объяснят сложные вещи простым языком (да еще и на примерах из жизни).</p>

                    <br>

                    <p>Так и появилась идея проекта "Не бойся знать"! У нас нет нудных лекций и сложных заданий. Наши спикеры –
                        настоящие фанаты своего дела – делятся знаниями на "одном языке" с учениками. Они сделают так, чтобы
                        каждый понял, что физика – это не просто формулы, а способность понять, как устроен мир. Биология – не
                        только скучные термины, но и необыкновенное поле для экспериментов, а история – это не просто даты и сухие
                        факты, но захватывающие приключения и тайны прошлого.</p>

                    <br>

                    <p>Мы расскажем как распознавать болезни по симптомам, отличать гренгамское сражение от гангутского или
                        анализировать наш организм при помощи компьютера. Естественно это не все! Мы стараемся приглашать
                        различных профессионалов которые рассказывают про свой опыт в различных сферах: медики, архитекторы и
                        биологи.</p>

                    <br>

                    <p>Все мы - самозанятые репетиторы, которые решили объединиться здесь, чтобы популяризировать науки среди
                        молодежи!</p>

                    <div class="hr-div"></div>
                </div>
            </section>
            <section class="section-educators">
                <div class="person person-bg-dark">
                    <div class="mx-auto d-flex row mx-0">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <div style="background-image: url(https://ik.imagekit.io/3dwnck0ax/educator_Gusev?updatedAt=1746082237164)" class="image"></div>
                        </div>
                        <div class="col-12 col-md-8">
                            <h3>Артём Аксёнов</h3>
                            <p>Знакомьтесь, это Артем Гусев – человек, который ломает стереотипы! Кто сказал, что программист -
                                это
                                обязательно бородатый парень в свитере, который часами не выходит из дома? Артём - абсолютная
                                противоположность! У него получается совмещать, казалось бы, несовместимое: учится на политолога
                                и
                                создает сайты и приложения для игровых проектов. При этом ещё умудряется устраивать небольшие
                                походы
                                в лес со своими друзьями и вообще любить спорт. Поможет разобраться в тонкостях обществознания,
                                введет вас в исторический контекст или научит делать первый сайт.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="person person-bg-light">
                    <div class="mx-auto d-flex row mx-0">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <div style="background-image: url(https://ik.imagekit.io/3dwnck0ax/educator_Tzanidakis?updatedAt=1746083574002)" class="image"></div>
                        </div>
                        <div class="col-12 col-md-8">
                            <h3>Дмитрий Тзанидакис</h3>
                            <p>А вот и Дмитрий Тзанидакис – настоящий гражданин мира! Выпускник лицея №1553. Теперь грызет гранит
                                науки на факультете медицинской биологии университета Зальцбурга. Но Дмитрию и этого мало!
                                Различные медицинские курсы и волонтерские проекты – он успевает везде и вдохновляется новыми
                                знаниями. Расскажет все о человеческом организме, научит оказывать первую помощь и покажет все
                                секреты биомолекул. Кстати, Дмитрий тоже любит спорт. Сёрфинг - его главное увлечение.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="person person-bg-dark">
                    <div class="mx-auto d-flex row mx-0">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <div style="background-image: url(https://ik.imagekit.io/3dwnck0ax/educator_Lim?updatedAt=1746083138554)" class="image"></div>
                        </div>
                        <div class="col-12 col-md-8">
                            <h3>Артём Лим</h3>
                            <p>Наш человек в Чехии – Артём Лим! Этот парень знает толк в средневековых замках и готических
                                соборах, ведь он грызёт гранит(и не только) науки в университете Брно. История и архитектура для
                                него – не просто строчки в учебниках. Артём может часами рассказывать о тайнах древних рукописей
                                или о том, как строились великие сооружения. Активный участник волонтерских проектов, но
                                успевает еще и покорять горнолыжные склоны. Расскажет как жили люди в Средневековье и поможет
                                разобраться в стилях архитектуры.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>

<style lang="scss" scoped>
    .section-about {
        width: 100%;
        min-height: 850px;
        height: fit-content;
        align-items: center;
        display: flex;
        background-color: #FBEEC1;

        margin: 0 auto;
        padding: 50px 0;


        .text-wrap {
            padding: 0;
            width: 85%;
            @include media-breakpoint-up(md) {
                width: 70%;
                padding: 20px 0;
            }
            margin: 0 auto;

            h1 {
                --b: 6px;
                --w: 160px;
                --g: 15px;
                --c: #23252C;
                --h: transparent;
            
                width: fit-content;
                text-align: center;
                min-width: 300px;
                padding: 5px 1em;
                line-height: 1.6em;
                border: 1px solid;
                color: #F8F6F0;
                background: 
                conic-gradient(from   45deg at left ,var(--c) 25%,var(--h) 0) 0,
                conic-gradient(from -135deg at right,var(--c) 25%,var(--h) 0) 100%;
                background-size: 50% 100%;
                background-origin: border-box;
                background-repeat: no-repeat;
                border-image: 
                linear-gradient(
                    var(--h)      calc(50% - var(--b)/2),
                    var(--c) 0 calc(50% + var(--b)/2),
                    var(--h)    0) 
                1/0 var(--w)/calc(var(--w) + var(--g));
                margin-inline: auto;
                font-family: 'Inter', sans-serif;
                font-weight: 600;
                font-size: 24px;

                margin-bottom: 30px;
            }

            p {
                width: 100%;
                @include media-breakpoint-up(md) {
                    width: 70%;
                }
                margin: 0 auto;
                font-family: 'Inter', sans-serif;
                font-weight: 400;
                font-size: 20px;
                line-height: 150%;
                letter-spacing: -0.02em;
                text-align: center;
                color: #23252C;
            }

            .hr-div {
                width: 50%;
                margin: 50px auto 0 auto;
                height: 6px;
                background-color: #23252C;
            }
        }
    }

    .section-educators {
        width: 100%;
        min-height: 800px;
        height: fit-content;

        .person-bg-dark {
            background-color: #23252C;
            color: #F8F6F0;
        }

        .person-bg-light {
            background-color: #FBEEC1;
            color: #23252C;
        }

        .person {
            width: 100%;
            min-height: 400px;
            height: fit-content;
            display: flex;
            padding: 20px 0;

            .row {
                width: 100%;
                @include media-breakpoint-up(xl) {
                    width: 70%;
                }
            }

            .image {
                width: 223px;
                height: 223px;
                background-size: cover;
                background-repeat: no-repeat;
                background-color: gray;
                border-radius: 100%;
                margin: 30px 0 0 0;
            }

            h3 {
                font-family: 'Inter', sans-serif;
                font-weight: 600;
                font-size: clamp(36px, 3vw,48px);
                line-height: 150%;
                letter-spacing: -0.02em;
                padding: 40px 0 25px 0;
                
                text-align: center;
                @include media-breakpoint-up(md) {
                    text-align: unset;
                }
            }

            p {
                font-family: 'Inter', sans-serif;
                font-weight: 400;
                font-size: clamp(16px, 1.1vw,19px);
                line-height: 150%;
                letter-spacing: -0.02em;
                
                text-align: center;
                padding: 10px;
                @include media-breakpoint-up(md) {
                    text-align: unset;
                    padding: 0;
                }
            }
        }
    }
</style>