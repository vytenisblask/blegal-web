document.addEventListener('DOMContentLoaded', (event) => {
    if (!window.Vue || !window.Vue.createApp) {
        console.error('Vue or Vue.createApp is not defined');
        return;
    }

    const HeroSlider = {
        data() {
            return {
                posts: [],
                currentSlideIndex: 0,
                autoScrollTimer: null,
            };
        },
        mounted() {
            this.fetchPosts();
            this.startAutoScroll();
        },
        beforeUnmount() {
            this.stopAutoScroll();
        },
        methods: {
            async fetchPosts() {
                try {
                    const response = await fetch('/wp-json/wp/v2/posts?_embed');
                    const data = await response.json();
                    this.posts = data.filter(post => post.display_in_slider === true || post.display_in_slider === "1");
                } catch (error) {
                    console.error('Error fetching posts:', error);
                }
            },
            nextSlide() {
                if (this.currentSlideIndex < this.posts.length - 1) {
                    this.currentSlideIndex++;
                } else {
                    this.currentSlideIndex = 0;
                }
            },
            previousSlide() {
                if (this.currentSlideIndex > 0) {
                    this.currentSlideIndex--;
                } else {
                    this.currentSlideIndex = this.posts.length - 1;
                }
            },
            startAutoScroll() {
                this.autoScrollTimer = setInterval(() => {
                    this.nextSlide();
                }, 2500);
            },
            stopAutoScroll() {
                clearInterval(this.autoScrollTimer);
            },
            onSlideHover() {
                this.stopAutoScroll();
            },
            onSlideLeave() {
                this.startAutoScroll();
            },
            truncate(html, length) {
                const text = html.replace(/<\/?[^>]+(>|$)/g, "");
                return text.length > length ? text.substring(0, length) + '...' : text;
            },
            goToSlide(index) {
                this.currentSlideIndex = index;
            }
        },
        template: `
            <div class="hero-slider" v-if="posts.length > 0" @mouseenter="onSlideHover" @mouseleave="onSlideLeave">
                <div class="slide" v-for="(post, index) in posts" :key="index" v-show="index === currentSlideIndex">
                    <div class="slide-content">
                        <h2>{{ post.title.rendered }}</h2>
                        <p v-html="truncate(post.excerpt.rendered, 180)"></p>
                        <a :href="post.link" class="read-more">Read More &#8594;</a>
                    </div>
                </div>
                <div class="slide-indicators">
                    <span v-for="(post, index) in posts" :key="index" class="dot" :class="{ active: index === currentSlideIndex }" @click="goToSlide(index)"></span>
                </div>
                <button class="chevron-button" @click="previousSlide">&#x276E;</button>
                <button class="chevron-button" @click="nextSlide">&#x276F;</button>                
            </div>
        `,
    };

    const sliderApp = window.Vue.createApp({});
    sliderApp.component('hero-slider', HeroSlider);
    sliderApp.mount('#slider-app');
});


document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('.main-navigation');
    const mobileCTA = document.querySelector('.mobile-cta');
    const primaryMenu = document.getElementById('primary-menu');

    // Move the mobile CTA inside the primary menu
    primaryMenu.appendChild(mobileCTA);

    menuToggle.addEventListener('click', function() {
        if (menuToggle.getAttribute('data-state') === 'burger') {
            menuToggle.src = menuToggle.src.replace('np_burger-menu.svg', 'np_x.svg');
            menuToggle.setAttribute('data-state', 'x');
        } else {
            menuToggle.src = menuToggle.src.replace('np_x.svg', 'np_burger-menu.svg');
            menuToggle.setAttribute('data-state', 'burger');
        }

        navigation.classList.toggle('active');
    });
});


jQuery(document).ready(function($) {
    $('.team-member').on('click', function(e) {
        // Prevent the LinkedIn link from being triggered
        if (!$(e.target).closest('.linkedin-icon-link').length) {
            window.location = $(this).attr('data-link');
        }
    });
});
