<?php
$page_title = 'Change Password - Vezeeta';
include_once('../../components/header.php');
include_once('../../assets/css/patient.php');
?>
<div class="password-page">
  <div class="password-card">
    <div class="password-header">
      <h3>Change Password</h3>
    </div>
    <div class="password-body">
      <form class="password-form">
        <div class="form-group">
          <label for="currentPassword" class="form-label">Current Password</label>
          <input type="password" id="currentPassword" class="password-input" placeholder="Enter current password" required>
        </div>

        <div class="form-group">
          <label for="newPassword" class="form-label">New Password</label>
          <input type="password" id="newPassword" class="password-input" placeholder="Enter new password" required>
        </div>

        <div class="form-group">
          <label for="confirmPassword" class="form-label">Confirm New Password</label>
          <input type="password" id="confirmPassword" class="password-input" placeholder="Confirm new password" required>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-save">Save</button>
          <button type="button" class="btn-cancel">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
include_once('../../components/footer.php');
?>