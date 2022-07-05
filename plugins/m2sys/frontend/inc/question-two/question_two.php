<form action="#" method="post" id="question_two_form">
  <?php wp_nonce_field( 'm2sys_form_nonce' ); ?>
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="name" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email Address">
  </div>
  <div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone">
  </div>
  <div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <textarea name="address" class="form-control" id="address" placeholder="Enter Your Address"></textarea>
  </div>
  <div class="mb-3">
    <label for="gender" class="form-label">Gender</label>
    <select name="gender"  class="form-select" id="gender" >
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>        
    </select>
  </div>
  
  <button type="submit" class="btn btn-primary" style="width: 200px;position: relative;">Submit <span class="loader"></span></button>
  <div id="form-submit-message"></div>
</form>