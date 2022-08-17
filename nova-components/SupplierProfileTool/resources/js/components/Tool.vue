<template>
  <loading-view :loading="loading">
    <heading class="mb-6">
      {{ __('Update Profile') }}
    </heading>

    <card class="overflow-hidden">
      <div class="bg-30 flex flex-row-reverse px-8 py-4" v-if="!emailConfirmed || !phoneConfirmed">
        <form @submit.prevent="requestEmailValidationMessage" class="pl-4">
          <progress-button
            v-if="!emailConfirmed"
            :disabled="loadingEmail"
            :processing="loadingEmail"
            type="submit"
          >
            {{ __('Verify Email') }}
          </progress-button>
        </form>

        <form @submit.prevent="requestPhoneValidationMessage">
          <progress-button
            v-if="!phoneConfirmed"
            :disabled="loadingPhone"
            :processing="loadingPhone"
            type="submit"
          >
            {{ __('Verify Phone') }}
          </progress-button>
        </form>
      </div>

      <form @submit.prevent="submitForm">
        <validation-errors :errors="validationErrors" />

        <template v-for="field in fields">
          <component
            :is="field.component"
            :key="field.attribute"
            :errors="validationErrors"
            :field="field"
            :show-help-text="!!field.helpText"
            :help-text="field.helpText"
          />
        </template>

        <div class="bg-30 flex flex-row-reverse px-8 py-4">
          <progress-button
            :disabled="submitting"
            :processing="submitting"
            type="submit"
          >
            {{ __('Save Profile') }}
          </progress-button>
        </div>
      </form>
    </card>

    <portal to="modals" transition="fade-transition">
      <modal v-if="emailSuccessModalOpened" @modal-close="closeEmailSuccessModal">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden" style="width: 460px">
          <slot>
            <div class="p-8">
              <heading :level="2" class="mb-6">
                {{ __('Email Confirmation Sent') }}
              </heading>
              <p class="text-80 leading-normal">
                {{ __('The confirmation email was sent to your email address. Please following the link provided in the email.') }}
              </p>
            </div>
          </slot>

          <div class="bg-30 px-6 py-3 flex">
            <div class="ml-auto">
              <button type="button" @click.prevent="closeEmailSuccessModal" class="btn btn-default btn-primary">
                {{__('OK') }}
              </button>
            </div>
          </div>
        </div>
      </modal>

      <modal v-if="phoneConfirmationModalOpened" @modal-close="phoneConfirmationModalOpened = !phoneConfirmationModalOpened">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden" style="width: 460px">
          <slot>
            <div class="p-8">
              <heading :level="2" class="mb-6">
                {{ __('Phone confirmation') }}
              </heading>
              <p class="text-80 leading-normal">
                {{ __('Please enter the 6-digit verification code sent to your phone number via SMS and press the confirmation button') }}
              </p>

              <form @submit.prevent="sendPhoneConfirmationCode">
                <div class="flex flex-wrap items-stretch w-full relative">
                  <div class="flex -mr-px">
                    <span class="flex items-center leading-normal rounded rounded-r-none border border-r-0 border-60 px-3 whitespace-no-wrap bg-30 text-80 text-sm font-bold">
                      {{ __('Code') }}
                    </span>
                  </div>

                  <input
                    id="total"
                    type="text"
                    pattern="^[0-9]{1,6}$"
                    :placeholder="__('123456')"
                    minlength="6"
                    maxlength="6"
                    class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 rounded-l-none form-control form-input form-input-bordered"
                    v-model="smsConfirmationCode"
                  >
                </div>
              </form>
            </div>
          </slot>

          <div class="bg-30 px-6 py-3 flex">
            <div class="ml-auto">
              <button type="button" @click.prevent="phoneConfirmationModalOpened = !phoneConfirmationModalOpened" class="btn text-80 font-normal h-9 px-3 mr-3 btn-link">
                {{__('Cancel') }}
              </button>

              <button
                type="button"
                :disabled="!(smsConfirmationCode && smsConfirmationCode.length === 6)"
                @click.prevent="sendPhoneConfirmationCode"
                class="btn btn-default btn-primary"
              >
                {{ __('OK') }}
              </button>
            </div>
          </div>
        </div>
      </modal>

      <modal v-if="phoneSuccessModalOpened" @modal-close="closePhoneSuccessModal">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden" style="width: 460px">
          <slot>
            <div class="p-8">
              <heading :level="2" class="mb-6">
                {{ __('Phone confirmed') }}
              </heading>
              <p class="text-80 leading-normal">
                {{ __('Phone number confirmed successfully') }}
              </p>
            </div>
          </slot>

          <div class="bg-30 px-6 py-3 flex">
            <div class="ml-auto">
              <button type="button" @click.prevent="closePhoneSuccessModal" class="btn btn-default btn-primary">
                {{__('OK') }}
              </button>
            </div>
          </div>
        </div>
      </modal>

      <modal v-if="phoneFailureModalOpened" @modal-close="closePhoneFailureModal">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden" style="width: 460px">
          <slot>
            <div class="p-8">
              <heading :level="2" class="mb-6">
                {{ __('Phone not confirmed') }}
              </heading>
              <p class="text-80 leading-normal">
                {{ __('There\'s an error while confirming the number. Please try again.') }}
              </p>
            </div>
          </slot>

          <div class="bg-30 px-6 py-3 flex">
            <div class="ml-auto">
              <button type="button" @click.prevent="closePhoneFailureModal" class="btn btn-default btn-primary">
                {{__('OK') }}
              </button>
            </div>
          </div>
        </div>
      </modal>
    </portal>
  </loading-view>
