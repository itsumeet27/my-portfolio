  </body>
  <!--Footer-->
  <footer class="page-footer text-center font-small animated fadeIn">

    <!-- Social icons -->
    <div class="pt-3 footer-social">
      <a href="https://www.facebook.com/itsumeet" target="_blank">
        <i class="fab fa-facebook-f mr-3" title="Facebook"></i>
      </a>
      <a href="https://linkedin.com/in/itsumeet" target="_blank">
        <i class="fab fa-linkedin mr-3" title="Linkedin"></i>
      </a>
      <a href="https://twitter.com/itsumeet27" target="_blank">
        <i class="fab fa-twitter mr-3" title="Twitter"></i>
      </a>
      <a href="https://instagram.com/itsumeet27" target="_blank">
        <i class="fab fa-instagram mr-3" title="Instagram"></i>
      </a>
      <a href="https://github.com/itsumeet27" target="_blank">
        <i class="fab fa-github mr-3" title="GitHub"></i>
      </a>
    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright pt-3 pb-2">
      © 2020 Copyright:
      <a href="" target="_blank"> Sumeet Sharma </a>
    </div>
    <!--/.Copyright-->
  </footer>
  <!--/.Footer-->

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->

  <!-- Dark and Light Toggle -->
  <script type="text/javascript">
    var checkbox = document.querySelector('input[name=theme]');
    checkbox.addEventListener('change', function(){
      if(this.checked){
        trans()
        document.documentElement.setAttribute('data-theme', 'dark');
      }else{
        trans()
        document.documentElement.setAttribute('data-theme', 'light');
      }
    })

    let trans = () => {
      document.documentElement.classList.add('transition');
      window.setTimeout(() => {
        document.documentElement.classList.remove('transition');
      }, 1000)
    }
  </script>
</html>