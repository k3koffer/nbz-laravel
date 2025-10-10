<script setup>
import AppLayout from '@/Main/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import EducatorPreview from '@/Main/Components/Homepage/EducatorPreview.vue';
import { computed, ref, onMounted, onUnmounted } from 'vue';

// --- PROPS ---
// defineProps используется для объявления данных (пропсов),
// которые страница получает от Laravel-контроллера.
// В данном случае мы ожидаем получить объект 'users' с данными.
const props = defineProps({
    educators: Array,
});

let currentUrl = computed(() => {
    return window.location.href;
});

let aboutVideo = ref(null);

let observer = null;

onMounted(() => {
  const options = {
    root: null,
    rootMargin: '0px',
    threshold: 0.1
  };

  observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const video = entry.target;
        video.play().catch(error => {
          console.error("Autoplay was prevented:", error);
        });

        observer.unobserve(video);
      }
    });
  }, options);

  if (videoElement.value) {
    observer.observe(videoElement.value);
  }
});

onUnmounted(() => {
  if (observer && videoElement.value) {
    observer.unobserve(videoElement.value);
  }
});

</script>

<template>
    <Head title="Главная">
        <meta name="description" content="Наши молодые и энергичные преподаватели говорят с ребятами на одном языке, так что забудьте о зубрежке и непонимании — мы предлагаем интерактивные уроки, интересные задания и живое общение. Не Бойся Знать — это ваш путь к знаниям без страха и скуки!" />
        <meta property="og:title" content="НеБойсяЗнать - Главная" />
        <meta property="og:description" content="Наши молодые и энергичные преподаватели говорят с ребятами на одном языке, так что забудьте о зубрежке и непонимании — мы предлагаем интерактивные уроки, интересные задания и живое общение. Не Бойся Знать — это ваш путь к знаниям без страха и скуки!" />
        <meta property="og:url" :content="currentUrl" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="НеБойсяЗнать - образовательная платформа" />
        <meta property="og:locale" content="ru_RU" />
    </Head>
    
    <AppLayout>
        <div class="index-body">
            <section class="main">
                <div class="main-container">
                    <picture class="main-background-image-wrapper">
                        <source 
                            media="(min-width: 768px)"
                            srcset="
                                https://ik.imagekit.io/3dwnck0ax/tr:w-1280,f-auto/background_wide.png 1280w,
                                https://ik.imagekit.io/3dwnck0ax/tr:w-1920,f-auto/background_wide.png 1920w,
                                https://ik.imagekit.io/3dwnck0ax/tr:w-2560,f-auto/background_wide.png 2560w
                            "
                        >

                        <img 
                            src="https://ik.imagekit.io/3dwnck0ax/tr:w-750,f-auto/background_tel.png?updatedAt=1757355482559"
                            srcset="
                                https://ik.imagekit.io/3dwnck0ax/tr:w-480,f-auto/background_tel.png?updatedAt=1757355482559 480w,
                                https://ik.imagekit.io/3dwnck0ax/tr:w-750,f-auto/background_tel.png?updatedAt=1757355482559 750w
                            "
                            alt="Фоновое изображение с учениками на развивающих курсах"
                            
                            fetchpriority="high"
                            loading="eager"
                            decoding="async"
                            
                            class="main-background-image"
                            width="1920" height="1080"
                        >
                    </picture>

                    <div class="main-content-overlay">
                        <div class="logo">
                            <img 
                                srcset="
                                    https://ik.imagekit.io/3dwnck0ax/tr:w-640,f-auto/new_logo_transparent.png?updatedAt=1757353835347 640w
                                "
                                sizes="(max-width: 768px) 640px, 120px"
                                src="https://ik.imagekit.io/3dwnck0ax/tr:w-640,f-auto/new_logo_transparent.png?updatedAt=1757353835347"
                                alt="Логотип Не Бойся Знать"
                                width="640" height="120"
                            >
                        </div>
                        <h1>Развивающие курсы и помощь в выборе профессии для детей</h1>
                        <a class="to-courses-button-wrap" href="#section-courses"><button>К курсам</button></a>
                        <div class="scroll-button">
                            <a href="#section-courses"><span></span></a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="about">
                <div class="about-wrap row">
                    <div class="col-12 col-lg-7 text-wrap">
                        <h2>Немного <span>о нас</span></h2>
                        <h4>Не совсем репетиторы в классическом понимании</h4>
                        <p>Мы создали эту платформу, чтобы показать вашим детям, что наука — это увлекательное приключение, а не
                            скучные формулы:</p>
                        <p class="mb-5">Наши молодые и энергичные преподаватели говорят с ребятами на одном языке, так что
                            забудьте о зубрежке и непонимании — мы предлагаем интерактивные уроки, интересные задания и живое
                            общение. Тут ученики смогут научиться отличать систолу от диастолы, Османскую империю от Римской и
                            C++ от JavaScript. Пс, у нас еще много кросс-научных курсов (это когда науки взаимодействуют друг с
                            другом), так что каждый найдет себе что-то по душе.</p>
                        <Link href="/about"><button class="btn btn-dark">О нас</button></Link>
                    </div>
                    <div class="col-5 d-none d-lg-flex image-wrap">
                        <div class="image">
                            <div class="overlay"></div>
                            <video ref="aboutVideo" preload="none" autoplay muted loop playsinline poster="/images/index.webp">
                                <source src="/images/index.webm" type="video/webm">
                                <!-- <source src="/images/index.mp4" type="video/mp4"> -->
                            </video>
                        </div>
                    </div>
                </div>
            </section>
            <section class="educators">
                <div class="custom-shape-divider-top-1757314819">
                    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                    </svg>
                </div>
                <div class="educators-main">
                    <h2>Это МЫ</h2>
                    <educator-preview v-for="educator in educators" :key="educator.id" :educator="educator" />
                    <p>Все мы - частные репетиторы. Хотите индивидуальное занятие? Напишите нам на <a href="mailto:education@m-nbz.org">почту education@m-nbz.org</a></p>
                </div>
                <div class="custom-shape-divider-bottom-1757318243">
                    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                    </svg>
                </div>
            </section>
            <section id="section-courses" class="courses">
                <div class="courses-wrap mx-0">
                    <h2>Курсы</h2>
                    <div class="row courses-list">
                        <p class="course-warning">В настоящее время курсы недоступны! Следите за новостями!</p>
                        <p class="course-warning">Получите доступ к бесплатным знаниям в нашем <a href="https://blog.neboisyaznat.ru">блоге</a>!</p>
                    </div>
                    <div class="d-none download-button-wrap">
                        <button onclick="downloadCourses()" class="btn btn-dark download-button">Загрузить ещё</button>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
    
