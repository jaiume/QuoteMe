<template>
  <div class="relative">
    <h1 class="mb-6 text-90 font-normal text-2xl">
      {{ __('Buy Credits') }}
    </h1>

    <card class="overflow-hidden">
      <div>
        <validation-errors :errors="validationErrors" />

        <component
          :is="'form-select-field'"
          :field="planDropdownField"
          :errors="validationErrors"
          @input="payload => planChanged(payload)"
        />

        <component
          :is="'form-currency-field'"
          :key="totalField.value || 0"
          :field="totalField"
          :errors="validationErrors"
        />
      </div>

      <div class="bg-30 px-8 py-4 flex flex-row items-center justify-between">
        <progress-button
          :disabled="!selectedPlan || loading"
          :processing="loading"
          type="button"
          class="btn-primary"
          @click.prevent.native="buyCredits"
        >
          {{ __('Buy credits') }}
        </progress-button>

        <div class="font-bold text-80">
          {{ __('Available balance: :amount', { amount: balanceText }) }}
        </div>
      </div>
    </card>
  </div>
</template>

<script>
import { Errors } from 'laravel-nova';
import pluralize from 'pluralize';
import { gsap } from 'gsap';

const Nova = window.Nova;

export default {
  props: {
    card: {
      type: Object,
      default: () => {},
    },
  },

  data() {
    return {
      loading: false,
      selectedPlan: null,
      validationErrors: new Errors(),
      amount: this.card.amount || 0,
      tweenedAmount: this.card.amount || 0,
    };
  },

  computed: {
    plans: function () {
      return this.card.plans || [];
    },

    currency: function () {
      return this.card.currency || 'TTD';
    },

    planDropdownField: function () {
      return {
        name: this.__('Select a plan'),
        attribute: 'plan',
        validationKey: 'plan',
        options: [
          ...this.plans,
        ],
        value: null,
      };
    },

    totalField: function () {
      return {
        name: this.__('Total price'),
        attribute: 'total',
        readonly: true,
        currency: this.currency,
        value: this.selectedPlan ? this.selectedPlan.price : null,
      };
    },

    balanceText: function () {
      const amount = this.tweenedAmount.toFixed(0);
      return amount + ' ' + pluralize('credit', amount);
    },
  },

  methods: {
    planChanged: function (planId) {
      this.selectedPlan = this.plans.reduce((accum, item) => {
        if (Number(item.value) === Number(planId)) {
          return item;
        }

        return accum;
      }, null);
    },

    buyCredits: function () {
      this.loading = true;
      this.validationErrors = new Errors();

      const data = new FormData();
      if (this.selectedPlan) {
        data.append('plan', this.selectedPlan.value);
      }

      Nova.request()
        .post(`/nova-vendor/${this.card.component}/buy`, data)
        .then(response => {
          console.log('response', response);
          if (response.data.redirect) {
            document.location.href = response.data.redirect_url;
          }
          // this.amount = response.data.data.new_balance || 0;
          // Nova.success(
          //   this.__(
          //     'Your account has been credited for :value. New balance is: :amount', {
          //       value: this.selectedPlan.creditsAmount,
          //       amount: this.amount
          //     })
          // );
        })
        .catch(error => {
          if (error.response && error.response.status === 422) {
            this.validationErrors = new Errors(error.response.data.errors);
          }

          if (process.env.NODE_ENV === 'development') {
            Nova.error(error.message);
          }

          Nova.error(this.__('Something went wrong'));
        })
        .finally(() => {
          this.loading = false;
        });
    }
  },

  watch: {
    amount: function (value) {
      gsap.to(this.$data, { duration: 2, tweenedAmount: value });
    }
  },

  created() {
    Nova.$on('plan-change', this.planChanged);
  },
};
</script>

<style lang="scss" scoped>
.card-panel {
  height: auto !important;
}
</style>
