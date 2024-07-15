/* 
* Developed by Hero Expert 
* Telegram channel: @HeroExpert_ir
*/

let $=document
const confirmBtn=$.querySelector('.signIn-btn');const usernameDiv=$.querySelector('.username-input-div');const passwordDiv=$.querySelector('.password-input-div');const usernameInput=$.querySelector('.username-input');const passwordInput=$.querySelector('.password-input');const eyeIcon=$.querySelector('#eye-icon')
const eyeSlashIcon=$.querySelector('#eye-slash-icon')
const eyeIconContainer=$.querySelector('.eye-icon-container')
const eyeSlashIconContainer=$.querySelector('.eye-slash-icon-container')
const iconsContainer=$.querySelector('.icons')
confirmBtn.addEventListener('click',event=>{if(usernameInput.value.length<1){event.preventDefault()
usernameDiv.classList.add('alert-validate')}
if(passwordInput.value.length<1){event.preventDefault()
passwordDiv.classList.add('alert-validate')}})
usernameDiv.addEventListener('click',event=>{event.preventDefault()
usernameDiv.classList.remove('alert-validate')
usernameInput.focus()})
passwordDiv.addEventListener('click',event=>{event.preventDefault()
passwordDiv.classList.remove('alert-validate')
passwordInput.focus()})
usernameInput.addEventListener('keypress',event=>{let word=event.keyCode
console.log(word)
if((word<65||word>90)&&(word<48||word>57)&&(word<97||word>122)&&word!=32&&word!=46&&word!=64&&word!=45&&word!=95){event.preventDefault()}})
passwordInput.addEventListener('keyup',event=>{if(passwordInput.value.length>0){iconsContainer.classList.remove('d-none')}else{iconsContainer.classList.add('d-none')}})
window.addEventListener('click',event=>{if(event.target.id==='eye-icon'||event.target.parentElement.id==='eye-icon'){eyeIconContainer.classList.remove('show-icon')
eyeSlashIconContainer.classList.add('show-icon')
passwordInput.removeAttribute('type')
passwordInput.setAttribute('type','password')}
if(event.target.id==='eye-slash-icon'||event.target.parentElement.id==='eye-slash-icon'){eyeSlashIconContainer.classList.remove('show-icon')
eyeIconContainer.classList.add('show-icon')
passwordInput.removeAttribute('type')
passwordInput.setAttribute('type','text')}})