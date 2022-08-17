<template>
  <div class="conversation__wrapper">
    <div
      class="flex flex-col"
      v-for="(message, messageIndex) in messages"
      :key="`${message.sender_id}-${message._id}`"
    >
      <date
        :key="`date-${message._id}`"
        :date="message.date"
        :is-hidden="getDateVisibility(messageIndex)"
      />

      <message
        :key="`message-${message._id}`"
        :content="message.content"
        :timestamp="message.timestamp"
        :username="message.username"
        :viewed-at="message.viewed_at"
        :seen-at="message.listed_at"
        :url="message.url"
        :photo="{
          thumb: message.photo_thumb || null,
          full: message.photo || null,
        }"
        :is-right-side="Number(message.sender_id) === Number(userId)"
      />
    </div>
  </div>
</template>

<script>
import Date from './Date';
import Message from './Message';

export default {
  components: {
    Date,
    Message,
  },

  props: {
    loading: {
      type: Boolean,
      default: false,
    },
    currentUserId: {
      type: Number,
      required: true,
    },
    messages: {
      type: Array,
      required: true,
    },
    userId: {
      type: Number,
      required: true,
    }
  },

  methods: {
    getDateVisibility(messageIndex) {
      if (messageIndex === 0) {
        return this.messages[messageIndex].date === this.messages[this.messages.length - 1].date;
      }

      return this.messages[messageIndex].date === this.messages[messageIndex - 1].date;
    }
  }
};
</script>
