/**
 * Class ImageUpload
 *
 * Triggers the file input laying inside the parent block having .btn-upload
 * when user clicks on parent
 */
export class ImageUpload {
  constructor() {
    const button = document.querySelector<HTMLInputElement>('#photo-input');

    if (button instanceof HTMLInputElement) {
      button.addEventListener('change', function (event: Event) {
        const _el: HTMLInputElement | null = (event.target as HTMLInputElement);

        const files = _el?.files;

        if (files instanceof FileList && _el?.labels && _el?.labels[0]?.innerHTML) {
          _el.labels[0].innerHTML = '<i class="fas fa-paperclip"></i>&nbsp;' + files[0].name;
        }
      });
    }
  }
}
