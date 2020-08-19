const pageHome = document.querySelector('#page-home');
const pageUpload = document.querySelector('#page-upload');
const pageList = document.querySelector('#page-list');

const navDropDown = document.querySelector('#navDropDown');

const formLogin = document.querySelector('#formLogin');
const formFileUpload = document.querySelector('#btnUploadImage');
const formTitle = document.querySelector('#fieldUploadTitle');

const btnLogout = document.querySelector('#btnLogout');

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

document.querySelector('#navPostsPage').onclick = function() {
  fetchAllPosts()
  pageHome.classList.add('hide');
  pageList.classList.remove('hide');
}

document.querySelectorAll('.navHome').forEach(nav => nav.onclick = function() {
  navDropDown.classList.add('expandable');
  pageList.classList.add('hide');
  pageHome.classList.remove('hide');
});

if (formLogin) formLogin.onsubmit = async function(e) {
  e.preventDefault();

  const email = this.querySelector('input[type="text"]').value;
  const password = this.querySelector('input[type="password"]').value;

  try {
    const res = await axios.post('http://localhost:8000/api/v1/login', {email, password});
    
    if (res) window.location = '/';
  } catch (error) {
    console.log(error);
  }
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

  try {
    const token = document.querySelector('meta[token]').getAttribute('token');
    const res = await axios.post('http://localhost:8000/api/v1/posts', form, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });

    pageUpload.classList.add('hide');
    pageList.classList.remove('hide');

    formTitle.value = '';
    formFileUpload.files = [];
    formFileUpload.parentElement.classList.remove('changed');

    fetchAllPosts();
  } catch (error) {
    console.log(error.response);
  }
}

async function submitLove(post_id) {
  try {
    const token = document.querySelector('meta[token]').getAttribute('token');
    const res = await axios.patch(`http://localhost:8000/api/v1/posts/${post_id}/like`, {}, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });
  } catch (error) {
    console.log(error.response || error);
  }
}

async function removeLove(post_id) {
  try {
    const token = document.querySelector('meta[token]').getAttribute('token');
    const res = await axios.delete(`http://localhost:8000/api/v1/posts/${post_id}/like`, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });
  } catch (error) {
    console.log(error.response || error);
  }
}

async function fetchAllPosts() {
  try {
    const token = document.querySelector('meta[token]').getAttribute('token');
    const res = await axios.get('http://localhost:8000/api/v1/posts', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });

    const postContainer = document.querySelector('.post-container');
    postContainer.innerHTML = '';

    res.data.posts.forEach(post => {
      const postItem = document.createElement('div');
      postItem.className = 'post-item';
  
      const postItemImage = document.createElement('div');
      postItemImage.style.backgroundImage = `url("/dist/img/${post.image}")`;
      postItemImage.className = 'post-item-image';
  
      const postItemLove = document.createElement('div');
      postItemLove.className = 'post-item-love';
      if (post.liked) postItemLove.classList.add('active');
      postItemLove.setAttribute('data-post', post.id);
      postItemLove.onclick = function() {
        if (!this.classList.contains('active')) {
          submitLove(this.dataset.post);    
          this.classList.add('active');
        } else {
          removeLove(this.dataset.post);
          this.classList.remove('active');
        }
      }
      
      const heartBtn = document.createElement('a');
      heartBtn.className = 'btn-heart';
      heartBtn.innerHTML = '<i class="fas fa-heart">';
  
      const postItemTitle = document.createElement('div');
      postItemTitle.className = 'post-item-title';
      postItemTitle.innerText = post.title;

      postItemLove.appendChild(heartBtn);
      postItemImage.appendChild(postItemLove);
      postItem.appendChild(postItemImage);
      postItem.appendChild(postItemTitle);
      postContainer.appendChild(postItem);
    });
  } catch (error) {
    console.log(error);
  }
}

if (btnLogout) btnLogout.onclick = async function() {
  try {
    const res = await axios.post('http://localhost:8000/api/v1/logout');
    
    if (res) window.location = '/';
  } catch (error) {
    console.log(error.response || error);
  }
}