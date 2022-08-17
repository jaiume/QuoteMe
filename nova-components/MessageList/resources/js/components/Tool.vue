<template>
  <loading-view :loading="!(messagesLoaded && amountsLoaded)">
    <div class="card-panel" v-if="quickContactEnabled && quickContact">
      <heading class="mb-6">
        {{ __('Quick Contact') }}
      </heading>

      <card class="mb-6 px-3">
        <template v-if="quickContactAvailable">
          <div v-if="quickContactName" class="flex border-b border-40 -mx-6 px-6">
            <div class="w-1/4 py-4">
              <h4 class="font-normal text-80">
                {{ __('Customer\'s Name') }}
              </h4>
            </div>

            <div class="w-3/4 py-4 break-words">
              <p class="text-90">
                {{ quickContactName }}
              </p>
            </div>
          </div>

          <div v-if="quickContactName" class="flex border-b border-40 -mx-6 px-6">
            <div class="w-1/4 py-4">
              <h4 class="font-normal text-80">
                {{ __('Customer\'s Email') }}
              </h4>
            </div>

            <div class="w-3/4 py-4 break-words">
              <p class="text-90">
                {{ quickContactEmail || __('N/A') }}
              </p>
            </div>
          </div>

          <div v-if="quickContactName" class="flex -mx-6 px-6">
            <div class="w-1/4 py-4">
              <h4 class="font-normal text-80">
                {{ __('Customer\'s Phone') || __('N/A') }}
              </h4>
            </div>

            <div class="w-3/4 py-4 break-words">
              <p class="text-90">
                {{ quickContactPhone || __('N/A') }}
              </p>
            </div>
          </div>
        </template>

        <template v-else>
          <button
            v-if="quickContactEnabled"
            class="btn btn-default btn-primary items-center relative ml-3 my-3"
            @click.prevent="quickContactModalOpen"
          >
            {{ quickContactLabel }}
          </button>
        </template>
      </card>
    </div>

    <div class="card-panel">
      <heading class="mb-6">
        {{ __('Response') }}
      </heading>

      <card class="mb-6 py-3 px-6">
        <div
          v-if="!hasMessages"
          class="text-80 p-3 text-xs flex items-center justify-center"
        >
          {{ __('You have not responded yet') }}
        </div>

        <template v-if="messagesLoaded">
          <template v-if="hasMessages">
            <div class="flex border-b border-40 -mx-6 px-6" v-if="!!messages[0].price">
              <div class="w-1/4 py-4"><h4 class="font-normal text-80">{{ __('Price') }}</h4></div>
              <div class="w-3/4 py-4 break-words"><p class="text-90">{{ messages[0].price || '-' }}</p></div>
            </div>

            <div class="flex border-b border-40 -mx-6 px-6">
              <div class="w-1/4 py-4"><h4 class="font-normal text-80">{{ __('Message') }}</h4></div>
              <div class="w-3/4 py-4 break-words">
                <div>
                  <div class="markdown leading-normal whitespace-pre-wrap">{{ messages[0].content || '-' }}</div>
                </div>
              </div>
            </div>

            <div class="flex border-b border-40 -mx-6 px-6">
              <div class="w-1/4 py-4"><h4 class="font-normal text-80">{{ __('Created At') }}</h4></div>
              <div class="w-3/4 py-4 break-words"><p class="text-90">{{ messages[0].created_at || __('No') }}</p></div>
            </div>

            <div class="flex border-b border-40 -mx-6 px-6">
              <div class="w-1/4 py-4"><h4 class="font-normal text-80">{{ __('Viewed In List') }}</h4></div>
              <div class="w-3/4 py-4 break-words"><p class="text-90">{{ messages[0].listed_at || __('No') }}</p></div>
            </div>

            <div class="flex border-b border-40 -mx-6 px-6">
              <div class="w-1/4 py-4"><h4 class="font-normal text-80">{{ __('Viewed In Detail') }}</h4></div>
              <div class="w-3/4 py-4 break-words"><p class="text-90">{{ messages[0].viewed_at || __('No') }}</p></div>
            </div>

            <div class="flex border-b border-40 -mx-6 px-6 remove-bottom-border">
              <div class="w-1/4 py-4"><h4 class="font-normal text-80">{{ __('Other Supplier Responses Count') }}</h4></div>
              <div class="w-3/4 py-4 break-words"><p class="text-90">{{ messages[0].other_suppliers_responses || 0 }}</p></div>
            </div>
          </template>
        </template>

        <response-field
          v-if="!alreadyResponded"
          :quick-reply-amount="Number(quickReplyAmount)"
          :normal-reply-amount="Number(normalReplyAmount)"
          :has-quick-reply-amount="Boolean(hasQuickReplyAmount)"
          :has-normal-reply-amount="Boolean(hasNormalReplyAmount)"
          :request-has-quick-reply="Boolean(requestHasQuickReply)"
          :request-id="roomId"
        />
      </card>
    </div>

    <portal to="modals" transition="fade-transition">
      <quick-contact-modal
        v-if="quickContactModalOpened"
        @confirm="quickContactModalConfirm"
        @close="quickContactModalClose"
        :amount="quickContactAmount"
      />
    </portal>
  </loading-view>
</template>

