<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/645a61c794.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/dist/css/style.css">
  <title>Redaco</title>
  @if(isset($token))
    <meta token={{$token}}>
  @endif
</head>
<body>
  <div id="page-home">
    <nav class="nav">
      <div class="nav-container">
        <div class="nav-item">
          <h2><a href="#" class="navHome">Redaco</a></h2>
        </div>
        <div class="nav-item right">
          <h2><a href="#" id="menu"><i class="fas fa-bars"></i></a></h2>
        </div>
      </div>
    </nav>
    <div id="navDropDown" class="nav expandable">
      <div class="nav-dropdown">
        <div class="nav-dropdown-action">
          <h1><a href="#" id="menuClose"><i class="fas fa-times"></i></a></h1>
        </div>
        @if(!isset($token) || $token === 'logged out')
          <div class="nav-dropdown-form">
            <form id="formLogin">
              <div class="nav-form">
                <h2>Login</h2>
              </div>
              <div class="nav-form">
                <input type="text" placeholder="Email">
              </div>
              <div class="nav-form">
                <input type="password" placeholder="Password">
              </div>
              <div class="nav-form right">
                <input type="submit" value="Login">
              </div>
            </form>
          </div>
        @else
          <div class="nav-dropdown-logout">
            <h2><a href="#" id="btnLogout">Logout</h2></a>
          </div>
        @endif
        <div class="nav-dropdown-posts">
          <h2><a href="#" id="navPostsPage">Posts</h2></a>
        </div>
        <div class="nav-dropdown-theme">
          <div class="nav-dropdown-theme-item middle">
            <h2>Dark mode</h2>
          </div>
          <div class="nav-dropdown-theme-item right">
            <h1><i class="fas fa-toggle-off"></i></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="jumbotron">
        <h1>We are Redaco, Hello Dribble.</h1>
      </div>
      <div class="banner"></div>
      <div class="action">
        <a href="#" id="btnAddPost"><img class="action-add" src="/dist/img/button-dribbble.svg"></a>
      </div>
    </div>
  </div>

  <div id="page-upload" class="hide">
    <form class="form-upload" enctype="multipart/form-data">
      <div class="form-upload-image">
        <h2>Upload Image</h2>
        <div class="form-upload-image-btn">
          <i class="fas fa-upload"></i>
          <input type="file" name="image" id="btnUploadImage">
        </div>
      </div>
      <div class="form-upload-title">
        <h2>Title</h2>
        <input type="text" name="title" id="fieldUploadTitle" placeholder="Basketball dribbble session">
      </div>
    </form>
    <div class="form-submit">
      <a href="#" id="btnFormSubmit"><h2>Publish</h2></a>
    </div>
  </div>

  <div id="page-list" class="hide">
    <nav class="nav">
      <div class="nav-container">
        <div class="nav-item">
          <h2><a href="#" class="navHome">Redaco</a></h2>
        </div>
      </div>
    </nav>
    <div class="post-container"></div>
  </div>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="/dist/js/app.js"></script>
</body>
</html>