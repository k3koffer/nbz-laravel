<script setup>
import { computed, onMounted, ref } from 'vue';
import AppLayout from '@/Blog/Layouts/AppLayout.vue';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css'; // импортируем стили для Tippy
import { Modal } from 'bootstrap';
import emitter from '@/eventBus.js';
import { format } from 'date-fns';
import { ru } from 'date-fns/locale';

const props = defineProps({
  article: Object,
});

// --- Ссылки на DOM-элементы (аналог getElementById) ---
const titleElement = ref(null);
const shareWindowTemplate = ref(null);
const shareModalElement = ref(null);
const articleContent = ref(null);

// --- Переменные для хранения экземпляров Tippy и Modal ---
let shareTippy = null;
let shareModal = null;

// --- Вычисляемые свойства для типа статьи и аватара автора ---
const articleType = computed(() => {
    switch (props.article.type) {
        case 2:
            return "ПОДКАСТ";
        case 3:
            return "ВИДЕО";
        default:
            return "СТАТЬЯ";
    }
});

// Вычисляемое свойство для отформатированной даты
const formattedDate = computed(() => {
  if (!props.article.created_at) {
    return '';
  }

  return format(new Date(props.article.created_at), 'd MMMM yyyy', {
    locale: ru,
  });
});

let currentLocation = computed(() => {
    return window.location.href;
});

const creatorPicture = computed (() => {
    let pictureLink = props.article.creator.picture;
    return `url(https://ik.imagekit.io/3dwnck0ax/tr:w-124,h-124/${pictureLink})`;
});

const showNotification = (message, type = 'success') => {
    emitter.emit('show-notification', { message, type });
}

// --- Функции для копирования ---
const copyArticleText = () => {
    let content = props.article.content;

    // Используем DOMParser для безопасного парсинга HTML
    const parser = new DOMParser();
    const doc = parser.parseFromString(content, 'text/html');
    const plainText = doc.body.textContent || ""; //

    let textArea = document.createElement('textarea');
    textArea.value = plainText; // Используем очищенный текст
    document.body.appendChild(textArea);
    textArea.select();

    // ... остальная часть вашей функции остается без изменений
    let successful = false;
    try {
        successful = document.execCommand('copy');
        if (successful) {
            showNotification(
                "Текст скопирован в буфер обмена!",
                "success"
            );
        } else {
            showNotification(
                "Не удалось скопировать текст!",
                "error"
            );
        }
    } catch (err) {
        console.error('Ошибка при попытке копирования:', err);
        alert('Ошибка при копировании текста.');
    }

    document.body.removeChild(textArea);
};

const copyLink = (event) => {
    const input = event.target.previousElementSibling;
    input.select();
    input.setSelectionRange(0, 99999); // Для мобильных устройств

    document.execCommand("copy");

    showNotification(
        "Ссылка скопирована в буфер обмена",
        "success"
    );

};


// --- Хук жизненного цикла onMounted ---
// Код внутри этой функции выполнится после того, как компонент будет отрисован
onMounted(() => {
    // 1. Инициализация модального окна Bootstrap
    if (shareModalElement.value) {
        shareModal = new Modal(shareModalElement.value);
    }

    // 2. Инициализация Tippy.js
    if (titleElement.value && shareWindowTemplate.value) {
        shareTippy = tippy(titleElement.value, {
            content: shareWindowTemplate.value.innerHTML,
            placement: "bottom-start",
            interactive: true,
            arrow: false,
            allowHTML: true,
            // Добавляем обработчики событий при показе Tippy
            onShow(instance) {
                // Находим кнопки внутри созданного Tippy-попапа
                const popper = instance.popper;
                const shareButton = popper.querySelector("#share-button");
                const copyButton = popper.querySelector("#copy-button");

                if (shareButton) {
                    shareButton.onclick = () => {
                        shareModal?.show();
                    };
                }

                if (copyButton) {
                    copyButton.onclick = copyArticleText;
                }
            }
        });
    }
});

let currentUrl = computed(() => {
    return window.location.href;
});

let imagePath = computed(() => {
    let picture = JSON.parse(props.article.picture);
    if (picture && picture.path) {
        return 'url(https://ik.imagekit.io/3dwnck0ax' + picture.path +')';
    } else {
        return 'unset';
    }
});

const share = (socialNetwork) => {
    const url = window.location.href;
    let shareUrl = '';

    switch (socialNetwork) {
    case 'telegram':
        shareUrl = `https://telegram.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(props.article.title)}`;
        break;
    case 'vk':
        shareUrl = `https://vk.com/share.php?url=${encodeURIComponent(url)}`;
        break;
    case 'ok':
        shareUrl = `https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl=${encodeURIComponent(url)}`;
        break;
    }

    if (shareUrl) {
    window.open(shareUrl, 'Share', 'width=650,height=500,status=0,toolbar=0');
    }
};

</script>

