document.addEventListener('DOMContentLoaded', (event) => {
    if (!window.Vue || !window.Vue.createApp) {
        console.error('Vue or Vue.createApp is not defined');
        return;
    }
        
    const app = window.Vue.createApp({
      data() {
        return {
          name: '',
          email: '',
          message: '',
          errors: {},
          successMessage: ''
        };
      },
      methods: {
        sendEmail() {
          this.errors = {};
    
          if (this.name.length < 2) {
            this.errors.name = "Is that really your name?";
          }
          if (!this.email.includes('@') || this.email.endsWith('@mailinator.com')) {
            this.errors.email = "Invalid email or email from blocked domain.";
          }
          if (!this.message) {
            this.errors.message = "Message cannot be empty.";
          }
    
          if (Object.keys(this.errors).length === 0) {
            // Mock sending email
            this.successMessage = "Žinutė išsiųsta. Ačiū!";
            this.name = '';
            this.email = '';
            this.message = '';
          }
        }
      },
      template: `
        <div class="contact-container">
          <h3>Kontaktinė forma</h3>
          <form @submit.prevent="sendEmail">
            <label for="name">Jūsų vardas</label>
            <input type="text" id="name" v-model="name">
            <div class="error" v-if="errors.name">{{ errors.name }}</div>
            <div class="input_separator"></div>
            <label for="email">El. paštas</label>
            <input type="email" id="email" v-model="email">
            <div class="error" v-if="errors.email">{{ errors.email }}</div>
            <div class="input_separator"></div>
            <label for="message">Žinutė</label>
            <textarea id="message" v-model="message"></textarea>
            <div class="error" v-if="errors.message">{{ errors.message }}</div>
            <div class="input_separator"></div> 
            <button type="submit">Susisiekti</button>
          </form>
          <div v-if="successMessage" class="successmessage">
            {{ successMessage }} <span style="color:green">✔</span>
          </div>
        </div>
      `
    });
    console.log('Vue app created'); // Log to check if Vue app is created
    
    app.mount('#contact-us-app');
    
    console.log('Vue app mounted'); // Log to check if Vue app is mounted
  });  