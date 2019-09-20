<div class="container">
  <div class="row">
    <div class="col-sm-8" style="margin: 10px; padding: 10px; border: 1px solid black;">
      <form action="../controller/send.php" method="POST">
        <div class="form-group">
          <label for="exampleFormControlTitle">Message Title</label>
          <input type="text" name="messageTitle" class="form-control" id="exampleFormControlTitle">
        </div>
        <div class="form-group">
          <label for="exampleFormControlUser">Username</label>
          <input type="text" name="receiver" class="form-control" id="exampleFormControlUser">
          <?php echo  '<input type="hidden" name="sender" value="' . $profile['user_id'] . '">'; ?>
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Message</label>
          <textarea class="form-control" name="secretMessage" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        <div class="form-group">
          <label for="exampleFormControlFile1">Image file</label>
          <input type="file" name="messageImage" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <input type="submit" class="btn btn-primary mb-2" value="Send Message" name="submit">
      </form>
    </div>
    <div class="col-sm-3" style="margin: 10px; padding: 10px; ">
      <h3>Other Users</h3>
      <ul class="list-group">
        <?php
        foreach ($users as $user) {
          echo '<li class="list-group-item">' . $user['user_name'] . '</li>';
        }
        ?>
      </ul>
    </div>
  </div>
</div>