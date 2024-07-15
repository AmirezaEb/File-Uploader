let $=document
const confirmBtn=$.querySelector('.signUp-btn')
const usernameDiv=$.querySelector('.username-input-div')
const emailDiv=$.querySelector('.email-input-div')
const passwordDiv=$.querySelector('.password-input-div')
const usernameInput=$.querySelector('.username-input')
const emailInput=$.querySelector('.email-input')
const passwordInput=$.querySelector('.password-input')
const eyeIcon=$.querySelector('#eye-icon')
const eyeSlashIcon=$.querySelector('#eye-slash-icon')
const eyeIconContainer=$.querySelector('.eye-icon-container')
const eyeSlashIconContainer=$.querySelector('.eye-slash-icon-container')
const iconsContainer=$.querySelector('.icons')
confirmBtn.addEventListener('click',event=>{const emailRegex=/^\w+([\.-]?\w)*@\w+([\.-]?\w)*(\.\w{2,3})+$/;let emailTrust=emailRegex.test(emailInput.value)
if(usernameInput.value.length<1){event.preventDefault()
usernameDiv.classList.add('alert-validate')}
if(emailInput.value.length<1||!emailTrust){event.preventDefault()
emailDiv.classList.add('alert-validate')}
if(passwordInput.value.length<1){event.preventDefault()
passwordDiv.classList.add('alert-validate')}})
usernameDiv.addEventListener('click',event=>{event.preventDefault()
usernameDiv.classList.remove('alert-validate')
usernameInput.focus()})
emailDiv.addEventListener('click',event=>{event.preventDefault()
emailDiv.classList.remove('alert-validate')
emailInput.focus()})
passwordDiv.addEventListener('click',event=>{event.preventDefault()
passwordDiv.classList.remove('alert-validate')
passwordInput.focus()})
usernameInput.addEventListener('keypress',event=>{let word=event.keyCode
console.log(word)
if((word<65||word>90)&&(word<97||word>122)&&word!=32&&word!=45&&word!=95){event.preventDefault()}})
emailInput.addEventListener('keyup',(e)=>{const emailRegex=/^\w+([\.-]?\w)*@\w+([\.-]?\w)*(\.\w{2,3})+$/;let emailTrust=emailRegex.test(emailInput.value)
if(emailTrust){emailDiv.classList.remove('alert-validate')}})
passwordInput.addEventListener('keyup',event=>{if(passwordInput.value.length>0){iconsContainer.classList.remove('d-none')}else{iconsContainer.classList.add('d-none')}})
window.addEventListener('click',event=>{if(event.target.id==='eye-icon'||event.target.parentElement.id==='eye-icon'){eyeIconContainer.classList.remove('show-icon')
eyeSlashIconContainer.classList.add('show-icon')
passwordInput.removeAttribute('type')
passwordInput.setAttribute('type','password')}
if(event.target.id==='eye-slash-icon'||event.target.parentElement.id==='eye-slash-icon'){eyeSlashIconContainer.classList.remove('show-icon')
eyeIconContainer.classList.add('show-icon')
passwordInput.removeAttribute('type')
passwordInput.setAttribute('type','text')}})

/* 
* Developed by Hero Expert 
* Telegram channel: @HeroExpert_ir
*/