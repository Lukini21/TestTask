import axios from 'axios';
window.axios = axios;
import _ from 'lodash';
window._ = _
import {createApp} from 'vue'

import App from './App.vue'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
const app = createApp(App)

app.use(ElementPlus)
app.mount('#app')
