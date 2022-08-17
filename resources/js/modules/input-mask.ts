import IMask from 'imask';

export class InputMask {
  constructor() {
    const inputs = document.querySelectorAll<HTMLInputElement>('input.masked');

    inputs.forEach(item => {
      if (item.type === 'email') {
        IMask(item, { mask: /^\S*@?\S*$/ });
      } else {
        const mask = item.getAttribute('data-mask') || '';

        IMask(item, { mask: mask });
      }
    });
  }
}
