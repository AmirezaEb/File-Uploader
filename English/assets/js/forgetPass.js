/* 
* Developed by Hero Expert 
* Telegram channel: @HeroExpert_ir
*/

let $ = document

// const confirmBtn = $.querySelector('.forget-btn');
const confirmBtn = $.querySelector('.forget-btn');
const usernameDiv = $.querySelector('.username-input-div');
const usernameInput = $.querySelector('.username-input');


confirmBtn.addEventListener('click', event => {
    const emailRegex = /^\w+([\.-]?\w)*@\w+([\.-]?\w)*(\.\w{2,3})+$/;
    let emailTrust = emailRegex.test(usernameInput.value)

    if (usernameInput.value.length < 1 || !emailTrust) {
        event.preventDefault()
        usernameDiv.classList.add('alert-validate')
    }
})

usernameDiv.addEventListener('click', event => {
    event.preventDefault()
    usernameDiv.classList.remove('alert-validate')
    usernameInput.focus()
})

usernameInput.addEventListener('keyup', (e) => {
    const emailRegex = /^\w+([\.-]?\w)*@\w+([\.-]?\w)*(\.\w{2,3})+$/;
    let emailTrust = emailRegex.test(usernameInput.value)

    if (emailTrust) {
        emailDiv.classList.remove('alert-validate')
    }
})

/* 
* Developed by Hero Expert 
* Telegram channel: @HeroExpert_ir
*/