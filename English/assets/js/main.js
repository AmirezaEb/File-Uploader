/* 
* Developed by Hero Expert 
* Telegram channel: @HeroExpert_ir
*/

const $ = document

let loaderWrapper = $.querySelector('.loading-wrapper')

let fileInput = $.querySelector('#fileToUpload')
let uploaderFileDivElem = $.querySelector('.uploaded-div')
let fileName = $.querySelector('.file-details-name-link')
let fileSize = $.querySelector('.file-details-size')
let inputparag = $.querySelector('form p')
let checkIcon = $.querySelector('.check-icon')
let deleteBtn = $.querySelector('.delete-icon')
let uploadBtn = $.querySelector('#upload-btn')
let fileFlag = 0

window.addEventListener('load', event => {
  setTimeout(() => {
    loaderWrapper.classList.add('loading-wrapper-off')
  }, 1500)
})

fileInput.addEventListener('click', (event) => {
  fileInput.value = ''
})

fileInput.addEventListener('change', (event) => {
  uploaderFileDivElem.style.cssText = 'display: flex;';
  fileName.innerHTML = fileInput.files[0].name;

  if (fileInput.files[0].size > 0 && fileInput.files[0].size < 1024) {
    fileSize.innerHTML = (fileInput.files[0].size).toFixed(1) + " B";
  } else if (fileInput.files[0].size < 1000024 && fileInput.files[0].size > 1024) {
    fileSize.innerHTML = (fileInput.files[0].size / 1024).toFixed(1) + " KB";
  } else if (fileInput.files[0].size > 1000024) {
    fileSize.innerHTML = (fileInput.files[0].size / 1000024).toFixed(1) + " MB";
  }

  inputparag.innerHTML = 'The file was successfully selected!'
  fileFlag = 0
})

uploadBtn.addEventListener('click', (event) => {
  let isFileUploaded = fileInput.value;
  console.log(isFileUploaded)
  if (isFileUploaded) {
    inputparag.innerHTML = "";
    inputparag.classList.add('LH-custom');
    checkIcon.style.display = 'inline';
  } else {
    event.preventDefault()
    Swal.fire({
      title: 'Please Select Your File!',
      icon: 'error',
      toast: true,
      width: '31em',
      position: 'top-start',
      showConfirmButton: false,
      timer: 3500,
      background: '#a586f0',
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      }
    })
  }
})

deleteBtn.addEventListener('click', (event) => {
  inputparag.innerHTML = 'Drag your file here or click here.'
  uploaderFileDivElem.style.display = 'none'
  inputparag.classList.remove('LH-custom');
  checkIcon.style.display = 'none'
})

var clipboard = new ClipboardJS('.copyBtn');
let copyBtn = document.querySelectorAll('.copy-link')

clipboard.on('success', function (e) {
  e.clearSelection();
});

clipboard.on('error', function (e) {
  console.error('Action:', e.action);
  console.error('Trigger:', e.trigger);
});

const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

/* 
* Developed by Hero Expert 
* Telegram channel: @HeroExpert_ir
*/