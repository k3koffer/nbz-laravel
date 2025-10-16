<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <footer class="footer">
        <div class="footer-top row mx-0">
            <div class="col-12 col-lg-4">
                <Link href="/"><div class="logo"></div></Link>
                <div class="links">
                    <Link href="https://www.youtube.com/@НеБойсяЗнать" class="px-2 py-2">
                        <i class="fa-brands fa-youtube fa-xl"></i>
                    </Link>
                    <Link href="https://t.me/nebojsaznat" class="px-2 py-2">
                        <i class="fa-brands fa-telegram fa-xl"></i>
                    </Link>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="info-wrapper">
                    <p class="info-title">Информация</p>
                    <Link class="info-link" href="/about">О нас</Link>
                    <Link class="info-link" href="/reviews">Отзывы</Link>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="bottom-links">
                <Link class="bottom-link" href="/policy">Политика конфиденциальности</Link>
                <a class="bottom-link" href="mailto:help@m-nbz.org">help@m-nbz.org</a>
            </div>
            <div class="nbz-link-wrapper"><Link class="nbz-link" href="#">НБЗ - 2025</Link></div>
        </div>
    </footer>
</template>

<style lang="scss" scoped>
    .footer {
        width: 100%;
        min-height: 270px;
        background-color: $bg-creme;
        position: relative;
        height: fit-content;
        display: flex;
        flex-direction: column;
    }

    .footer-top {
        flex: 1;
        display: flex;
        
        .logo {
            margin: 30px 20px 10px 20px;
            padding: 10px;
            height: 60px;
            background-image: url(https://ik.imagekit.io/3dwnck0ax/new_logo_transparent.webp?updatedAt=1760216006474);
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }

        .links {
            width: fit-content;
            @include media-breakpoint-up(lg) {
                width: 45%;
            }

            margin: 0 auto;

            .fa-brands {
                transition: 0.2s;
                color: $text-light;
                &:hover {
                    transform: scale(1.2);
                }
            }
        }

        .info-wrapper {
            margin: 30px 20px 10px 20px;

            .info-title {
                font-family: 'Inter', sans-serif;
                font-weight: 600;
                font-size: 18px;
                letter-spacing: 1.2px;
                padding: 5px 10px;
            }

            .info-link {
                padding: 3px 10px;
                font-family: 'Inter', sans-serif;
                font-weight: 300;
                font-size: 16px;
                letter-spacing: 1px;
                transition: 0.2s ease-out;
                width: fit-content;
                text-decoration: none;
                color: $text-light;

                &:hover {
                    letter-spacing: 1.2px;
                    color: $dark-text-hover;
                }
            }

            .info-link, .info-title {
                display: block;
                text-align: center;
                @include media-breakpoint-up(lg) {
                    text-align: unset;
                }
            }
        }
    }

    .footer-bottom {
        width: 100%;

        .bottom-links {
            width: fit-content;
            margin: 0 auto;
            padding: 10px 10px;

            .bottom-link {
                font-family: 'Inter', sans-serif;
                font-weight: 300;
                text-align: center;
                display: block;
                @include media-breakpoint-up(md) {
                    display: inline;
                }
                padding: 0 10px;
                transition: 0.2s ease-out;
                text-decoration: none;
                color: $text-light;

                &:hover {
                    letter-spacing: 1px;
                    color: $dark-text-hover;
                }
            }
        }

        .nbz-link-wrapper {
            width: fit-content;
            margin: 0 auto;
            padding: 10px 10px;
            transition: 0.2s ease-out;

            .nbz-link {
                text-decoration: none;
                color: $text-light;
            }

            &:hover {
                letter-spacing: 1px;
                color: $dark-text-hover;
            }
        }
    }
</style>