</template>

<script>
import { Errors } from 'laravel-nova';
import _ from 'lodash';

const Nova = window.Nova;

export default {
  metaInfo() {
    return {
      title: this.__('Profile'),
    };
  },

  data() {
    return {
      loading: true,
      loadingEmail: false,
      loadingPhone: false,

      submitting: false,
      validationErrors: new Errors(),
      fields: [],
      emailConfirmed: false,
      phoneConfirmed: false,
      formData: null,
      smsConfirmationCode: '',
      phoneConfirmationModalOpened: false,
      emailSuccessModalOpened: false,
      phoneSuccessModalOpened: false,
      phoneFailureModalOpened: false,
    };
  },

  created() {
    this.fetchUserData();
  },

  methods: {
    fetchUserData: function () {
      this.loading = true;

      Nova.request()
        .get('/nova-vendor/supplier-profile/user')
        .then(response => {
          this.fields = response.status
            ? response.data.data.fields.map(field => ({ ...field, validationKey: field.attribute }))
            : {};

          this.emailConfirmed = response.data.data.email_verified || false;
          this.phoneConfirmed = response.data.data.phone_verified || false;
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

    submitForm: async function () {
      try {
        this.submitting = true;
        await this.createRequest();

        Nova.success(this.__('Your profile has been saved!'));

        this.fetchUserData();
        this.validationErrors = new Errors();
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.validationErrors = new Errors(error.response.data.errors);

          Nova.error(error.response.data.message);
        } else {
          Nova.error(this.__('Something went wrong'));
        }
      } finally {
        this.submitting = false;
      }
    },

    requestEmailValidationMessage: async function () {
      this.loadingEmail = true;
      await Nova
        .request()
        .post('/nova-vendor/supplier-profile/confirm-email', new FormData());

      this.emailSuccessModalOpened = true;
      this.loadingEmail = false;
    },

    requestPhoneValidationMessage: async function () {
      this.loadingPhone = true;
      await Nova
        .request()
        .post('/nova-vendor/supplier-profile/confirm-phone', new FormData());

      this.phoneConfirmationModalOpened = true;
      this.loadingPhone = false;
    },

    sendPhoneConfirmationCode: async function () {
      this.loadingPhone = true;
      const data = new FormData();
      data.append('code', this.smsConfirmationCode);

      try {
        const response = await Nova
          .request()
          .post('/nova-vendor/supplier-profile/confirm-phone', data);

        if (response.data.verified) {
          this.phoneSuccessModalOpened = true;
          this.phoneConfirmed = true;
        } else {
          this.phoneFailureModalOpened = true;
        }
      } catch (e) {
        this.phoneFailureModalOpened = true;
      } finally {
        this.phoneConfirmationModalOpened = false;
        this.smsConfirmationCode = '';
      }
      this.loadingPhone = false;
    },

    createRequest() {
      return Nova.request().post(
        '/nova-vendor/supplier-profile/save',
        this.createResourceFormData()
      );
    },

    createResourceFormData() {
      return _.tap(new FormData(), formData => {
        _.each(this.fields, field => {
          field.fill(formData);
        });
      });
    },

    closeEmailSuccessModal() {
      this.emailSuccessModalOpened = !this.emailSuccessModalOpened;
      window.location.reload();
    },

    closePhoneSuccessModal() {
      this.phoneSuccessModalOpened = !this.phoneSuccessModalOpened;
      window.location.reload();
    },

    closePhoneFailureModal() {
      this.phoneFailureModalOpened = !this.phoneFailureModalOpened;
      window.location.reload();
    }
  },
};
</script>
