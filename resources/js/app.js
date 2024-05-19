import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import VotingComponent from './components/VotingComponent.vue';
import ResultsStreamingComponent from './components/ResultsStreamingComponent.vue';
app.component('voting-component', VotingComponent);
app.component('results-component', ResultsStreamingComponent);

app.mount('#app');
