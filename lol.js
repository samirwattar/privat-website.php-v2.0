const box = document.querySelector('.box');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnLink = document.querySelector('.button-login');
const closeLink = document.querySelector('.icon-close');

registerLink.addEventListener('click', ()=>{
    box.classList.add('active');
});

loginLink.addEventListener('click', ()=>{
    box.classList.remove('active');
});
btnLink.addEventListener('click', ()=>{
    box.classList.add('active-btn');
});

closeLink.addEventListener('click', ()=>{
    box.classList.remove('active-btn');
});