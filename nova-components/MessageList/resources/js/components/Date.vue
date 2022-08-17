<template>
  <div class="conversation__date bg-logo font-light text-white text-xs text-center p-2 mb-2" v-if="!isHidden">
    {{ date }}
  </div>
</template>

<script>
export default {
  props: {
    date: {
      type: String,
      required: true,
    },
    isHidden: {
      type: Boolean,
      default: true,
    }
  }
};
</script>

<style lang="scss">
.conversation {
  &__date {
    max-width: 25%;
    border-radius: 0.5rem;
    align-self: center;
  }
}
</style>
