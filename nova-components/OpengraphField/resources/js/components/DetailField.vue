<template>
    <panel-item :field="field">
      <open-graph-card
        v-if="showCard"
        slot="value"
        :url="field.value"
        :opengraph-data="field.og_data"
      />

      <template slot="value" v-else-if="field.value && isValidUrl(field.value)">
        <a :href="field.value">{{ field.value }}</a>
      </template>

      <template slot="value" v-else-if="field.value">
        <p>{{ field.value }}</p>
      </template>
    </panel-item>
</template>

<script>
import OpenGraphCard from "./card/OpenGraphCard";
export default {
  components: {OpenGraphCard},
  props: ['resource', 'resourceName', 'resourceId', 'field'],
  computed: {
    showCard: function () {
      return this.field.og_data && typeof(this.field.og_data) === 'object' && Object.values(this.field.og_data).length;
    }
  },
  methods: {
    isValidUrl(str) {
      const pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
      return !!pattern.test(str);
    }
  }
}
</script>
