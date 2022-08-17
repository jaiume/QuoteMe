import { library, dom } from '@fortawesome/fontawesome-svg-core';
import { faPaperclip, faEye, faTimes } from '@fortawesome/free-solid-svg-icons';

library.add(
  faPaperclip,
  faEye,
  faTimes,

);

export class FontAwesome {
  constructor() {
    dom.watch();
  }
}
