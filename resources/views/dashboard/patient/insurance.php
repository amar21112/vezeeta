<?php
$page_title = 'Patient Profile - Vezeeta';
include_once('../../components/header.php');
include_once('../../assets/css/patient.php');
?>
<style>
  body {
    background: #f3f6f8;
    font-family: 'Cairo', sans-serif;
  }

  .profile-page {
    margin-top: 80px;
  }

  .profile-card {
    max-width: 75%;
    border-radius: 10px;
    background: #fff;
    overflow: hidden;
  }

  .profile-header {
    background: #007bff;
    color: #fff;
    text-align: center;
    padding: 12px;
  }

  .profile-header h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
  }

  .form-label {
    font-size: 13px;
    font-weight: 500;
  }

  .form-control,
  .form-select {
    font-size: 13px;
    height: 36px;
    border-radius: 6px;
  }

  .btn-primary {
    background: #007bff;
    border: none;
    font-size: 13px;
    padding: 8px 18px;
    border-radius: 6px;
  }

  .btn-primary:hover {
    background: #0069d9;
  }

  .btn-cancel {
    padding: 8px 14px;
    font-size: 13px;
    border-radius: 6px;
    border: none;
    background: #dc3545;
    color: #fff;
    cursor: pointer;
  }

  .btn-cancel:hover {
    background: #c82333;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .profile-card {
      max-width: 95%;
    }
  }
</style>
<div class="profile-page">
  <div class="container d-flex justify-content-center">
    <div class="profile-card mx-auto">
      <!-- Header -->
      <div class="profile-header">
        <h5>Add Insurance</h5>
      </div>

      <!-- Body -->
      <div class="profile-body p-4">
        <form>
          <div class="mb-3">
            <label class="form-label">Insurance Provider</label>
            <select class="form-select">
              <option selected disabled>Select Insurance</option>
              <option value="Egymed">Egymed</option>
              <option value="Prime Health">Prime Health</option>
              <option value="Egycare">Egycare</option>
              <option value="Medright">Medright</option>
              <option value="MedCom">MedCom</option>
              <option value="Al Mashreq">Al Mashreq</option>
              <option value="Wadi El Nile">Wadi El Nile</option>
              <option value="INAYA Egypt">INAYA Egypt</option>
              <option value="Axa">Axa</option>
              <option value="MedNet">MedNet</option>
              <option value="MedSure">MedSure</option>
              <option value="Medi gold">Medi gold</option>
              <option value="tristar">tristar</option>
              <option value="Bupa">Bupa</option>
              <option value="Engineering Syndicate">Engineering Syndicate</option>
              <option value="Co-operation for petrol">Co-operation for petrol</option>
              <option value="Marasem International For Urban Development">Marasem International For Urban Development</option>
              <option value="ITIDA">ITIDA</option>
              <option value="Vacsera">Vacsera</option>
              <option value="UBF">UBF</option>
              <option value="Physiotherapy Syndicate">Physiotherapy Syndicate</option>
              <option value="National authority of press">National authority of press</option>
              <option value="Alamal Alsherif plastics">Alamal Alsherif plastics</option>
              <option value="Cairo Medical Syndicate">Cairo Medical Syndicate</option>
              <option value="Mansour Group families">Mansour Group families</option>
              <option value="Mansour Group">Mansour Group</option>
              <option value="ETHYDCO">ETHYDCO</option>
              <option value="Fifth Square Al Marasem">Fifth Square Al Marasem</option>
              <option value="Wadi Degla">Wadi Degla</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" class="form-control" placeholder="Enter full name">
          </div>

          <div class="mb-3">
            <label class="form-label">Birth Date</label>
            <input type="date" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">ID Number</label>
            <input type="text" class="form-control" placeholder="Enter ID number">
          </div>

          <div class="mb-3">
            <label class="form-label">Expiry Date</label>
            <input type="date" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Medical Card</label>
            <input type="file" class="form-control">
          </div>

          <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn-cancel">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include_once('../../components/footer.php');
?>