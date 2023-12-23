import axios from 'axios';
window.axios = axios;
import _ from 'lodash';
window._ = _
import {createApp} from 'vue'

import App from './App.vue'

createApp(App).mount("#app")
