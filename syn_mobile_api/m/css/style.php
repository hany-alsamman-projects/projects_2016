/* less codes */
@bgColor: #fafafa;
@lightBgColor: #666;
@whiteColor: #fff;
@grayColor: #ccc;
@darkGrayColor: #ccc;

@primaryColor: #199dd4;
@secondaryColor: #c9b008;
@tertiaryColor: #EB8023;
@typoColor: #333;


/* website fonts */

@font-face {
    font-family: 'RobotoLight';
    src: url('../fonts/Roboto-Light-webfont.eot');
    src: url('../fonts/Roboto-Light-webfont.eot?#iefix') format('embedded-opentype'),
         url('../fonts/Roboto-Light-webfont.woff') format('woff'),
         url('../fonts/Roboto-Light-webfont.ttf') format('truetype'),
         url('../fonts/Roboto-Light-webfont.svg#RobotoLight') format('svg');
    font-weight: normal;
    font-style: normal;
}

.gradient(@color1, @color2){
  background: -moz-linear-gradient(top,  @color1 0%, @color2 100%); /* FF3.6+ */
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,@color1), color-stop(100%,@color2)); /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(top,  @color1 0%,@color2 100%); /* Chrome10+,Safari5.1+ */
  background: -o-linear-gradient(top,  @color1 0%,@color2 100%); /* Opera 11.10+ */
  background: -ms-linear-gradient(top,  @color1 0%,@color2 100%); /* IE10+ */
  background: linear-gradient(to bottom,  @color1 0%,@color2 100%); /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=@color1, endColorstr=@color2,GradientType=0 ); /* IE6-8 */  
}

.box-sizing{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -o-box-sizing: border-box;
    *behavior: url(/js/boxsizing.htc);  
}

.shadowMe(@params){
  box-shadow: @params;
  -webkit-box-shadow: @params;
  -moz-box-shadow: @params;
  -o-box-shadow: @params;
  
  /*-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=5, Color='#ccc')";*/
  /*filter: progid:DXImageTransform.Microsoft.Shadow(Strength=5, Direction=5, Color='#ccc');*/
  /*behavior: url(PIE.htc);*/
}


.borderRadiusMe(@params){
  border-radius: @params;
  -webkit-border-radius: @params;
  -moz-border-radius: @params;
  -o-border-radius: @params;
  
}

body {
  background: @primaryColor;
  
}
body, body * {
    font-family: 'Roboto', "sans-serif" !important;
}

#container {
  width: 100%;
  height: 100%;
  
  .main-nav-container {
    text-shadow: 1px 1px 2px #000;
    overflow: hidden;
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: 7800;
    
    .loading-progress {
      color: #fff;
      text-align: center;
      display: none;
      padding: 10px;
      display: none;
    }
    .flexslider {
      margin: 0 auto;
      width: 100%;
      margin-top: 10px !important;
      
      .flex-control-nav {
        margin-top: 10px;
      }
      .flex-caption {
        text-align: center;
        margin: 0;
        margin-top: 8px;
        font-size: 14px;
        color: #fff;
      }
      .slides {
        text-align: center;
        
        li {
          position: relative;
          float: left;
          display: block;
          margin: 10px;
          margin-left: 13px;
          margin-bottom: 15px;
        }
      }
      .slides img {
        border: none !important;
        width: 48px;
        margin: 0 auto;
      }

    }
  }
}

/* custom css */

.page-loader {
  display: none;
}
.main-area {
  text-align: center;
  
  img.wallpaper {
    position: fixed;
    z-index: -1;
    left: 0;
    opacity: 0.9;
  }
  img.logo {
    position: fixed;
    margin: 0 auto;
    bottom: 20%;
    left: 50%;
    margin-left: -65px;
  }
}

