<template>
  <div :v-if="!loading">
    <div class="card border-none shadow-none pt-3">
      <div class="flex">
        <div class="w-1/5 px-lg-8 py-2 py-lg-6">
          <label for="text" class="inline-block text-80 pt-2 leading-tight">
            {{ __('Text') }}
            <span class="text-danger text-sm">*</span>
          </label>
        </div>

        <div class="py-2 py-lg-6 px-lg-8 w-1/2">
          <textarea
            id="text"
            class="w-full form-control form-input form-input-bordered py-3 h-auto"
            v-model="responseText"
          />
        </div>
      </div>

      <div class="flex">
        <div class="w-1/5 px-lg-8 py-2 py-lg-6">
          <label for="total" class="inline-block text-80 pt-2 leading-tight">
            {{ __('Price') }}
          </label>
        </div>

        <div class="py-2 py-lg-6 px-lg-8 w-1/2">
          <div class="flex flex-wrap items-stretch w-full relative">
            <div class="flex -mr-px">
              <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 border-60 px-3 whitespace-no-wrap bg-30 text-80 text-sm font-bold">
                TTD
              </span>
            </div>

            <input
              id="total"
              type="number"
              min="0"
              step="0.01"
              :placeholder="__('Price')"
              class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 rounded-l-none form-control form-input form-input-bordered"
              v-model="responsePrice"
            >
        </div>
        </div>
      </div>

      <div class="flex items-center mt-3" :class="{
        'flex-col': isMobile,
        'flex-row': !isMobile,
      }">
        <button
          class="btn btn-primary items-center relative ml-auto"
          :class="{
              'btn-disabled': !hasResponseText,
              'btn-sm w-full mt-4': isMobile,
              'btn-default w-auto mt-0': !isMobile,

            }"
          @click.prevent="normalReplyModalOpen"
        >
          {{ normalReplyLabel }}
        </button>

        <button
          v-if="quickReplyEnabled"
          class="btn btn-primary items-center relative"
          :class="{
              'btn-disabled': !hasResponseText,
              'btn-sm w-full mt-4 mt-4': isMobile,
              'btn-default w-auto mt-0 ml-3': !isMobile,
            }"
          @click.prevent="quickReplyModalOpen"
        >
          {{ quickReplyLabel }}
        </button>
      </div>
    </div>

    <portal to="modals" transition="fade-transition">
      <normal-response-modal
        v-if="normalReplyModalOpened"
        @confirm="normalReplyModalConfirm"
        @close="normalReplyModalClose"
        :amount="normalReplyAmount"
      />

      <quick-response-modal
        v-if="quickReplyModalOpened"
        @confirm="quickReplyModalConfirm"
        @close="quickReplyModalClose"
        :amount="quickReplyAmount"
      />
    </portal>
  </div>
</template>

<script>
import pluralize from 'pluralize';
import NormalResponseModal from './NormalResponseModal';
import QuickResponseModal from './QuickResponseModal';

const Nova = window.Nova;

export default {
  components: {
    QuickResponseModal,
    NormalResponseModal
  },

  props: {
    requestId: {
      type: [String, Number],
      required: true
    },

    normalReplyAmount: {
      type: Number,
      default: -1,
    },

    quickReplyAmount: {
      type: Number,
      default: -1,
    },

    hasNormalReplyAmount: {
      type: Boolean,
      default: false,
    },

    hasQuickReplyAmount: {
      type: Boolean,
      default: false,
    },

    requestHasQuickReply: {
      type: Boolean,
      default: false,
    }
  },

  mounted() {
    window.addEventListener('resize', () => {
      this.windowWidth = window.innerWidth || 0;
    });
  },

  data() {
    return {
      loading: false,

      responsePrice: null,
      responseText: '',

      quickReplyModalOpened: false,
      normalReplyModalOpened: false,

      windowWidth: window.innerWidth,
    };
  },

  computed: {
    isMobile: function () {
      return this.windowWidth < 992;
    },

    hasResponseText: function () {
      return this.responseText && this.responseText.length > 0;
    },

    quickReplyEnabled: function () {
      return (Nova.config.quick_reply_enabled || false) && this.requestHasQuickReply;
    },

    normalReplyLabel: function () {
      return this.hasNormalReplyAmount
        ? this.__('Normal Response — :price', { 'price': `${this.normalReplyAmount} ${pluralize('credit', this.normalReplyAmount)}` })
        : this.__('Normal Response — Buy Credits');
    },

    quickReplyLabel: function () {
      return this.hasQuickReplyAmount
        ? this.__('Quick Response — :price', { 'price': `${this.quickReplyAmount} ${pluralize('credit', this.quickReplyAmount)}` })
        : this.__('Quick Response — Buy Credits');
    },
  },

  methods: {
    pushToBuyMoney: function () {
      this.$router.push('/resources/credit-transactions', {
        'viaResource': 'requests',
        'viaResourceId': this.requestId,
      });
    },

    sendResponse: function (roomId, text, price, isQuickResponse) {
      this.loading = true;

      if (roomId) {
        const formData = new FormData();
        formData.append('quick', isQuickResponse ? 1 : 0);
        formData.append('text', text);
        if (price) {
          formData.append('price', price);
        }

        Nova.request()
          .post(`/nova-vendor/message-list/request/${roomId}/reply`, formData)
          .then(response => {
            if (response.data && response.data.status) {
              Nova.success(response.data.message);

              this.refreshPage();
            } else {
              Nova.error(this.__('Something went wrong'));
            }
          })
          .catch(error => {
            if (process.env.NODE_ENV === 'development') {
              Nova.error(error.message);
            }

            Nova.error(this.__('Something went wrong'));
          })
          .finally(() => {
            this.loading = true;
          });
      } else {
        Nova.error(this.__('Something went wrong'));
      }
    },

    normalReplyModalOpen() {
      if (!this.hasResponseText) {
        return;
      }

      if (this.hasNormalReplyAmount) {
        this.normalReplyModalOpened = true;
      } else {
        this.pushToBuyMoney();
      }
    },

    normalReplyModalConfirm() {
      this.sendResponse(this.requestId, this.responseText, this.responsePrice, false);

      this.normalReplyModalOpened = false;
    },

    normalReplyModalClose() {
      if (this.hasNormalReplyAmount) {
        this.normalReplyModalOpened = false;
      } else {
        this.pushToBuyMoney();
      }
    },

    quickReplyModalOpen() {
      if (!this.hasResponseText) {
        return;
      }

      if (this.hasQuickReplyAmount) {
        this.quickReplyModalOpened = true;
      } else {
        this.pushToBuyMoney();
      }
    },

    quickReplyModalConfirm() {
      this.sendResponse(this.requestId, this.responseText, this.responsePrice, true);

      this.quickReplyModalOpened = false;
    },

    quickReplyModalClose() {
      this.quickReplyModalOpened = false;
    },

    refreshPage() {
      this.$router.go(this.$router.currentRoute);
    }
  },
};
</script>
