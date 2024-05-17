import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import VotingComponent from './components/VotingComponent.vue';
app.component('voting-component', VotingComponent);

app.mount('#app');
