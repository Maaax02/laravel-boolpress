import Vue from 'vue';
import Home from './pages/Home.vue';
import Contacts from './pages/Contacts.vue';
import Show from './pages/posts/Show.vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {path: '/home', component: Home, name: 'home.index', meta: {title: 'home', linkText:'home'}},
        {path: '/contacts', component: Contacts, name: 'contacts.index', meta: {title: 'contacts', linkText:'contacts'}},
        {path: '/posts/:post', component: Show, name: 'posts.show', meta: {title: 'dettagli'}}
    ]
});

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    next();
})

export default router;
