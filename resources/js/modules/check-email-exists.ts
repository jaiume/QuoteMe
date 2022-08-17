import { debounce } from '../utils/debounce';
import { Rest } from '../utils/rest';

interface CheckEmailExistsDto {
  exists: boolean;
}

export class CheckEmailExists {
  private clicked = false;

  private static async isEmailExists(e: Event): Promise<void> {
    if (!(e.target instanceof HTMLInputElement)) {
      return;
    }

    e.target.classList.remove('is-valid');
    const result = await Rest.get<CheckEmailExistsDto>('/email-exists', { email: e.target.value });
    if (result.exists) {
      e.target.classList.add('is-valid');
    }
  }

  constructor() {
    const emailInput = document.querySelector<HTMLInputElement>('.request-form input.email-check');
    const authLink = document.querySelector<HTMLAnchorElement>('.request-form a.customer-auth-link');
    const validText = document.querySelector<HTMLAnchorElement>('.request-form input.email-check + .valid-feedback');

    if (!emailInput || !authLink || !validText) {
      return;
    }

    this.clicked = false;
    const inputHandler = debounce<(e: Event) => void>(CheckEmailExists.isEmailExists.bind(this), 500);
    emailInput.addEventListener('input', inputHandler);

    authLink.addEventListener('click', (e: Event) => {
      e.preventDefault();

      if (!this.clicked && e.target instanceof HTMLAnchorElement && emailInput instanceof HTMLInputElement) {
        Rest
          .post(e.target.href, { email: emailInput.value })
          .then(() => {
            validText.innerText = 'Auth link successfully sent to your email. Please follow the link provided in the email to authorize.';
          });
      }

      this.clicked = true;
    });
  }
}
