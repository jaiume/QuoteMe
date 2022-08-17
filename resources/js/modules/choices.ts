import { default as ChoicesJs } from 'choices.js';
import { Rest } from '../utils/rest';

const INVALID_CLASS = 'is-invalid';

const BASE_OPTIONS = {
  placeholder: true,
  itemSelectText: '',
  fuseOptions: {
    threshold: 0.2
  },
  searchFields: ['label'],
  removeItemButton: true,
};

interface CategoriesFilterDto {
  status: boolean;
  categories: {
    value: number;
    label: string;
    disabled: boolean;
  }[];
}

interface AreasFilterDto {
  status: boolean;
  areas: {
    value: number;
    label: string;
    disabled: boolean;
  }[];
}

export class Choices {
  categoryChoices: ChoicesJs | undefined;
  areaChoices: ChoicesJs | undefined;

  constructor() {
    const categorySelect = document.querySelector<HTMLSelectElement>('#category-select');
    const areaSelect = document.querySelector<HTMLSelectElement>('#area-select');

    if (categorySelect) {
      this.categoryChoices = new ChoicesJs(categorySelect, {
        ...BASE_OPTIONS,
        callbackOnCreateTemplates: () => ({
          containerOuter: function (...args) {
            const item = ChoicesJs.defaults.templates.containerOuter.call(this, ...args);

            if (categorySelect.classList.contains(INVALID_CLASS)) {
              item.classList.add(INVALID_CLASS);
            }

            return item;
          }
        }),
      });

      const filterAreas = this.filterAreas.bind(this);
      this.categoryChoices.passedElement.element.addEventListener('change', function (event) {
        // eslint-disable-next-line @typescript-eslint/ban-ts-ignore
        // @ts-ignore
        filterAreas(parseInt(event.detail.value));
      });
    }

    if (areaSelect) {
      this.areaChoices = new ChoicesJs(areaSelect, {
        ...BASE_OPTIONS,
        callbackOnCreateTemplates: () => ({
          containerOuter: function (...args) {
            const item = ChoicesJs.defaults.templates.containerOuter.call(this, ...args);

            if (areaSelect.classList.contains(INVALID_CLASS)) {
              item.classList.add(INVALID_CLASS);
            }

            return item;
          }
        })
      });

      const filterCategories = this.filterCategories.bind(this);
      this.areaChoices.passedElement.element.addEventListener('change', function (event) {
        // eslint-disable-next-line @typescript-eslint/ban-ts-ignore
        // @ts-ignore
        filterCategories(parseInt(event.detail.value));
      });
    }
  }

  protected filterAreas(categoryId?: number): void {
    this.areaChoices?.disable();

    Rest
      .get<AreasFilterDto>(categoryId ? `/api/filter/areas?category_id=${categoryId}` : '/api/filter/areas')
      .then(response => {
        if (response.status && this.areaChoices) {
          this.areaChoices.setChoices(response.areas, 'value', 'label', true);

          if (response.areas.some(item => String(item.value) === String(this.areaChoices?.getValue(true)))) {
            this.areaChoices.setChoiceByValue(this.areaChoices.getValue(true));
          } else {
            // If the selected element is gone
            this.areaChoices.removeActiveItems(0);
          }
        }
      })
      .catch(error => {
        console.error('Error', error);
        this.areaChoices?.setChoices([], 'value', 'label', true).removeActiveItems(0);
      })
      .finally(() => {
        this.areaChoices?.enable();
      });
  }

  protected filterCategories(areaId?: number): void {
    this.categoryChoices?.disable();

    Rest
      .get<CategoriesFilterDto>(areaId ? `/api/filter/categories?area_id=${areaId}` : '/api/filter/categories')
      .then(response => {
        if (response.status && this.categoryChoices) {
          this.categoryChoices.setChoices(response.categories, 'value', 'label', true);

          if (response.categories.some(item => String(item.value) === String(this.categoryChoices?.getValue(true)))) {
            this.categoryChoices.setChoiceByValue(this.categoryChoices.getValue(true));
          } else {
            // If the selected element is gone
            this.categoryChoices.removeActiveItems(0);
          }
        }
      })
      .catch(error => {
        console.error('Error', error);
        this.categoryChoices?.setChoices([], 'value', 'label', true).removeActiveItems(0);
      })
      .finally(() => {
        this.categoryChoices?.enable();
      });
  }
}
