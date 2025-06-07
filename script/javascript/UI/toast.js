class ToastManager {
  /**
   * Show a Bootstrap toast
   * @param {string} title Title of the toast
   * @param {string} message Body message of the toast
   * @param {string} type Type: success, danger, warning, info, light, dark
   * @param {number} delay Auto hide delay in ms (default 4000)
   * @param {string} extraClasses Additional bootstrap utility classes (optional)
   */
  static show(title, message, type = 'light', delay = 4000, extraClasses = '') {
    let container = document.getElementById('toast-container');
    if (!container) {
      container = document.createElement('div');
      container.id = 'toast-container';
      container.style.position = 'fixed';
      container.style.bottom = '1rem';
      container.style.left = '1rem';
      container.style.zIndex = '1055';
      container.style.display = 'flex';
      container.style.flexDirection = 'column-reverse';
      container.style.gap = '0.5rem';
      container.style.maxWidth = '350px';
      container.style.maxHeight = '90vh';
      container.style.overflowY = 'auto';

      document.body.appendChild(container);
    }

    const toastId = 'toast-' + Date.now() + '-' + Math.floor(Math.random() * 1000);

    // Background + text colors for toast container
    const typeClassMap = {
      success: 'bg-success bg-opacity-10 text-success',
      danger: 'bg-danger bg-opacity-10 text-danger',
      warning: 'bg-warning bg-opacity-10 text-warning',
      info: 'bg-info bg-opacity-10 text-info',
      light: 'bg-light text-dark border',
      dark: 'bg-dark text-white'
    };

    // Icons with fill='currentColor'
    const iconMap = {
      success: `
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
          <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
        </svg>
      `,
      danger: `
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.964 0L.165 13.233c-.457.778.091 1.767.982 1.767h13.706c.89 0 1.438-.99.982-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
        </svg>`,
      warning: `
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
        </svg>`,
      info: `
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
          <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
        </svg>`,
      light: '',
      dark: ''
    };

    const toastClasses = `${typeClassMap[type] || 'bg-secondary text-white'} ${extraClasses}`.trim();
    const closeBtnClass = type === 'light' ? 'btn-close-black' : 'btn-close-white';

    // Icon container with subtle background + icon color
    const iconHTML = iconMap[type] ? `
      <div class="toast-icon d-flex align-items-center justify-content-center rounded-circle ms-1" 
        style="
          width: 32px; 
          height: 32px; 
          color: var(--bs-${type});
          ">
        ${iconMap[type]}
      </div>` : '';

    const toastHTML = `
  <div id="${toastId}" class="toast ${toastClasses}" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="${delay}">
    <div class="hstack gap-3 align-items-center">
      ${iconHTML}
      <div class="toast-body">
        <strong>${title}</strong><br>${message}
      </div>
      <button type="button" class="btn-close ms-auto me-2" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
`;


    container.insertAdjacentHTML('beforeend', toastHTML);

    const toastEl = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastEl);

    toast.show();

    toastEl.addEventListener('hidden.bs.toast', () => {
      toastEl.remove();
      if (container.children.length === 0) {
        container.remove();
      }
    });
  }
}
