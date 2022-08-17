<template>
  <card class="og-card px-3 py-3 bg-30 hover:bg-primary-30% transition duration-300 motion-reduce:transition-none">
    <a :href="url" target="_blank" rel="noopener" class="no-underline">
      <div class="flex">
        <div class="col-4 rounded overflow-hidden" v-if="opengraphData.image">
          <img :src="opengraphData.image" :alt="opengraphData.title" />
        </div>
        <div class="pl-2" :class="{ 'col-8' : opengraphData.image, 'col' : !opengraphData.image }">
          <div class="font-bold pb-2 text-90">{{ opengraphData.title }}</div>
          <div class="text-sm text-80">{{ opengraphData.description }}</div>
        </div>
      </div>
    </a>
  </card>
</template>

<script>
export default {
  props: {
    url: {
      type: String,
      required: true,
    },
    opengraphData: {
      type: Object,
      default: () => {},
    }
  }
}
</script>

<style lang="scss">
.og-card {
  transition: background-color 300ms;

  img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    transition: 500ms;
  }

  a {
    &:hover {
      img {
        transform: scale(1.05);
      }
    }
  }
}
</style>
