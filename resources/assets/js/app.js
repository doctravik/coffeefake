
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });

let authMenu = document.getElementById('auth-menu');
let navToggle = document.getElementById('nav-toggle');

if(authMenu && navToggle) {
    navToggle.addEventListener('click', function() {
        authMenu.classList.toggle('is-active');
    });
}

let modal = document.querySelector('.modal');
let modalClose = document.querySelector('.modal-close');
let modalBackground = document.querySelector('.modal-background');

if(modal && modalClose) {
    modalClose.addEventListener('click', function() {
        modal.classList.remove('is-active');
    });

    modalBackground.addEventListener('click', function() {
        modal.classList.remove('is-active');
    });
}