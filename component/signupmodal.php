 <!-- Modal -->
 <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="signupModalLabel">SignUp For Account</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form action="/discuss/component/handle_signup.php" method="post">
                     <div class="form-group">
                         <label for="username">Username</label>
                         <input type="text" class="form-control" id="username" required name="username" aria-describedby="usernameHelp">
                          
                     </div>
                     <div class="form-group">
                         <label for="exampleInputPassword1">Password</label>
                         <input type="password" class="form-control" id="exampleInputPassword1" Required name="password">
                     </div>
                     <div class="form-group">
                         <label for="exampleInputPassword1"> Confirm Password</label>
                         <input type="password" class="form-control" id="exampleInputPassword1"  Required name="cpassword">
                     </div>
                     <button type="reset" class="btn btn-primary">Reset</button>
                     <button type="submit" class="btn btn-primary">Signup</button>
                
             </div>
             </form>
         </div>
     </div>
 </div>