<script>
import pluralize from 'pluralize';
import Conversation from './Conversation';
import QuickContactModal from './QuickContactModal';
import ResponseField from './ResponseField';

const Nova = window.Nova;

export default {
  components: {
    QuickContactModal,
    Conversation,
    ResponseField,
  },

  props: {
    resourceName: {
      type: String,
      default: '',
    },
    resourceId: {
      type: [String, Number],
      default: -1,
    },
    panel: {
      type: Object,
      default: () => {},
    }
  },

  data() {
    return {
      userId: -1,
      roomId: this.resourceId,

      quickContact: false,
      quickContactAvailable: false,
      quickContactName: null,
      quickContactEmail: null,
      quickContactPhone: null,
      quickContactModalOpened: false,

      loadingRooms: false,
      messagesLoaded: false,
      amountsLoaded: false,

      alreadyResponded: true,
      hasNormalReplyAmount: false,
      hasQuickReplyAmount: false,
      hasQuickContactAmount: false,
      requestHasQuickReply: false,
      normalReplyAmount: -1,
      quickReplyAmount: -1,
      quickContactAmount: -1,

      rooms: [],
      messages: [],
    };
  },

  computed: {
    hasMessages: function () {
      return Array.isArray(this.messages) && this.messages.length > 0;
    },

    quickContactEnabled: function () {
      return Nova.config.quick_contact_enabled || false;
    },

    quickContactLabel: function () {
      return this.hasQuickContactAmount
        ? this.__('Quick Contact — :price', { 'price': `${this.quickContactAmount} ${pluralize('credit', this.quickContactAmount)}` })
        : this.__('Quick Contact — Buy Credits');
    }
  },

  methods: {
    pushToBuyMoney: function () {
      this.$router.push('/resources/credit-transactions', {
        'viaResource': 'requests',
        'viaResourceId': this.requestId,
      });
    },

    fetchQuickContactStatus: function (roomId) {
      if (roomId) {
        Nova.request()
          .get(`/nova-vendor/message-list/request/${roomId}/quick_contact`)
          .then(response => {
            this.quickContact = response.status ? response.data.data.enabled : false;

            this.quickContactAvailable = response.data.data.available || false;

            if (this.quickContact && response.data.data.email) {
              this.quickContactEmail = response.data.data.email;
            }

            if (this.quickContact && response.data.data.name) {
              this.quickContactName = response.data.data.name;
            }

            if (this.quickContact && response.data.data.phone) {
              this.quickContactPhone = response.data.data.phone;
            }
          })
          .catch(error => {
            if (process.env.NODE_ENV === 'development') {
              Nova.error(error.message);
            }

            Nova.error('Something went wrong');
          });
      }
    },

    fetchMessages: function (roomId) {
      this.messagesLoaded = false;

      if (roomId) {
        Nova.request()
          .get(`/nova-vendor/message-list/request/${roomId}/messages`)
          .then(response => {
            this.messages = response.status ? response.data.data : [];
          })
          .catch(error => {
            if (process.env.NODE_ENV === 'development') {
              Nova.error(error.message);
            }

            Nova.error('Something went wrong');
          })
          .finally(() => {
            this.messagesLoaded = true;
          });
      } else {
        Nova.error('Something went wrong');
      }
    },

    quickContactModalOpen() {
      if (!this.quickContactEnabled) {
        return;
      }

      if (this.hasQuickContactAmount) {
        this.quickContactModalOpened = true;
      } else {
        this.pushToBuyMoney();
      }
    },

    quickContactModalConfirm() {
      this.postQuickContact(this.resourceId);
      this.quickContactModalOpened = false;
    },

    quickContactModalClose() {
      this.quickContactModalOpened = false;
    },

    postQuickContact: function (roomId) {
      if (roomId) {
        Nova.request()
          .post(`/nova-vendor/message-list/request/${roomId}/quick_contact`, {})
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
      }
    },

    fetchAmounts: function (roomId) {
      this.amountsLoaded = false;

      if (roomId) {
        Nova.request()
          .get(`/nova-vendor/message-list/request/${roomId}/amounts`)
          .then(response => {
            this.alreadyResponded = !!response.data.data.responded;
            this.hasNormalReplyAmount = response.data.data.has_normal_reply_amount;
            this.hasQuickReplyAmount = response.data.data.has_quick_reply_amount;
            this.hasQuickContactAmount = response.data.data.has_quick_contact_amount;
            this.normalReplyAmount = response.data.data.normal_reply_amount;
            this.quickReplyAmount = response.data.data.quick_reply_amount;
            this.quickContactAmount = response.data.data.quick_contact_amount;
            this.requestHasQuickReply = response.data.data.request_has_quick_reply;
          })
          .catch(error => {
            if (process.env.NODE_ENV === 'development') {
              Nova.error(error.message);
            }

            Nova.error('Something went wrong');
          })
          .finally(() => {
            this.amountsLoaded = true;
          });
      } else {
        Nova.error('Something went wrong');
      }
    },

    refreshPage() {
      this.$router.go(this.$router.currentRoute);
    }
  },

  mounted() {
    this.userId = window.config.userId || -1;

    this.fetchMessages(this.resourceId);
    this.fetchQuickContactStatus(this.resourceId);
    this.fetchAmounts(this.resourceId);
  },
};
</script>
