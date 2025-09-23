<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <footer>
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
                    <p>Информация</p>
                    <Link href="/about">О нас</Link>
                    <Link href="/reviews">Отзывы</Link>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="bottom-links">
                <Link href="/policy">Политика конфиденциальности</Link>
                <a href="mailto:help@m-nbz.org">help@m-nbz.org</a>
            </div>
            <div class="nbz-link"><Link href="#">НБЗ - 2025</Link></div>
        </div>
    </footer>
</template>

<style lang="scss" scoped>
    footer {
        width: 100%;
        min-height: 270px;
        background-color: #F8F6F0;
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
            background-image: url(https://ik.imagekit.io/3dwnck0ax/new_logo_transparent.png?updatedAt=1757353835347);
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

            i {
                transition: 0.2s;
                color: black;
                &:hover {
                    transform: scale(1.2);
                }
            }
        }

        .info-wrapper {
            margin: 30px 20px 10px 20px;

            p {
                font-family: 'Inter', sans-serif;
                font-weight: 600;
                font-size: 18px;
                letter-spacing: 1.2px;
                padding: 5px 10px;
            }

            a {
                padding: 3px 10px;
                font-family: 'Inter', sans-serif;
                font-weight: 300;
                font-size: 16px;
                letter-spacing: 1px;
                transition: 0.2s ease-out;
                width: fit-content;
                text-decoration: none;
                color: black;

                &:hover {
                    letter-spacing: 1.2px;
                    color: #ada587;
                }
            }

            a, p {
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

            a {
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
                color: black;

                &:hover {
                    letter-spacing: 1px;
                    color: #ada587;
                }
            }
        }

        .nbz-link {
            width: fit-content;
            margin: 0 auto;
            padding: 10px 10px;
            transition: 0.2s ease-out;

            a {
                text-decoration: none;
                color: black;
            }

            &:hover {
                letter-spacing: 1px;
                color: #ada587;
            }
        }
    }
</style>