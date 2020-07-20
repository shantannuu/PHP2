<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">SIGNUP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <form action="../home/partials/_handlesignup.php" method="post">
      <div class="form-group">
        <label for="username">Username :</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter email">
        
      </div>
      <div class="form-group">
        <label for="password">Password :</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="confirm">Confirm Password :</label>
        <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Password">
      </div>
      
      <button type="submit" class="btn btn-primary btn-lg btn-block">SignUp</button>
    </form>
      </div>
    
      <div class="modal-footer">
    
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
