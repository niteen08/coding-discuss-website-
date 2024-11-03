 <!-- Modal -->
 <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="loginModalLabel">Login to I-Discuss</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">

                 <form action="/discuss/component/handle_login.php" method="post">
                     <div class="form-group">
                         <label for="username">Username </label>
                         <input type="text" class="form-control" id="username" Required  name="username" aria-describedby="emailHelp">
                     </div>
                     <div class="form-group">
                         <label for="exampleInputPassword1">Password</label>
                         <input type="password" class="form-control" id="password" Required  name="password">
                     </div>
                     <button type="reset" class="btn btn-primary">Reset</button>
                     <button type="submit" class="btn btn-primary">Login</button>
             </div>
             
             </form>
         </div>
     </div>
 </div>
 
  