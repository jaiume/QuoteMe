<template>
  <div
    class="conversation__message"
    :class="{
      'bg-20': !isRightSide,
      'conversation__message-right bg-40': isRightSide
    }"
  >
    <div class="conversation__message--header flex flex-row items-baseline justify-between">
      <div class="conversation__message--username text-80 text-bold text-sm pb-2">
        {{ isRightSide ? __('You') : username }}
      </div>
      <div class="conversation__message--timestamp text-xs">
        <font-awesome-icon
          v-if="listed || viewed"
          :icon="['fas', 'check']"
          :color="checkColor"
          :title="checkLabel"
        />
        {{ timestamp }}
      </div>
    </div>

    <div class="conversation__message--content">
      {{ content }}
    </div>

    <div class="conversation__message--content-url flex flex-col bg-40 p-2 mt-2" v-if="url">
      <span class="text-xs">{{ __('Customer provided a link') }}</span>
      <a :href="url" target="_blank">{{ url }}</a>
    </div>

    <div class="conversation__message--img mt-2" v-if="!!photo.thumb">
      <div class="conversation__message--img--wrapper">
        <a v-if="!!photo.full" :href="photo.full" target="_blank">
          <img :src="photo.thumb" />
        </a>

        <img v-else :src="photo.thumb" />
      </div>
    </div>
  </div>
</template>

<script>
import { library } from '@fortawesome/fontawesome-svg-core';
import { faCheck } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(faCheck);

export default {
  components: {
    'font-awesome-icon': FontAwesomeIcon,
  },

  props: {
    timestamp: {
      type: String,
      default: '',
    },
    username: {
      type: String,
      default: '',
    },
    content: {
      type: String,
      default: '',
    },
    photo: {
      type: Object,
      default: () => {},
    },
    url: {
      type: String,
      default: ''
    },
    listed_at: {
      type: String,
      default: '',
    },
    viewedAt: {
      type: String,
      default: '',
    },
    isRightSide: {
      type: Boolean,
      default: false,
    }
  },

  computed: {
    listed: function () {
      return !!this.listed_at || false;
    },

    viewed: function () {
      return !!this.viewedAt || false;
    },

    checkColor: function () {
      return this.viewed ? 'var(--primary)' : 'var(--30)';
    },

    checkLabel: function () {
      return this.viewed
        ? this.__('Viewed at :timestamp', { 'timestamp': this.viewedAt })
        : this.__('Listed at :timestamp', { 'timestamp': this.listed_at });
    }
  }
};
</script>

<style lang="scss">
$marginSize: 25%;

.conversation {
  &__message {
    border: 1px solid #eee;
    border-radius: 0.5rem;
    display: flex;
    flex-direction: column;
    margin-right: $marginSize;
    margin-left: 0;
    padding: 0.75rem;
    margin-bottom: 0.75rem;

    &-right {
      margin-right: 0;
      margin-left: $marginSize;
    }

    &--content {
      &-url {
        border-radius: 0.5rem;
        border: 1px solid var(--primary);
      }
    }

    &--img {
      &--wrapper {
        overflow: hidden;
        max-width: 120px;
        border-radius: 0.5rem;
        border: 1px solid #eee;
      }

      img {
        object-fit: cover;
      }

      a {
        & > img {
          transition: 300ms;
        }

        &:hover > img {
          transform: scale(1.15);
        }
      }
    }
  }
}
</style>
