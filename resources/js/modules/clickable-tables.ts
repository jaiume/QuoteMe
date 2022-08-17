export class ClickableTables {
  constructor() {
    const clickableRows = document.querySelectorAll<HTMLTableRowElement>('.table-hover tr[data-href]');

    clickableRows.forEach(item => {
      const href = item.getAttribute('data-href');

      if (href) {
        item.style.cursor = 'pointer';

        item.addEventListener('click', () => {
          window.location.href = href;
        });
      }
    });
  }
}
