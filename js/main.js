document.addEventListener('DOMContentLoaded', (event) => {
    if (!window.Vue || !window.Vue.createApp) {
        console.error('Vue or Vue.createApp is not defined');
        return;
    }

    // Define the HeroSlider component
    const HeroSlider = {
        data() {
            return {
                posts: [],
                currentSlideIndex: 0, // the index of the currently displayed slide
            };
        },
        mounted() {
            this.fetchPosts();
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
                    this.currentSlideIndex = 0; // Go back to the first slide
                }
            },
            previousSlide() {
                if (this.currentSlideIndex > 0) {
                    this.currentSlideIndex--;
                } else {
                    this.currentSlideIndex = this.posts.length - 1; // Go to the last slide
                }
            },
            truncate(html, length) {
                const text = html.replace(/<\/?[^>]+(>|$)/g, "");
                return text.length > length ? text.substring(0, length) + '...' : text;
              },
        },
        template: `
            <div class="hero-slider" v-if="posts.length > 0">
                <div class="slide" v-for="(post, index) in posts" :key="index" v-show="index === currentSlideIndex">
                    <div class="slide-content">
                        <h2>{{ post.title.rendered }}</h2>
                        <p v-html="truncate(post.excerpt.rendered, 180)"></p>
                        <a :href="post.link" class="read-more">Read More &#8594;</a>
                    </div>
                </div>
                <button class="chevron-button" @click="previousSlide">&#x276E;</button>
                <button class="chevron-button" @click="nextSlide">&#x276F;</button>                
            </div>
        `,
    };

    // Create a new Vue app specifically for the slider
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
        navigation.classList.toggle('active');
    });
});