<template>
  <AppLayout>
    <div class="share-window" id="share-window" ref="shareWindowTemplate" style="display: none;">
        <div class="d-flex">
            <i id="share-button" title="Поделиться" class="fa-solid fa-share-nodes tooltip-share share-window-button"></i>
            <i id="copy-button" title="Скопировать текст статьи" class="tooltip-share fa-solid fa-copy share-window-button"></i>
        </div>
    </div>

    <div class="body-wrap row mx-0">
        <div id="share-modal" class="modal fade" tabindex="-1" ref="shareModalElement">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content share-modal-wrap">
                    <div class="modal-header">
                        <h5 class="modal-title">Поддержать НеБойсяЗнать</h5>
                        <button @click="shareModal?.hide();" type="button" class="modal-close-button">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <a href="/main" class="btn btn-light">Приобрести наши курсы</a>
                        <div class="share-links-wrap">
                            <h5 class="share-links-wrap-title">Поделиться</h5>
                            <div class="row mx-0">
                                <div class="col">
                                    <a href="#" @click="share('vk')">
                                        <img class="logo" src="/images/vk_logo.png">
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="#" @click="share('ok')">
                                        <img class="logo" src="/images/ok_logo.png">
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="#" @click="share('telegram')">
                                        <img class="logo" src="/images/tg_logo.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="input-wrapper">
                            <input :value="currentLocation" type="text" readonly class="share-copy"></input>
                            <button class="copy-button" @click="copyLink">Копировать</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="article-wrap col-12">
            <div class="article-body">
                <div class="article-header d-inline-flex px-0">
                    <p class="article-type article-header-content">{{ articleType }}</p>
                    <p class="article-date article-header-content ps-2">{{ formattedDate }}</p>
                </div>
                <h1 class="article-title" id="title" ref="titleElement">{{ article.title }}<i class="fa-xs fa-solid fa-share share-icon"></i></h1>
                <div v-html="article.content" class="article-content" ref="articleContent"></div>
                <div class="article-footer">
                    <hr class="article-footer-divider">
                    <div class="row article-creator">
                        <div class="col d-inline-flex creator-info">
                            <div :style="{ backgroundImage: creatorPicture }" class="creator-icon"></div>
                            <div class="mx-3">
                                <span class="creator-name">{{ article.creator.name }}</span>
                                <span class="creator-description">Преподаватель НеБойсяЗнать</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
  </AppLayout>
</template>

<style lang="scss" scoped>

.body-wrap {
    width: 100%;
    min-height: 900px;
    background-color: $bg-main;
    display: flex;
    justify-content: center;
}

.share-window-button {
    padding: 2px 8px;
    padding: 3px 8px;
    cursor: pointer;
    color: white;
    margin: 0;
    transition: 0.3s;

    &:hover {
        color: rgb(13,110,253);
    }
}

.article-wrap {
    border-radius: 20px;
    min-height: 700px;
    height: fit-content;
    width: 100%;
    margin: 100px auto 50px auto;
    padding: 0 10px;
    @include media-breakpoint-up(md) {
      padding: 0 40px;
      width: 70%;
    }
    
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;   
    background: $bg-creme;
}

.article-body {
    width: 90%;
    @include media-breakpoint-up(lg) {
        width: 60%;
    }
    margin: 60px auto 20px auto;
    text-wrap: wrap;
}

.article-title {
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: clamp(28px, 3vw, 32px);
    letter-spacing: -0.02em;
    color: $text-headings;
    cursor: pointer;

    .share-icon {
        color: $accent-trust;
        margin-left: 10px;
        transition: 0.3s;
    }

    &:hover {
        .share-icon {
            color: $accent-action;
        }
    }
}

.article-header-content {
    font-family: 'Inter', sans-serif;
    font-weight: 400;
    font-size: 14px;
    letter-spacing: -0.02em;
    color: $text-meta;
    margin-bottom: 5px;
}

.article-content {
    padding: 40px 0 20px 0;

    &:deep(p) {
        font-family: 'Times New Roman', serif;
        font-size: 18px;
        line-height: 1.6;
        color: $text-main; // ИСПРАВЛЕНО: основной цвет текста
        padding: 10px 0;
        margin: 0;
        text-indent: 25px;
    }

    &:deep(h1 + p),
    &:deep(h2 + p),
    &:deep(h3 + p) {
        text-indent: 0; // Убираем отступ у первого абзаца после любого заголовка
    }

    &:deep(h2), &:deep(h3) {
        font-family: "Times New Roman", serif;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: $text-headings; // ИСПРАВЛЕНО: цвет подзаголовков
        padding: 30px 0 10px 0;
    }
    &:deep(h2) { font-size: 24px; }
    &:deep(h3) { font-size: 20px; }

    &:deep(img) {
        width: 100%;
        padding: 10px 0;
        border-radius: 8px;
    }

    &:deep(blockquote) {
        border-left: 4px solid #f0a500; // Яркая, но не кричащая вертикальная линия
        margin: 20px 0;
        padding: 15px 25px;
        background-color: #fdfaf2; // Чуть более теплый оттенок, чем основной фон
        border-radius: 0 8px 8px 0; // Скругление углов для мягкости
        
        p {
            font-family: 'Georgia', serif; // Элегантный шрифт с засечками
            font-style: italic;
            font-size: 19px; // Немного крупнее основного текста
            color: #5a5a5a; // Чуть приглушенный цвет для акцента
            line-height: 1.7;

            // Убираем лишние отступы у параграфов внутри цитаты
            &:first-child {
                margin-top: 0;
            }
            &:last-child {
                margin-bottom: 0;
            }
        }
    };

    &:deep(ul), &:deep(ol) {
        padding-left: 30px;
        margin: 15px 0;
        font-family: 'Times New Roman', serif;
        font-size: 18px;
        color: $text-main;
    }

    &:deep(li) {
        line-height: 1.7;
        padding-left: 10px;
        margin-bottom: 10px;

        &::marker {
            color: #f0a500;
            font-weight: 600;
        }
    }

    &:deep(a) {
        color: #007bff;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        transition: border-bottom 0.3s ease;

        &:hover {
            border-bottom: 2px solid #007bff;
        }
    }

    &:deep(hr) {
        border: 0;
        height: 1px;
        background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0));
        margin: 40px 0;
    }
}

