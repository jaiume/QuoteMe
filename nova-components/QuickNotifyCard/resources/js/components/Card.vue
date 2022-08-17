<template>
  <card class="px-6 py-4 flex flex-col justify-between items-stretch">
    <div class="mb-4">
      <h3 class="mr-3 text-base text-80 font-bold">
        {{ __('Quick Notify Status') }}
      </h3>
    </div>

    <div class="flex flex-row items-center justify-between mb-4">
      <div class="flex items-center text-2xl" :style="{ 'color': color, 'transition': '300ms' }">
        <transition name="fade">
          <font-awesome-icon
            v-if="!loading"
            :icon="icon"
          />
          <font-awesome-icon
            v-else
            :icon="['fas', 'spinner']"
            spin
          />
        </transition>

        <span class="text-xl ml-2">{{ label }}</span>
      </div>

      <progress-button
        :disabled="loading"
        :processing="loading"
        dusk="toggle-button"
        type="button"
        class="btn-xs btn-primary"
        @click.prevent.native="toggle"
      >
        {{ buttonLabel }}
      </progress-button>
    </div>

    <div class="flex items-center">
      <div v-if="showHeadStart || showMessageCost" class="text-xs">
        <div v-if="showHeadStart">
          <span class="text-bold">{{ __('Head Start: ') }}</span>
          <span>{{ `${headStart} ${headStartUnit}` }}</span>
        </div>

        <div v-if="showMessageCost">
          <span class="text-bold">{{ __('Message Cost:') }}</span>
          <span>{{ `${messageCost} ${messageCostUnit}` }}</span>
        </div>
      </div>
    </div>
  </card>
</template>

<script>
import { library } from '@fortawesome/fontawesome-svg-core';
import { faSpinner } from '@fortawesome/free-solid-svg-icons';
import { faCheckCircle, faTimesCircle } from '@fortawesome/free-regular-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import pluralize from 'pluralize';

library.add(faCheckCircle, faTimesCircle, faSpinner);

const Nova = window.Nova;

export default {
  components: {
    'font-awesome-icon': FontAwesomeIcon,
  },

  props: {
    card: {
      type: Object,
      default: () => {},
    }
  },

  data: function () {
    return {
      enabled: true,
      loading: true,
    };
  },

  computed: {
    icon: function () {
      return this.enabled
        ? ['far', 'check-circle']
        : ['far', 'times-circle'];
    },

    label: function () {
      if (this.loading) {
        return '';
      }

      return this.enabled
        ? this.__('Enabled')
        : this.__('Disabled');
    },

    buttonLabel: function () {
      return this.enabled
        ? this.__('Disable')
        : this.__('Enable');
    },

    color: function () {
      if (this.loading) {
        return 'var(--info)';
      }

      return this.enabled ? 'var(--success)' : 'var(--danger)';
    },

    showHeadStart: function () {
      return this.card.showHeadStart || false;
    },

    showMessageCost: function () {
      return this.card.showMessageCost || false;
    },

    headStart: function () {
      return this.card.headStart || 0;
    },

    messageCost: function () {
      return this.card.messageCost || 0;
    },

    headStartUnit: function () {
      return pluralize(this.card.headStartUnit || 'min', this.headStart);
    },

    messageCostUnit: function () {
      return pluralize(this.card.messageCostUnit || 'credit', this.messageCost);
    },
  },

  mounted() {
    this.init();
  },

  methods: {
    init: function () {
      this.loading = true;

      Nova.request()
        .get('/nova-vendor/quick_notify_card/status', {})
        .then(response => {
          this.enabled = response.data.status;
        })
        .catch(error => {
          if (process.env.NODE_ENV === 'development') {
            Nova.error(error.message);
          }

          Nova.error(this.__('Something went wrong'));
        })
        .finally(() => {
          this.loading = false;
        });
    },

    toggle: function () {
      this.loading = true;

      Nova.request()
        .post('/nova-vendor/quick_notify_card/toggle', {})
        .then(response => {
          this.enabled = response.data.status;

          Nova.success(this.enabled
            ? this.__('QuickNotify status enabled')
            : this.__('QuickNotify status disabled'),
          );
        })
        .catch(error => {
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
};
</script>

<style lang="scss">
.fade {
  &-enter-active,
  &-leave-active {
    transition: opacity .5s;
  }

  &-enter,
  &-leave-to {
    opacity: 0;
  }
}
</style>
