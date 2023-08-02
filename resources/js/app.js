import './bootstrap';
import './bootstrap';
import { createApp } from 'vue';
/* import store from './store'; */
import router from './router';
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives,
  })

import App from './App.vue';

const app = createApp(App);

app.use(router);
/* app.use(store); */
app.use(vuetify);
app.mount('#app');
