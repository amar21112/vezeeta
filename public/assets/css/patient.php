<style>
  :root {
    --bg: #f3f6f8;
    --card: #ffffff;
    --accent: #007bff;
    --muted: #6c757d;
    --danger: #dc3545;
    --danger-hover: #c82333;
  }

  body {
    font-family: 'Cairo', sans-serif;
    background: var(--bg);
    margin: 0;
    padding: 0;
  }

  .profile-page {
    margin-top: 80px;
  }

  /* Sidebar */
  .profile-sidebar {
    background: #fff;
    border-radius: 10px;
  }

  .profile-sidebar .profile-side-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    border-radius: 10px;
    font-size: 14px;
    color: #111827;
    cursor: pointer;
    transition: 0.2s;
  }

  .profile-sidebar .profile-side-item i {
    font-size: 14px;
    color: var(--muted);
  }

  .profile-sidebar .profile-side-item:hover {
    background: #f1f5f9;
  }

  .profile-sidebar .profile-side-item.active {
    background: var(--accent);
    color: #fff;
    font-weight: 600;
  }

  .profile-sidebar .profile-side-item.active i {
    color: #fff;
  }

  /* Main Card */
  .profile-card {
    max-width: 75%;
    border-radius: 10px;
    overflow: hidden;
  }

  .profile-header {
    background: var(--accent);
    color: #fff;
    padding: 10px 16px;
    text-align: center;
  }


  .profile-header h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
  }

  /* Form */
  .profile-body .form-label {
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 4px;
  }

  .form-control,
  .form-select {
    border-radius: 6px;
    font-size: 13px;
    height: 36px;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
  }

  /* Buttons */
  .btn-primary {
    background: var(--accent);
    border: none;
    font-size: 13px;
    padding: 8px 18px;
    border-radius: 6px;
  }

  .btn-primary:hover {
    background: #0069d9;
  }

  .btn-light {
    padding: 8px 14px;
    font-size: 13px;
    border-radius: 6px;
    border: none;
    background: #dc3545;
    color: #fff;
    cursor: pointer;
  }

  .btn-light:hover {
    background: #c82333;
  }

  /* ============================= */
  /* 📱 Responsive */
  /* ============================= */

  @media (max-width: 992px) {
    .profile-sidebar {
      margin-bottom: 20px;
    }
  }

  @media (max-width: 768px) {
    .profile-sidebar .profile-side-item {
      font-size: 13px;
      padding: 10px;
    }

    .profile-header h5 {
      font-size: 14px;
    }

    .profile-body .form-label {
      font-size: 11px;
    }

    .form-control,
    .form-select {
      font-size: 12px;
      height: 34px;
    }

    .btn-primary,
    .btn-light {
      font-size: 12px;
      padding: 6px 14px;
    }
  }




  @media (max-width: 576px) {
    .profile-sidebar {
      display: flex;
      overflow-x: auto;
      white-space: nowrap;
    }

    .profile-sidebar .profile-side-item {
      flex: 0 0 auto;
      padding: 8px 12px;
      font-size: 12px;
    }

    .profile-card {
      border-radius: 8px;
      max-width: 100%;
    }
  }

  /* -------------------------------------------------------------------------------------------------------------------------------- */


  .password-page {
    padding: 36px 16px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;

  }

  .password-card {
    width: 400px;
    max-width: 100%;
    background: var(--card);
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    overflow: hidden;

  }

  .password-header {
    background: var(--accent);
    color: #fff;
    padding: 12px 16px;
    text-align: center;

  }

  .password-body {
    padding: 20px;
  }

  .password-form .form-group {
    margin-bottom: 16px;
    margin-right: 16px;

  }

  .form-label {
    display: block;
    font-size: 13px;
    margin-bottom: 6px;
    color: #1f2937;
  }

  .password-input {
    width: 100%;
    height: 36px;
    padding: 6px 10px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    font-size: 13px;
    transition: border-color .12s, box-shadow .12s;
  }

  .password-input:focus {
    border-color: var(--accent);
    outline: none;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.06);
  }

  .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
  }

  .btn-save {
    padding: 8px 18px;
    font-size: 13px;
    border-radius: 6px;
    border: none;
    background: var(--accent);
    color: #fff;
    cursor: pointer;
  }

  .btn-save:hover {
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
</style>