.article-footer {
    .article-footer-divider {
        border: none;
        height: 1px;
        background-color: $text-meta; // ИСПРАВЛЕНО: линия в тон мета-текста
        width: 50%;
    }

    .creator-info {
        padding: 20px 0;

        .creator-icon {
            width: 64px;
            height: 64px;
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #E0D9C8; // Заглушка в тон фона
            border-radius: 50%;
        }

        .creator-name {
            color: $text-headings; // ИСПРАВЛЕНО
            font-size: 20px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            display: block;
        }

        .creator-description {
            color: $text-main; // ИСПРАВЛЕНО
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            font-weight: 400;
            line-height: 1.2;
            display: block;
        }
    }
}


/* --- МОДАЛЬНОЕ ОКНО И БЛОКИ (ТЕМНАЯ ТЕМА) --- */
.share-modal-wrap, .article-list {
    background: $dark-bg;
    border-radius: 20px;
}

.share-modal-wrap {
    width: 500px;
    min-height: 294px;
    padding: 20px;

    .modal-body {
        .modal-title {
            font-family: 'Inter', sans-serif;
            color: $dark-text;
        }

        .btn-light {
            background: $dark-text; // Светлый фон
            color: $dark-bg; // Темный текст на кнопке
            font-weight: 700;
            border-radius: 48px;
            min-width: 195px;
            width: fit-content;
            height: 41px;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            letter-spacing: -0.02em;
            text-align: justify;
            margin: 0 auto;
            display: block;
            padding: 9px 0;
            text-align: center;

            &:hover {
                background: darken($dark-text, 5%);
            }
        }

        .share-links-wrap {
            padding: 30px 0 0 0;

            .share-links-wrap-title {
                font-family: 'Inter', sans-serif;
                font-weight: 400;
                font-size: 16px;
                letter-spacing: -0.02em;
                text-align: justify;
                color: #fff;
            }

            .logo {
                width: 50px;
                height: 50px;
                margin: 0 auto;
                display: block;
                transition: 0.3s;

                &:hover {
                    transform: scale(0.9);
                }
            }
        }
    }

    .modal-header {
        border: 0;
        padding: 0 16px 0 16px;

        .modal-title {
            color: white;
            font-size: 16px;
            letter-spacing: -0.02em;
            text-align: justify;
            margin: 0 auto;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            color: $dark-text;
        }

        .modal-close-button {
            background: transparent;
            border: 0;
            padding: 10px;

            position: absolute;
            right: 20px;
            top: 10px;

            &:hover {
                i {
                    color: rgb(209, 209, 209);
                }
            }

            .fa-solid {
                color: white;
                transition: 0.2s;
            }
        }
    }
    
    .modal-footer {
        border: 0;
        padding: 12px 12px 0 12px;

        .input-wrapper {
            position: relative;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .share-copy {
            border: 1px solid $dark-bg-light;
            background: #111;
            color: $dark-text;

            border-radius: 10px;
            width: 90%;
            height: 41px;
            margin: 0 auto;

            font-family: 'Inter', sans-serif;
            font-weight: 400;
            font-size: 16px;
            letter-spacing: -0.02em;
            text-align: justify;
            text-overflow: ellipsis;
            
            padding: 0 120px 0 15px;
            display: block;

            direction: rtl;
        }

        .copy-button {
            position: absolute;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            cursor: pointer;
            transition: 0.3s;
        
            border-radius: 48px;
            min-width: 102px;
            min-height: 27px;
            background: transparent;

            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: -0.02em;
            text-align: justify;
            color: $dark-text;
            text-align: center;
            
            &:active {
                color: darken($dark-text, 20%);
            }
        }
    }
}

.article-list {
    border-radius: 20px;
    width: 100%;
    margin: 15px 0 50px 0;
    padding: 10px;
    @include media-breakpoint-up(md) {
        padding: 20px 40px;
        margin: 15px 20px 50px 20px;
        width: 70%;
    }

    min-height: 300px;
    height: fit-content;
    padding-top: 20px;
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;

    background: #23252c;
}
</style>