.footer-menu {
  display: none;
  width: 100%;
  height: 100%;
  bottom: 0;
  left: 0;
  z-index: 7000;
  position: fixed;
  
  .footer-menu-bg {
    background: #000;
    width: 100%;
    height: 130%;
    top: -20%;
    position: absolute;
    opacity: 0.85;
    -moz-opacity: 0.85;
    -o-opacity: 0.85;
    
    z-index: 7700;
  }
  .footer-menu-content {
    display: none;
    position: absolute;
    right: 0;
    bottom: 50px;
    z-index: 7900;
    ul {
      padding: 0;
      margin: 0;
      
      li {
        margin-bottom: 10px;
        list-style: none;
        
        a, p {
          color: #fff;
          text-transform: lowercase;
          padding-right: 40px;
          font-size: 17px;
        }
        p {
          border-bottom: 1px solid #666;
          padding-bottom: 3px;
          margin-bottom: 13px;
          color: #999;
          font-size: 13px;
          margin-top: 15px;
        }
      }
    }
  }
}


footer {
  z-index: 8000;
  position: fixed;
  display: none;
  bottom: 0;
  height: 44px;
  width: 100%;
  .shadowMe(0px 0px 4px 2px #222);
  
  #footer-bg {
    .gradient(lighten(#000, 20%), #000);
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 1;
  }
  
  #search-box {
    display: none;
    position: fixed;
    bottom: 48px;
    font-size: 18px;
    text-align: center;
    width: 100%;
    
    form {
      text-align: center;
      ::-webkit-input-placeholder {
          color:    #444;
      }
      :-moz-placeholder {
        color:    #444;
      }
      :-ms-input-placeholder {
        color:    #444;
      }
      
      input {
        border: 5px solid #3b3939;
        border-radius: 5px;
        padding: 2%;
        color: #fff;
        line-height: normal;
        background: #000;
        text-align: center;
        outline: none;
      }
    }
    
  }
  
  #footer-links {
    
    a {
      position: absolute;
      height: 100%;
      padding: 7px;
      display: block;
      .box-sizing;
      
      img {
        width: 32px;
      }
      
    }
    a.hover, a.active {
      background: lighten(#000, 20%);
    }
    a.left-icon {
      left: 0;
    }
    a.right-icon {
      right: 0;
    }
    a.middle-icon {
      left: 50%;
      margin-left: -16px;
    }
  }
}

#footer {
  height: 54px;
  
}


#splash {
    background: @primaryColor;
    width: 100%;
    height: 120%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 10000;

    #splash-content {
        margin: 0 auto;
    }

    img#splash-bg {
        width: 100%;
        height: 100%;
        position: absolute;
        opacity: 0.6;
    }
    #splash-title,img#splash-footer {
        position: absolute; 
    }
    #splash-title {
        img {
            width: 100%;
            margin-bottom: 3px;
        }
        color: @whiteColor !important;
        positiom: absolute;
        text-align: center;
        width: 143px;
        bottom: 20%;
        left: 50%;
        margin-left: -71px;
        font-family: arial;
    }
}




/* ==============================*/
/* Styles for Contact Page */
/* ==============================*/