</template>

<style lang="scss" scoped>
    @-webkit-keyframes sdb10 {
        0% {
            -webkit-transform: translate(0, 0);
            opacity: 0;
        }
        40% {
            opacity: 1;
        }
        80% {
            -webkit-transform: translate(0, 20px);
            opacity: 0;
        }
        100% {
            opacity: 0;
        }
    }
    
    @keyframes sdb10 {
        0% {
            transform: translate(0, 0);
            opacity: 0;
        }
        40% {
            opacity: 1;
        }
        80% {
            transform: translate(0, 20px);
            opacity: 0;
        }
        100% {
            opacity: 0;
        }
    }

    .main {
        background-color: #FBEEC1; // Оставляем как цвет-заглушку, который виден до загрузки фото
        width: 100%;
        min-height: 500px;
        @include media-breakpoint-up(lg) {
            min-height: 870px;
        }
        height: 85vh;
        display: flex; // Это можно оставить, это не мешает
    }

    // Контейнер теперь в основном отвечает за позиционирование
    .main-container {
        width: 100%;
        position: relative; // Ключевое свойство для позиционирования фона и контента
    }

    // НОВЫЙ КЛАСС: Стили для нашего фонового изображения
    .main-background-image-wrapper .main-background-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
    }

    // НОВЫЙ КЛАСС: Сюда переезжают все стили для расположения контента
    .main-content-overlay {
        position: relative;
        z-index: 2; // Контент поверх фона
        width: 100%;
        height: 100%; // Растягиваем на всю высоту родителя
        
        // Стили, которые ПЕРЕЕХАЛИ из старого .main-container
        padding: 20px;
        display: flex;
        justify-content: center;
        flex-direction: column;

        // Все дочерние элементы теперь вложены сюда
        .logo {
            text-align: center;

            img {
                margin: auto;
                max-height: 120px;
                max-width: 100%;
                object-fit: contain;
            }
        }
        
        h1 {
            width: 100%;
            @include media-breakpoint-up(md) {
                width: 70%;
            }
            @include media-breakpoint-up(lg) {
                width: 50%;
            }
            margin: 0 auto;
            font-family: "Nunito", sans-serif;
            font-weight: 800;
            font-optical-sizing: auto;
            font-style: normal;
            font-size: clamp(24px, 5vw, 48px);
            text-align: center;
            color: #343A40;
            overflow-wrap: break-word;
        }
        
        .to-courses-button-wrap {
            width: 100%;
            display: flex;
            justify-content: center;
            text-decoration: none;
            button {
                margin: 20px auto 0 auto;
                padding: 10px 20px;
                font-family: "Nunito", sans-serif;
                font-weight: 800;
                font-optical-sizing: auto;
                font-style: normal;
                font-size: clamp(14px, 2vw, 18px);
                color: white;
                background-color: #ADA587;
                box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                
                &:hover {
                    background-color: #8c8770;
                }
            }
        }

        .scroll-button {
            position: absolute;
            bottom: 60px;
            left: 0;
            right: 0;
            margin: 10px auto;
            width: fit-content;
            a {
                padding-top: 60px;
            }

            a span {
                position: absolute;
                top: 0;
                left: 50%;
                width: 30px;
                height: 50px;
                margin-left: -15px;
                border: 2px solid #8c8770;
                border-radius: 50px;
                box-sizing: border-box;
            }

            a span::before {
                position: absolute;
                top: 10px;
                left: 50%;
                content: '';
                width: 6px;
                height: 6px;
                margin-left: -3px;
                background-color: #8c8770;
                border-radius: 100%;
                -webkit-animation: sdb10 2s infinite;
                animation: sdb10 2s infinite;
                box-sizing: border-box;
            }
        }
    }
    
    .about {
        background-color: rgb(247, 241, 227);
        
        .about-wrap {
            width: 100%;
            @include media-breakpoint-up(md) {
                width: 70%; 
            }
            min-height: 850px;
            height: fit-content;
            margin: 0 auto;
            padding: clamp(0px, 4vw, 90px) 0;
            display: flex;
            align-items: center;
            
            .text-wrap {
                padding: 20px clamp(30px, 2vw, 50px);
        
                h2 {
                    font-family: "Nunito", sans-serif;
                    font-weight: 800;
                    font-size: clamp(36px, 4vw,64px);
                    letter-spacing: -0.02em;
                    color: #000;
                    user-select: none;

                    span {
                        color: #ada78b;
                    }
                }
        
                h4 {
                    font-family: 'Inter', sans-serif;
                    font-weight: 400;
                    font-size: clamp(18px, 1.7vw, 22px);
                    line-height: 150%;
                    color: #828282;
                    user-select: none;
                }
        
                p {
                    padding: 10px 0;
                    font-family: 'Inter', sans-serif;
                    font-weight: 500;
                    font-size: clamp(16px, 1.4vw, 20px);
                    line-height: 150%;
                    color: #000;
                    user-select: none;
                }
                
                button {
                    border-radius: 8px;
                    padding: 0px 16px;
                    width: 251px;
                    height: 60px;
                    background: #ADA587;
                    border: none;
                    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        
                    font-family: 'Inter', sans-serif;
                    font-weight: 700;
                    font-size: 20px;
                    line-height: 150%;
                    color: #fff;
                    transition: 0.3s;
        
                }
        
                button:hover {
                    background-color: white;
                    color: black;
                    transform: scale(1.05);
                    border: 1px solid #ADA587;
                }
            }
        
            .image-wrap {
                padding: 0 30px;
                align-self: stretch;
            }

            .image-wrap .image {
                width: 100%;
                height: 100%;
                position: relative;
                border-radius: 8px;
                box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                overflow: hidden;
            }

            /* Стили для оверлея */
            .image-wrap .image .overlay {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.3);
                z-index: 2;
                border-radius: 8px;
            }

            /* Стили для видео */
            .image-wrap .image video {
                width: 100%;
                height: 100%;
                object-fit: cover;
                position: absolute;
                left: 0;
                top: 0;
                z-index: 1;
            }
        }
    }

    .educators {
        width: 100%;
        background: #318C7E;
        display: grid;
        position: relative;
        padding-bottom: 70px;

        .custom-shape-divider-top-1757314819 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .custom-shape-divider-top-1757314819 svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 66px;
        }

        .custom-shape-divider-top-1757314819 .shape-fill {
            fill: rgb(247, 241, 227);
        }

        .custom-shape-divider-bottom-1757318243 {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .custom-shape-divider-bottom-1757318243 svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 66px;
        }

        .custom-shape-divider-bottom-1757318243 .shape-fill {
            fill: #FBEEC1;
        }
        
        .educators-main {
            width: 90%;
            @include media-breakpoint-up(md) {
                width: 70%; 
            }
            min-height: 850px;
            height: fit-content;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
            justify-self: center;
            padding: 50px 0 0 0;
    
            p {
                text-align: center;
                font-size: 20px;
                font-weight: 500;
                color: #F8F6F0;

                a {
                    color: #FF9F43;
                    text-decoration: none;
                }
            }
    
            h2 {
                font-family: 'Nunito', sans-serif;
                font-weight: 800;
                font-size: clamp(36px, 4vw,64px);
                letter-spacing: -0.02em;
                color: #F8F6F0;
                width: 100%;
                text-align: center;
            }
        }
    }

    .courses {
        width: 100%;
        display: flex;
        justify-content: center;
        position: relative;
        background-color: #FBEEC1;
        
        .courses-wrap {
            width: 90%;
            min-height: 850px;
            height: fit-content;
            position: relative;
            
            h2 {
                font-family: 'Nunito', sans-serif;
                font-weight: 800;
                font-size: clamp(36px, 4vw,64px);
                letter-spacing: -0.02em;
                color: #23252C;
                text-align: center;
                margin: 130px 0;
                height: fit-content;
            }

            .course-overlay {
                width: 90%;
                border-radius: 8px;

                @include media-breakpoint-up(lg) {
                    min-width: 300px;
                    width: 70%;
                }
                height: 240px;
                margin: 0 auto;
                cursor: pointer;
                transition: 0.3s;
                background-size: cover;
                background-repeat: no-repeat;
                
                &:hover {
                    transform: scale(1.05);
                }
                
            }
            
            .courses-list {
                p {
                    font-family: 'Inter', sans-serif;
                    color: #23252C;
                    text-align: center;
                    font-size: 20px;
                    font-weight: 500;

                    a {
                        color: #FF9F43;
                        text-decoration: none;
                    }
                }
            }
            
            .course {
                position: relative;
                padding: 25px 0 0 0;
                height: 100%;
                background: rgba(11, 7, 4, 0.67);
                border-radius: 8px;
                
                h3 {
                    font-family: 'Inter', sans-serif;
                    font-weight: 700;
                    font-size: 28px;
                    letter-spacing: -0.02em;
                    color: #fff;
                    text-align: center;
                    // width: 100%;
                    padding: 0 20px;
                }
                
                h5 {
                    font-family: 'Inter', sans-serif;
                    font-weight: 300;
                    font-style: italic;
                    font-size: 15px;
                    letter-spacing: -0.02em;
                    text-align: center;
                    color: #e2e2e2;
                    text-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);
                    max-width: 350px;
                    margin: 0 auto;
                    width: 100%;
                }

                .picture {
                    width: 30px;
                    height: 30px;
                    background-color: #d9d9d9;
                    border-radius: 100%;
                    background-size: cover;
                    background-repeat: no-repeat;
                }
                
                .picture-wrap {
                    display: flex;
                    justify-content: center;
                    align-content: center;
                    flex-wrap: wrap;
                }
                
                .course-educator {
                    font-family: 'Inter', sans-serif;
                    font-weight: 300;
                    font-size: 15px;
                    letter-spacing: -0.02em;
                    text-align: center;
                    color: #e2e2e2;
                    text-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);
                    line-height: 2;
                    padding: 0 10px;
                }
                
                .course-length {
                    font-family: 'Inter', sans-serif;
                    font-weight: 500;
                    font-size: 15px;
                    letter-spacing: -0.02em;
                    text-align: center;
                    color: #e2e2e2;
                    text-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);
                    line-height: 2;
                    padding: 0 10px;
                    position: absolute;
                    right: 0;
                }
            }

            .download-button-wrap {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 160px;
                
                .empty-message {
                    font-family: 'Inter', sans-serif;
                    font-weight: 500;
                    
                    font-size: 16px;
                    width: 70%;
                    @include media-breakpoint-up(lg) {
                        font-size: 20px;
                        width: fit-content;
                    }
                    color: #23252C;
                    text-align: center;
                }
                
                button {
                    border-radius: 8px;
                    padding: 0px 16px;
                    width: 249px;
                    height: 55px;
                    background: #23252c;
                    transition: 0.3s;
                    
                    font-family: 'Inter', sans-serif;
                    font-weight: 500;
                    font-size: 16px;
                    line-height: 150%;
                    color: #fff;
                    
                    &:hover {
                        transform: scale(1.05);
                        background: white;
                        color: #23252c;
                    }
                }
            }
        }
    }
</style>