<template>
  <card class="px-6 py-4 flex flex-col justify-between items-stretch">
    <div class="mb-4">
      <h3 class="mr-3 text-base text-80 font-bold">
        {{ __('Credits Available') }}
      </h3>
    </div>

    <div class="flex flex-row items-center justify-between mb-4">
      <p class="flex items-center text-4xl">
        {{ balanceText }}
      </p>
    </div>

    <div class="flex items-center" v-if="showBuyButton">
      <progress-button
        :disabled="loading"
        :processing="loading"
        dusk="toggle-button"
        type="button"
        class="btn-xs btn-primary"
        @click.prevent.native="buyCredits"
      >
        {{ __('Buy Credits') }}
      </progress-button>
    </div>
  </card>
</template>

<script>
import pluralize from 'pluralize';

export default {
  props: {
    card: {
      type: Object,
      default: () => {},
    }
  },

  computed: {
    showBuyButton: function () {
      return this.card.showBuyButton || true;
    },

    amount: function () {
      return this.card.amount || 0;
    },

    balanceText: function () {
      return this.amount + ' ' + pluralize('credit', this.amount);
    }
  },

  methods: {
    buyCredits: function () {
      this.$router.push({
        name: 'index',
        params: {
          resourceName: 'credit-transactions'
        }
      });
    }
  }
};
</script>
