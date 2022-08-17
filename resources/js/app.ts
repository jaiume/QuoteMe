import { ImageUpload } from './modules/image-upload';
import { Choices } from './modules/choices';
import { InputMask } from './modules/input-mask';
import { FontAwesome } from './modules/font-awesome';
import { Modal } from './modules/modal';
import { ClickableTables } from './modules/clickable-tables';
import { Notyf } from 'notyf';
import { CheckEmailExists } from './modules/check-email-exists';

// eslint-disable-next-line @typescript-eslint/ban-ts-ignore
// @ts-ignore
window.notyf = new Notyf({
  duration: 10000,
  position: {
    x: 'left',
    y: 'top',
  },
  types: [
    {
      type: 'warning',
      background: 'var(--orange)',
    },
    {
      type: 'info',
      background: 'var(--cyan)',
    }
  ]
});

/* Runs on window.load */
window.addEventListener('load', () => {
  new ImageUpload();
  new Choices();
  new InputMask();
  new FontAwesome();
  new Modal();
  new ClickableTables();
  new CheckEmailExists();
}, false);
