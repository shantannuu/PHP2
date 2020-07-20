
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">LOGIN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="../home/partials/_handlelogin.php" method="post">
      <div class="form-group">
        <label for="login_username">Username :</label>
        <input type="text" class="form-control" id="login_username" name="login_username" aria-describedby="emailHelp" placeholder="Enter email">
        
      </div>
      <div class="form-group">
        <label for="login_password">Password :</label>
        <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Password">
      </div>
    
      <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>