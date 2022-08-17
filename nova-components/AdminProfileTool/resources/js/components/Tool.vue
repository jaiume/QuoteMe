<template>
  <loading-view :loading="loading">
    <heading class="mb-6">
      {{ __('Update Profile') }}
    </heading>

    <card class="overflow-hidden">
      <form @submit.prevent="submitForm">
        <validation-errors :errors="validationErrors" />

        <template v-for="field in fields">
          <component
            :key="field.attribute"
            :is="field.component"
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
            dusk="update-button"
            type="submit"
          >
            {{ __('Save Profile') }}
          </progress-button>
        </div>
      </form>
    </card>
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
      submitting: false,
      validationErrors: new Errors(),
      fields: [],
      formData: null,
    };
  },

  created() {
    this.fetchUserData();
  },

  methods: {
    fetchUserData: function () {
      this.loading = true;

      Nova.request()
        .get('/nova-vendor/admin-profile/user')
        .then(response => {
          this.fields = response.status
            ? response.data.data.map(field => ({ ...field, validationKey: field.attribute }))
            : {};
        })
        .catch(error => {
          if (process.env.NODE_ENV === 'development') {
            Nova.error(error.message);
          }

          Nova.error('Something went wrong');
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
          Nova.error('Something went wrong');
        }
      } finally {
        this.submitting = false;
      }
    },

    createRequest() {
      return Nova.request().post(
        '/nova-vendor/admin-profile/save',
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
  },
};
</script>
