<template>
  <modal @modal-close="handleClose">
    <form
      @submit.prevent="handleConfirm"
      class="bg-white rounded-lg shadow-lg overflow-hidden"
      style="width: 460px"
    >
      <slot>
        <div class="p-8">
          <heading :level="2" class="mb-6">
            {{ __('Please confirm QuickContact') }}
          </heading>
          <p class="text-80 leading-normal">
            {{ __('Do you really want to view the customer\'s contacts? It will cost :amount.', {
              'amount': amountText,
            }) }}
          </p>
        </div>
      </slot>

      <div class="bg-30 px-6 py-3 flex">
        <div class="ml-auto">
          <button type="button" @click.prevent="handleClose" class="btn text-80 font-normal h-9 px-3 mr-3 btn-link">
            {{__('Not now') }}
          </button>
          <button id="confirm-delete-button" ref="confirmButton" type="submit" class="btn btn-default btn-primary">
            {{ __('Yes') }}
          </button>
        </div>
      </div>
    </form>
  </modal>
</template>

<script>
import pluralize from 'pluralize';

export default {
  props: {
    amount: {
      type: Number,
      required: true
    }
  },

  computed: {
    amountText: function () {
      return `${this.amount} ${pluralize('credit', this.amount)}`;
    }
  },

  methods: {
    handleConfirm() {
      this.$emit('confirm');
    },

    handleClose() {
      this.$emit('close');
    },
  },

  mounted() {
    this.$refs.confirmButton.focus();
  },
};
</script>
