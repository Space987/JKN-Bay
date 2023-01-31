<!-- Modal -->
  <div class="modal">
    <div class="content" style="background-color: black; color: white;">
      <h1> Send Message</h1>
      <form method="post" id="replyFrm">
        <div class="modal-body" style='background-color: silver; color: black;'>
          <div class="response"></div>

          <div class="form-group">
			<label for="message"> <?= _("Enter Message") ?> </label>
			<input type="text" class="form-control" id="message" name="message">
			</div>

          <div class="modal-footer" style='background-color: silver;'>
            <button type="submit" name='action' id="submit" class="btn btn-success"> <?= _("Send") ?> </button>
			<p id='cancel' class="btn btn-danger">cancel</p>
          </div>
        </div>  
      </form>
    </div>
  </div>