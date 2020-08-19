const { default: Axios } = require("axios");

const pageHome = document.querySelector('#page-home');
const pageUpload = document.querySelector('#page-upload');
const pageList = document.querySelector('#page-list');

const navDropDown = document.querySelector('#navDropDown');

const formFileUpload = document.querySelector('#btnUploadImage');
const formTitle = document.querySelector('#fieldUploadTitle');

document.querySelector('#menu').onclick = function() {  
  navDropDown.classList.remove('expandable');
}

document.querySelector('#menuClose').onclick = function() {
  navDropDown.classList.add('expandable');
}

document.querySelector('#btnAddPost').onclick = function() {
  pageHome.classList.add('hide');
  pageUpload.classList.remove('hide');
}

formFileUpload.onchange = function() {
  this.parentElement.classList.add('changed');
}

document.querySelector('#btnFormSubmit').onclick = async function() {
  const image = formFileUpload.files[0];
  const title = formTitle.value;

  const form = new FormData;
  form.append('image', image);
  form.append('title', title);

}
