<template>
    <card class="flex flex-col items-center justify-center overflow-hidden">
        <resource-table
          resource-name="requests"
          singular-name="Request"
          :resources="resources"
          :selected-resources="[]"
          :selected-resource-ids="[]"
          :actions-are-available="false"
          :should-show-checkboxes="false"
          :via-resource="null"
          :via-resource-id="null"
          :via-relationship="null"
          relationship-type=""
          :authorized-to-relate="false"
        />
    </card>
</template>

<script>
export default {
  props: [
    'card',

    // The following props are only available on resource detail cards...
    // 'resource',
    // 'resourceId',
    // 'resourceName',
  ],

  computed: {
    resources: function () {
      return this.card.resources || [];
    }
  },

  mounted() {
    //
  }
}
</script>