.address-container {
  background: @whiteColor;
  .shadowMe(1px 1px 5px 0px #ccc);
  padding: 4%;
  
  margin: 4%;
  
  iframe {
    width: 100%;
    height: 180px;
    border: none;
  }
  p {
    margin: 0;
    margin-bottom: 3%;
    color: @typoColor !important;
    img {
      width: 16px;
      height: 16px;
      margin-right: 10px;
    }
  }
  a {
    color: @typoColor !important;
  }
  
}
.address-container.map-container {
    padding: 4px 4px 0 4px;
}
.address-container.contact-icon {
  background: @whiteColor url(../images/contact.png?) no-repeat 90% 30%;
}
.map-container {
  overflow: hidden;
}


form {
  .form-element {
    margin-bottom: 10px;
    
    label {
      display: block;
      color: #777;
      text-transform: uppercase;
    }
    input, textarea {
      border: 1px solid #ddd;
      border-radius: 0 !important;
      background: none;
      padding: 5px;
      color: #444;
      width: 95%;
      color: @typoColor;
      outline-color: #ccc;
      ::-webkit-input-placeholder {
        color:    #ddd;
      }
      :-moz-placeholder {
        color:    #ddd;
      }
      :-ms-input-placeholder {
        color:    #ddd;
      }
    }
    input.invalid, textarea.invalid {
      border-color: red;
    }
  }
  
}


/* ==============================*/
/* Styles for Portfolio Page */
/* ==============================*/
.page {
  .list-grid {
  }
  .list-summary, .list-grid {
    a {
      color: #ccc !important;
    }
    a.active {
      color: @primaryColor !important;
    }
  }
}
.portfolio {
  padding: 0;
  margin: 0;
  margin-top: 2%;
  margin-left: 2%;
  
  li {
    display: inline-block;
    float: left;
    list-style: none;
    width: 33%;
    position: relative;
    
    span {
      background: #000;
      color: #fff;
      opacity: 0.7;
      display: block;
      position: absolute;
      padding: 3%;
    }
    
    a {
      display: block;
      margin-bottom: 4%;
      overflow: hidden;
      margin-right: 4%;
    }
    a.last {
      amargin-right: 0;
    }
    a.hover {
      border-color: #555;
    }
    img {
      width: 100%;
      height: auto;
      border: none;
    }
  }
}
.portfolio.list {
  li {
    display: block;
    list-style: none;
    width: 100%;
    max-height: 73px;
    overflow: hidden;
    margin: 2px 0;
    
    a {
      margin-right: 0;
    }
    img {
    }
    span {
      padding: 1%;
    }
  }
}


/* ==============================*/
/* Styles for Blog Page */
/* ==============================*/
.blog-article.list {
  .article-header {
    border-bottom: none;
  }
  .article-body {
    display: none;
  }
}
.blog-article {
  .shadowMe(1px 1px 5px 0px #666);
  margin-bottom: 20px;
  
  
  .article-header {
    padding: 4%;
    background: @bgColor;
    border-bottom: 1px solid @whiteColor;
    
    .title {
      text-transform: uppercase;
      color: @primaryColor;
      margin: 0 !important;
    }
    .info {
      color: #666;
      margin: 0 !important;
      
      span {
        color: #aaa;
      }
    }
  }

  .article-body {
    background: @bgColor !important;
    padding: 4%;
    img {
      float: right;
      margin: 0 0 10px 10px;
      width: 64px;
      height: auto;
    }
    img.left {
      float: left;
    }
    img.right {
      float: right;
    }
    .text {
    }
  }
  .article-footer {
    background: @bgColor !important;
    padding: 4%;
    padding-top: 0;
    
    .tags {
      margin-top: 9px;
      
      span {
        background: @primaryColor;
        color: #fff;
        padding: 3px 6px;
        margin-left: 5px;
        .borderRadiusMe(5px);
      }
    }
  }
}

/* ==============================*/
/* General Styles */
/* ==============================*/

/* Utility css */
a{
  text-decoration: none;
}

.left{
  float: left;
}
.right{
  float: right;
}
.clear {
  clear: both;
}

.alpha{
  margin-left: 0 !important;
}
.omega{
  margin-right: 0 !important;
}
.hidden {
    display: none;
}

.slider-container {
  width: 100%;
}


  

#container {
  margin: 0 auto;
  
  .page {
    color: @typoColor;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: auto;
    background: @bgColor;
    background-size: 100% 100%;
    display: none;
    .box-sizing;
    
    .page-nav {
      display: none; /* displayed via media query only for larger devices  */
    }
    .page-content {
      overflow: scroll;
      margin-top: 40px;
      padding-bottom: 8%;
      background: transparent;
      
      .box-sizing;
      height: 100%;
      
      .sub-content {
        padding: 7%;
      }
    }
    
    a {
      color: @primaryColor;
    }
    h2 {
      color: @primaryColor;
      font-size: 28px;
      margin: 0;
      margin-bottom: 4%;
      line-height: 30px;
      font-weight: normal;
      font-weight: normal;
      
      strong {
        color: @primaryColor;
        font-weight: normal;
      }
    }
    h2:first-child {
        .gradient(#fff, @bgColor);
        .gradient(#000, lighten(#000, 20%));
        margin: 0;
        top: 0;
        width: 100%;
        z-index: 100;
        text-transform: uppercase;
        text-align: center;
        line-height: normal;
        padding: 10px 0;
        position: fixed;
        .shadowMe(0px 0px 4px 2px rgba(0,0,0,0.6));
        margin-bottom: 20px;
        color: #fff !important;
        strong {
            color: #fff !important;
        }
        display: block;
        font-size: 13px !important;

        .list-grid, .list-summary {
            position: absolute;
            top: 11px;
            right: 25px;
        }
    }
    h3 {
      margin-bottom: 8px;
      color: @primaryColor;
      font-weight: normal;
    }
    p {
      margin: 0 0 4% 0;
      line-height: 20px;
      
      strong {
        color: @primaryColor;
        font-weight: normal;
        text-transform: lowercase;
      }
      img.wrap-around {
        float: left;
        background: transparent;
        padding: 10px 10px 10px 0;
        margin-right: 14px;
        margin-bottom: 4px;
      }
      
    }
    .subpage-header-img-container {
      max-height: 147px;
      overflow: hidden;
    }
    .subpage-header-image {
      width: 100%;
    }
    
    .icon-text {
      display: block;
      margin-bottom: 7px;
      min-height: 86px;
      
      p {
        strong {
          font-weight: normal;
          line-height: 35px;
          text-transform: none;
        }
      }
    }
      
    .slider-component {
      
      .flexslider {
        margin-bottom: 4%;
        
        .flex-caption {
          position: absolute;
          bottom: 0;
          background: rgba(255,255,255,0.8);
          color: @typoColor;
          border: 1px solid @grayColor;
          padding: 4px 6px;
          margin: 10px;
        }
      }
    }
    .divider {
      height: 1px;
      background: #cccccc;
      margin: 12px 0;
      border-bottom: 1px solid #fff;
    }
    
    
    
    
  }
  
  /* styles for responsive layout (ipad) */
  @media only screen and (min-width: 650px) {
    .main-nav-container {
      .flexslider {
      }
    }
    
    .list-grid {
      margin-right: 0;
    }
    
    .portfolio.list {
      li {
        max-height: 121px;
      }
    }
    
    ul.nav-list li a {
        padding: 4%;
    }
    .wider.page {
      .loading-progress {
        margin: 5%;
        
      }
      .page-content {
        width: 100%;
        float: right;
        
        .sub-content {
            padding: 4%;
        }
      }
      .page-nav {
        display: block;
        width: 30%;
        float: left;
        height: 100%;
        background: #f5f5f5;
        
        h2 {
          margin: 10% 5%;
        }
        
        ul {
          margin: 0;
          padding: 0;
          
          li {
            background: #e8e5e5;
            list-style: none;
            a {
              text-transform: lowercase;
              color: @primaryColor;
              display: block;
              .box-sizing;
              padding: 5% 5%;
              margin-bottom: 2px;
              font-size: 16px;
              
              span {
                float: right;
                font-family: "monaco";
                font-weight: bold;
                font-size: 14px;
                line-height: 17px;
              }
            }
            a.active, a.hover {
              background: #fff;
            }
          }
        }
      }
    
    }
  }
  
  /* styles for responsive layout (desktop) */
  @media only screen and (min-width: 1025px) {
    font-size: 16px;
    .page {
      max-width: 1000px;
      left: 50%;
      margin-left: -500px;
      margin-top: 50px;
      .shadowMe(0px 0px 12px 4px #222);
    }
    .wallpaper {
    }
    footer {
      bottom: auto;
      top: 0;
      
      #footer-bg {
        .gradient(#000, lighten(#000, 20%));
      }
    }
    .footer-menu-content {
      bottom: auto;
      top: 50px !important;
    }
    
    .main-nav-container {
       margin-top: 40px;
       margin-left: 40px;
      .flexslider {
        width: 100%;
        .flex-disabled {
          display: none;
        }
      }
    }
  }
  
}
.content{
  margin: 8px;
}



/* ==============================*/
/* Typography Styles for About Page */
/* ==============================*/

.justify {
  text-align: justify;
}
.column-text {
  .two-column-first, .two-column-second {
    width: 47%;
    float: left;
  }
  .two-column-first {
    padding-right: 2%;
  }
  .two-column-second {
    padding-left: 2%;
  }
  
  .three-column-first, .three-column-second, .three-column-third {
    width: 30%;
    float: left;
  }
  .three-column-first {
    padding-right: 4%;
  }
  .three-column-second {
    padding-right: 4%;
  }
  .three-column-third {
    
  }
}

/* Navigable List Styles */
ul.nav-list {
    border-radius: 7px;
    padding: 0;
    overflow: hidden;
    border: 1px solid @darkGrayColor;
}
ul.nav-list li {
    margin: 0;
    border-bottom: 1px solid @darkGrayColor;
}
ul.nav-list li:last-child {
    border: 0px;
}
ul.nav-list li a {
    background: @bgColor;
    padding: 4%;
    display: block;
    color: @typoColor !important;
}
ul.nav-list li a.hover {
    background: @primaryColor;
    color: #fff !important;
}
ul.nav-list li a span {
    float: right;
    font-family: "monaco";
    font-weight: bold;
    font-size: 14px;
    line-height: 17px;
}
ul.nav-list2 li a {
  background: @typoColor !important;
  color: @bgColor !important;
}
ul.nav-list2 li a.hover {
  background: @bgColor !important;
  color: @typoColor !important;
}


/* Button Styles */
.button {
  display: inline-block;
  padding: 6px 10px;
  margin-bottom: 2px;
  .borderRadiusMe(5px);
  
}
.button1 {
  .gradient(@typoColor, darken(@typoColor, 5%));
  color: @bgColor !important;
  border: 1px solid @whiteColor;
}
.button1.hover {
  .gradient(darken(#F9F6F6, 5%), #F9F6F6);
}
.button3 {
  .gradient(lighten(@primaryColor, 10%), @primaryColor);
  color: @bgColor !important;
  border: 1px solid @primaryColor;
}
.button3.hover {
  .gradient(@primaryColor, lighten(@primaryColor, 10%));
}

.button2 {
  .gradient(lighten(#000, 30%), #000);
  color: #fff !important;
  border: 1px solid #000;
}
.button2.hover {
  .gradient(#000, lighten(#000, 30%));
}

.button4 {
  .gradient(@primaryColor, darken(@primaryColor, 5%));
  color: @bgColor !important;
  border: 1px solid @primaryColor;
}
.button4.hover {
  .gradient(darken(@primaryColor, 5%), @primaryColor);
}


.button5 {
  .gradient(@tertiaryColor, darken(@tertiaryColor, 5%));
  color: #fff !important;
  border: 1px solid @tertiaryColor;
}
.button5.hover {
  .gradient(darken(@tertiaryColor, 5%), @tertiaryColor);
}


.button6 {
  .gradient(lighten(#444, 30%), #444);
  color: #fff !important;
  border: 1px solid #444;
}
.button6.hover {
  .gradient(#444, lighten(#444, 30%));
}

/* Highlight Styles */
.highlight {
  background-color: @primaryColor;
  color: @bgColor;
  text-shadow: none;
  margin-top: 5px;
  padding: 0px;
}
.white-highlight {
  background-color: #EFECEC;
}
.black-highlight {
  background-color: #000;
  color: #fff;
}
.secondary-highlight {
  background-color: @primaryColor;
}
.tertiary-highlight {
  background-color: @tertiaryColor;
}

/* Table Styles */
table {
    border: 1px solid @grayColor;
    margin-bottom: 5px;
}
table td, table th {
    padding: 5px 9px;
    text-align: left;
    font-weight: normal;
}

table.table1 th {
    color: @primaryColor;
    font-weight: normal;
}
table.table1 td, table.table1 th {
    .gradient(@bgColor, lighten(@bgColor, 5%));
}

table.table2 td, table.table2 th {
    background: @bgColor;
}
table.table2 th {
    border-bottom: 1px solid @grayColor;
}

table.table3 td, table.table3 th {
    background: @whiteColor;
}
table.table3 th {
    background: @typoColor;
    color: @bgColor;
}


/* Bullet Styles */
ul.bullet-1, ul.bullet-2, ul.bullet-3, ul.bullet-4 {padding: 0 0 0 15px;}
ul.bullet-1 li, ul.bullet-2 li, ul.bullet-3 li, ul.bullet-4 li {list-style: none;padding: 0 0 3px 15px;margin: 0 0 5px;background: no-repeat 0 4px;}
ul.bullet-1 li a, ul.bullet-2 li a, ul.bullet-3 li a, ul.bullet-4 li a {font-size: 100%;line-height: 1.7;}
ul.bullet-1 li {background-image: url(../images/bullet1.png);}
ul.bullet-2 li {background-image: url(../images/bullet2.png);}
ul.bullet-3 li {background-image: url(../images/bullet3.png);}
ul.bullet-4 li {background-image: url(../images/bullet4.png);}

/* Notice Styles */
pre  {background: #F9F1ED;border-bottom: 1px solid #DCD7D4;border-right: 1px solid #DCD7D4;color: #AC3400;font-style:italic;overflow: auto;padding: 10px;}
.cssstyle-style1 pre, .cssstyle-style3 pre, .cssstyle-style5 pre {background: #333;border-bottom: 1px solid #3a3a3a;border-right: 1px solid #3a3a3a;color: #bbb;}
.alert, .approved, .attention, .camera, .cart, .doc, .download, .media, .note, .notices {display: block;margin: 0 0 15px 0;background: repeat-x 0 100%;background-color: @whiteColor !important; background-image: none !important;}
.typo-icon {display: block;padding: 8px 10px 0px 36px;margin: 0 0 15px 0;background: no-repeat 10px 12px;}
.alert {color: #D0583F;background-image: url(../images/icons/alert.png);border-bottom: 1px solid #F8C9BB;border-right: 1px solid #F8C9BB;}
.approved {color: #6CB656;background-image: url(../images/icons/approved.png);border-bottom: 1px solid #C1CEC1;border-right: 1px solid #C1CEC1;}
.attention {color: #E1B42F;background-image: url(../images/icons/attention.png);border-bottom: 1px solid #E4E4D5;border-right: 1px solid #E4E4D5;}
.camera {color: #55A0B4;background-image: url(../images/icons/camera.png);border-bottom: 1px solid #C9D5D8;border-right: 1px solid #C9D5D8;}
.cart {color: #559726;background-image: url(../images/icons/cart.png);border-bottom: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;}
.doc {color: #666666;background-image: url(../images/icons/doc.png);border-bottom: 1px solid #E5E5E5;border-right: 1px solid #E5E5E5;}
.download {color: #666666;background-image: url(../images/icons/download.png);border-bottom: 1px solid #D3D3D3;border-right: 1px solid #D3D3D3;}
.media {color: #8D79A9;background-image: url(../images/icons/media.png);border-bottom: 1px solid #DBE1E6;border-right: 1px solid #DBE1E6;}
.note {color: #B76F38;background-image: url(../images/icons/note.png);border-bottom: 1px solid #E6DAD2;border-right: 1px solid #E6DAD2;}
.notices {color: #6187B3;}
.approved .typo-icon {background-image: url(../images/icons/approved-icon.png);}
.alert .typo-icon {background-image: url(../images/icons/alert-icon.png);}
.attention .typo-icon {background-image: url(../images/icons/attention-icon.png);}
.camera .typo-icon {background-image: url(../images/icons/camera-icon.png);}
.cart .typo-icon {background-image: url(../images/icons/cart-icon.png);}
.doc .typo-icon {background-image: url(../images/icons/doc-icon.png);}
.download .typo-icon {background-image: url(../images/icons/download-icon.png);}
.media .typo-icon {background-image: url(../images/icons/media-icon.png);}
.note .typo-icon {background-image: url(../images/icons/note-icon.png);}
.notices .typo-icon {background-image: url(../images/icons/notice-icon.png);}








/* checkboxes css */
.iPhoneCheckContainer {
  position: relative;
  height: 27px;
  cursor: pointer;
  overflow: hidden; }
  .iPhoneCheckContainer input {
    position: absolute;
    top: 5px;
    left: 30px;
    opacity: 0; }
  .iPhoneCheckContainer label {
    white-space: nowrap;
    font-size: 17px;
    line-height: 17px;
    font-family: "Helvetica Neue", Arial, Helvetica, sans-serif;
    cursor: pointer;
    display: block;
    height: 20px;
    position: absolute;
    width: auto;
    top: 0;
    padding-top: 5px;
    overflow: hidden; }

.iPhoneCheckDisabled {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
  opacity: 0.5; }

label.iPhoneCheckLabelOn {
  color: @bgColor !important;
  background: @primaryColor;
  border: 1px solid #aaa;
  border-radius: 4px;
  text-shadow: 0px 0px 2px rgba(0, 0, 0, 0.6);
  left: 0;
  padding-top: 5px; }
  label.iPhoneCheckLabelOn span {
    padding-left: 8px; }
label.iPhoneCheckLabelOff {
  color: #8b8b8b;
  background: #ddd;
  border: 1px solid #aaa;
  border-radius: 4px;
  text-align: right;
  right: 0;
  }
  label.iPhoneCheckLabelOff span {
    padding-right: 8px; }

.iPhoneCheckHandle {
  display: block;
  height: 27px;
  cursor: pointer;
  position: absolute;
  top: 0;
  left: 0;
  width: 0;
  background: url('../images/iphone-style-checkboxes/slider_left.png?1284697268') no-repeat;
  padding-left: 3px; }

.iPhoneCheckHandleRight {
  height: 100%;
  width: 100%;
  padding-right: 3px;
  background: url('../images/iphone-style-checkboxes/slider_right.png?1284697268') no-repeat right 0; }

.iPhoneCheckHandleCenter {
  height: 100%;
  width: 100%;
  background: url('../images/iphone-style-checkboxes/slider_center.png?1284697268'); }

.iOSCheckContainer {
  position: relative;
  height: 27px;
  cursor: pointer;
  overflow: hidden; }
  .iOSCheckContainer input {
    position: absolute;
    top: 5px;
    left: 30px;
    filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
    opacity: 0; }
  .iOSCheckContainer label {
    white-space: nowrap;
    font-size: 17px;
    line-height: 17px;
    font-weight: bold;
    font-family: "Helvetica Neue", Arial, Helvetica, sans-serif;
    cursor: pointer;
    display: block;
    height: 27px;
    position: absolute;
    width: auto;
    top: 0;
    padding-top: 5px;
    overflow: hidden; }
  .iOSCheckContainer, .iOSCheckContainer label {
    user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none; }

.iOSCheckDisabled {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
  opacity: 0.5; }

label.iOSCheckLabelOn {
  color: white;
  background: url('../images/ios-style-checkboxes/on.png?1284697268') no-repeat;
  text-shadow: 0px 0px 2px rgba(0, 0, 0, 0.6);
  left: 0;
  padding-top: 5px; }
  label.iOSCheckLabelOn span {
    padding-left: 8px; }
label.iOSCheckLabelOff {
  color: #8b8b8b;
  background: url('../images/ios-style-checkboxes/off.png?1284697268') no-repeat right 0;
  text-shadow: 0px 0px 2px rgba(255, 255, 255, 0.6);
  text-align: right;
  right: 0; }
  label.iOSCheckLabelOff span {
    padding-right: 8px; }

.iOSCheckHandle {
  display: block;
  height: 27px;
  cursor: pointer;
  position: absolute;
  top: 0;
  left: 0;
  width: 0;
  background: url('../images/ios-style-checkboxes/slider_left.png?1284697268') no-repeat;
  padding-left: 3px; }

.iOSCheckHandleRight {
  height: 100%;
  width: 100%;
  padding-right: 3px;
  background: url('../images/ios-style-checkboxes/slider_right.png?1284697268') no-repeat right 0; }

.iOSCheckHandleCenter {
  height: 100%;
  width: 100%;
  background: url('../images/ios-style-checkboxes/slider_center.png?1284697268'); }
/* checkboxes css end */




/* DEMO PURPOSE CSS - Safe to remove */
.icons-collection {
  padding: 5px;
  background: #000;
  p {
    color: #fff;
    font-size: 9px;
    margin: 5px 0 !important;
    
    a {
      color: #fff;
      text-decoration: underline;
    }
  }
  img {
    width: 32px;
    height: 32px;
  }
}
/* End DEMO PURPOSE CSS */


@media only screen and (min-width: 1025px) {
  body {
    /* overflow: hidden; */
  }
}
